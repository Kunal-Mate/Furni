<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Show all categories
     */
    public function index()
    {
        $categories = Category::where('isVisible', 1)->paginate(10);
        return view('categories', compact('categories'));
    }

    /**
     * Store new category
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|numeric|exists:temp_images,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $category = Category::create([
            'catName' => $request->name,
        ]);

        if (!empty($request->image)) {
            $tempImage = TempImage::find($request->image);

            if (!$tempImage) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp image not found in database.',
                ]);
            }

            $fileName = $tempImage->name; 
            $sourcePath = base_path('public/temp/' . $fileName);
            $destinationDir = base_path('public/frontend/assets/category/');
            $destinationPath = $destinationDir . $fileName;

            if (!File::exists($destinationDir)) {
                File::makeDirectory($destinationDir, 0777, true, true);
            }

            if (File::exists($sourcePath)) {
                File::move($sourcePath, $destinationPath);

                $category->update([
                    'catImg' => 'frontend/assets/category/' . $fileName,
                ]);

                $tempImage->delete();
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp image not found at: ' . $sourcePath,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully.',
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return back()->with('error', 'Category not found.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|numeric|exists:temp_images,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // ✅ Update category name
        $category->update(['catName' => $request->name]);

        // ✅ If new image uploaded
        if (!empty($request->image)) {
            $tempImage = TempImage::find($request->image);
            if (!$tempImage) {
                return back()->with('error', 'Temp image record not found in database.');
            }

            $fileName = $tempImage->name; // e.g. chair1.jpg
            $sourcePath = base_path('public/temp/' . $fileName);
            $destinationDir = base_path('public/frontend/assets/category/');
            $destinationPath = $destinationDir . $fileName;

            // ✅ Ensure destination folder exists
            if (!File::exists($destinationDir)) {
                File::makeDirectory($destinationDir, 0777, true, true);
            }

            // ✅ Move file from temp → category
            if (File::exists($sourcePath)) {
                File::move($sourcePath, $destinationPath);

                // ✅ Update database with correct path
                $category->update([
                    'catImg' => 'frontend/assets/category/' . $fileName,
                ]);

                // ✅ Remove temp image record
                $tempImage->delete();
            } else {
                return back()->with('error', 'Temp image file not found at: ' . $sourcePath);
            }
        }

        return back()->with('success', 'Category updated successfully.');
    }


    /**
     * Soft delete category
     */
    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        $category->update(['isVisible' => 0]);

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }
}
