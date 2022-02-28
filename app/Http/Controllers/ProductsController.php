<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();

        return Inertia::render('Products/Index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        try {
            Products::create([
                'name' => $request->name,
                'description' => $request->description ?? 'no description'
            ]);

            // return response()->json('success!');
            return Redirect::route('products.index');
        } catch (\Exception $ex) {
            return response()->json('Error adding product: ' . $ex, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductsRequest  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, Products $product)
    {
        try {
            $product->update([
                'name' => $request->name,
                'description' => $request->description ?? 'no description'
            ]);

            return Redirect::route('products.index');
        } catch (\Exception $ex) {
            return response()->json('Error updating product: ' . $ex, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        try {
            $product->delete();

            return Redirect::route('products.index');
        } catch (\Exception $ex) {
            return response()->json('Error deleting product: ' . $ex, 500);
        }
    }
}
