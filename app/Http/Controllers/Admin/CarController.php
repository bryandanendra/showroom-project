<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('category')->latest()->paginate(15);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.cars.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,hybrid,electric',
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'license_plate' => 'nullable|string|max:255',
            'engine_capacity' => 'nullable|integer',
            'passengers' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'condition' => 'required|in:excellent,good,fair',
            'status' => 'required|in:available,sold,reserved',
            'main_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('cars', 'public');
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function edit(Car $car)
    {
        $categories = Category::all();
        return view('admin.cars.edit', compact('car', 'categories'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,hybrid,electric',
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'license_plate' => 'nullable|string|max:255',
            'engine_capacity' => 'nullable|integer',
            'passengers' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'condition' => 'required|in:excellent,good,fair',
            'status' => 'required|in:available,sold,reserved',
            'main_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            if ($car->main_image) {
                Storage::disk('public')->delete($car->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil diupdate!');
    }

    public function destroy(Car $car)
    {
        if ($car->main_image) {
            Storage::disk('public')->delete($car->main_image);
        }
        
        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil dihapus!');
    }
}
