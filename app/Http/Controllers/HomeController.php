<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Redirect admin to admin panel
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $categories = Category::withCount('cars')->get();
        $featuredCars = Car::with('category')
            ->available()
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('categories', 'featuredCars'));
    }
}
