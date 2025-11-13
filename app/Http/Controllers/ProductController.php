<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductAttch;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $properties = Product::where('isVisible', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('Products.index', compact('properties'));
    }

    public function create()
    {
       
        $admins = Admin::where('userType', 'admin')->where('isVisible', 1)->get();
        return view('Products.create', compact('admins'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'propertyName' => 'required|string|max:255',
            'address' => 'required|string',
            'mapLink' => 'nullable|string|max:500',
            'about' => 'nullable|string',
            'price' => 'nullable|numeric',
            'extraPricePerGuest' => 'nullable|numeric',
            'area' => 'nullable|numeric',
            'guestCapacity' => 'nullable|integer',
            'numberofBedrooms' => 'nullable|integer',
            'numberofBathrooms' => 'nullable|integer',
            'baseGuests' => 'nullable|integer',
            'mainImage' => 'nullable|image|mimes:jpg,jpeg,png',
            'thumbnailImages.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'amenities' => 'nullable|array',
            'facilities' => 'nullable|array',
        ]);

        $validator->after(function ($validator) use ($request) {
            $baseGuests = $request->input('baseGuests');
            $guestCapacity = $request->input('guestCapacity');

            if (!is_null($baseGuests) && !is_null($guestCapacity) && $baseGuests > $guestCapacity) {
                $validator->errors()->add('baseGuests', 'Base guests cannot be greater than guest capacity.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if ($request->has('amenities')) {
            $validated['amenityIds'] = implode(',', $request->amenities);
        }

        if ($request->has('facilities')) {
            $validated['facilityIds'] = implode(',', $request->facilities);
        }

        $basePath = public_path('assets/images/');
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0777, true);
        }

        if ($request->hasFile('mainImage')) {
            $mainImage = $request->file('mainImage');
            $mainImageName = time() . '_' . Str::random(8) . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move($basePath, $mainImageName);
            $validated['thumbnail'] = 'assets/images/' . $mainImageName;
        }

        $property = Product::create($validated);

        if ($request->hasFile('thumbnailImages')) {
            foreach ($request->file('thumbnailImages') as $thumb) {
                $thumbName = time() . '_' . Str::random(8) . '.' . $thumb->getClientOriginalExtension();
                $thumb->move($basePath, $thumbName);

                ProductAttch::create([
                    'propertyId' => $property->propertyId,
                    'propertyAtt' => 'assets/images/' . $thumbName,
                ]);
            }
        }
        return redirect()->route('property')->with('success', 'Property added successfully!');
    }

    public function show($id)
    {
        $property = Product::with('propertyAttach')->where('propertyId', $id)->firstOrFail();
        $amenityIds = $property->amenityIds ? explode(',', $property->amenityIds) : [];
        $facilityIds = $property->facilityIds ? explode(',', $property->facilityIds) : [];

        return view('property.show', compact('property'));
    }

    /**
     * Show the edit form
     */
    public function edit($id)
    {
        $admins = Admin::where('userType', 'admin')->get();
        // dd($admins);
        $property = Product::with('propertyAttach')->where('propertyId', $id)->firstOrFail();
        // dd($property);
      
        return view('property.edit', compact('property', 'Amenities', 'facilities', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $property = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'propertyName' => 'required|string|max:255',
            'address' => 'required|string',
            'mapLink' => 'nullable|string|max:500',
            'about' => 'nullable|string',
            'price' => 'nullable|numeric',
            'area' => 'nullable|numeric',
            'guestCapacity' => 'nullable|integer',
            'numberofBedrooms' => 'nullable|integer',
            'numberofBathrooms' => 'nullable|integer',
            'mainImage' => 'nullable|image|mimes:jpg,jpeg,png',
            'thumbnailImages.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'amenityIds' => 'nullable|array',
            'facilityIds' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // Save amenities
        if ($request->has('amenityIds')) {
            $validated['amenityIds'] = implode(',', $request->amenityIds);
        }

        // Save facilities
        if ($request->has('facilityIds')) {
            $validated['facilityIds'] = implode(',', $request->facilityIds);
        }

        $basePath = public_path('assets/images/');
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0777, true);
        }

        // If new main image uploaded
        if ($request->hasFile('mainImage')) {

            // delete old image if exists
            if (!empty($property->thumbnail) && File::exists(public_path($property->thumbnail))) {
                File::delete(public_path($property->thumbnail));
            }

            $mainImage = $request->file('mainImage');
            $mainImageName = time() . '_' . Str::random(8) . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move($basePath, $mainImageName);
            $validated['thumbnail'] = 'assets/images/' . $mainImageName;
        }

        // Update property data
        $property->update($validated);

        // If new thumbnails uploaded
        if ($request->hasFile('thumbnailImages')) {
            foreach ($request->file('thumbnailImages') as $thumb) {
                $thumbName = time() . '_' . Str::random(8) . '.' . $thumb->getClientOriginalExtension();
                $thumb->move($basePath, $thumbName);

                ProductAttch::create([
                    'propertyId' => $property->propertyId,
                    'propertyAtt' => 'assets/images/' . $thumbName,
                ]);
            }
        }

        return redirect()->route('property')->with('success', 'Property updated successfully!');
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:properties,propertyId',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $property = Product::where('propertyId', $request->id)->first();
        if ($property) {
            $property->isVisible = 0;
            $property->save();
            return response()->json([
                'status' => true,
                'message' => 'Property deleted successfully!'
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Property not found!']);
        }
    }
}
