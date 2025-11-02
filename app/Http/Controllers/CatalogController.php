<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with('category')->available();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Filter by max price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by transmission
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter by fuel type
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter by year range
        if ($request->filled('year_min')) {
            $query->where('year', '>=', $request->year_min);
        }
        if ($request->filled('year_max')) {
            $query->where('year', '<=', $request->year_max);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'year_new':
                $query->orderBy('year', 'desc');
                break;
            case 'mileage_low':
                $query->orderBy('mileage', 'asc');
                break;
            default:
                $query->latest();
        }

        $cars = $query->paginate(12);
        $categories = Category::withCount('cars')->get();

        return view('catalog.index', compact('cars', 'categories'));
    }

    public function show(Car $car)
    {
        $car->load(['category', 'images']);
        $similarCars = Car::where('category_id', $car->category_id)
            ->where('id', '!=', $car->id)
            ->available()
            ->take(4)
            ->get();

        return view('catalog.show', compact('car', 'similarCars'));
    }
}
