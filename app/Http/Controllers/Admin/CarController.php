<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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


    /**
     * Crop image to 4:3 aspect ratio
     */
    private function cropImageTo4x3($uploadedFile)
    {
        try {
            // Get file extension
            $extension = strtolower($uploadedFile->getClientOriginalExtension());
            
            // Load the image based on type
            $imagePath = $uploadedFile->getRealPath();
            
            if ($extension === 'png') {
                $image = imagecreatefrompng($imagePath);
            } elseif (in_array($extension, ['jpg', 'jpeg'])) {
                $image = imagecreatefromjpeg($imagePath);
            } else {
                // Fallback: try to load from string
                $image = imagecreatefromstring(file_get_contents($imagePath));
            }
            
            if (!$image) {
                throw new \Exception('Failed to load image');
            }

            $originalWidth = imagesx($image);
            $originalHeight = imagesy($image);

            // Calculate 4:3 dimensions
            $targetRatio = 4 / 3;
            $currentRatio = $originalWidth / $originalHeight;

            if ($currentRatio > $targetRatio) {
                // Image is wider - crop width
                $newWidth = $originalHeight * $targetRatio;
                $newHeight = $originalHeight;
                $srcX = ($originalWidth - $newWidth) / 2;
                $srcY = 0;
            } else {
                // Image is taller - crop height
                $newWidth = $originalWidth;
                $newHeight = $originalWidth / $targetRatio;
                $srcX = 0;
                $srcY = ($originalHeight - $newHeight) / 2;
            }

            // Create new cropped image
            $croppedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency for PNG
            if ($extension === 'png') {
                imagealphablending($croppedImage, false);
                imagesavealpha($croppedImage, true);
            }
            
            imagecopyresampled(
                $croppedImage, $image,
                0, 0, $srcX, $srcY,
                $newWidth, $newHeight, $newWidth, $newHeight
            );

            // Save to temporary file
            $tempPath = sys_get_temp_dir() . '/' . Str::random(40) . '.jpg';
            imagejpeg($croppedImage, $tempPath, 90);

            // Clean up
            imagedestroy($image);
            imagedestroy($croppedImage);

            // Store the cropped image
            $filename = 'cars/' . Str::random(40) . '.jpg';
            $stored = Storage::disk('public')->put($filename, file_get_contents($tempPath));
            unlink($tempPath);

            if (!$stored) {
                throw new \Exception('Failed to store image');
            }

            return $filename;
        } catch (\Exception $e) {
            Log::error('Image crop failed: ' . $e->getMessage());
            // Fallback to direct upload without crop
            return $uploadedFile->store('cars', 'public');
        }
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
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $this->cropImageTo4x3($request->file('main_image'));
        }

        $car = Car::create($validated);

        // Handle multiple images upload with crop
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $this->cropImageTo4x3($image);
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'order' => $index + 1,
                ]);
            }
        }

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
        Log::info('Update car started', ['car_id' => $car->id]);
        
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
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        Log::info('Validation passed', $validated);

        if ($request->hasFile('main_image')) {
            if ($car->main_image) {
                Storage::disk('public')->delete($car->main_image);
            }
            $validated['main_image'] = $this->cropImageTo4x3($request->file('main_image'));
            Log::info('Main image updated');
        }

        $car->update($validated);
        Log::info('Car updated successfully');

        // Handle multiple images upload with crop
        if ($request->hasFile('images')) {
            $currentMaxOrder = $car->images()->max('order') ?? 0;
            foreach ($request->file('images') as $index => $image) {
                $path = $this->cropImageTo4x3($image);
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'order' => $currentMaxOrder + $index + 1,
                ]);
            }
            Log::info('Additional images uploaded');
        }

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil diupdate!');
    }

    public function destroy(Car $car)
    {
        if ($car->main_image) {
            Storage::disk('public')->delete($car->main_image);
        }

        // Delete all car images
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        
        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil berhasil dihapus!');
    }

    public function deleteMainImage(Car $car)
    {
        if ($car->main_image) {
            Storage::disk('public')->delete($car->main_image);
            $car->update(['main_image' => null]);
        }

        return back()->with('success', 'Gambar utama berhasil dihapus!');
    }

    public function deleteImage(CarImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus!');
    }
}
