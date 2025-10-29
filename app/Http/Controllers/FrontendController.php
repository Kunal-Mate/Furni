<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('isVisible', 1)
            ->take(6)
            ->get()
            ->each(function ($category) {
                $category->setRelation(
                    'products',
                    $category->products()->latest()->take(2)->get()
                );
            });

        $popular_products = Product::where('isVisible', 1)->take(5)->get();
        // dd($categories);
        return view('frontend.index', compact('popular_products', 'categories'));
    }

    public function categories()
    {
        return view('frontend.categories');
    }

    public function catalog()
    {
        $categories = Category::with([
            'products' => function ($query) {
                $query->where('isVisible', 1);
            }
        ])
            ->where('isVisible', 1)
            ->get();
        return view('frontend.catalog', compact('categories'));
    }

    public function productDetails($id)
    {
        $product = Product::where('productId', $id)->firstOrFail();
        $product = Product::withCount('attachments')->where('productId', $id)->firstOrFail();
        $attachments = $product->attachments->isNotEmpty() ? $product->attachments : collect();
        $popular_products = Product::where('isVisible', 1)->take(5)->get();
        // dd($product);

        return view('frontend.product-details', compact('product', 'attachments', 'popular_products'));
    }

    public function productGeneral()
    {
        return view('frontend.product-general');
    }

    public function productReview()
    {
        return view('frontend.product-reviews');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
