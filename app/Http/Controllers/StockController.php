<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Products;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $stocks = Stock::with('relProducts')->get();

            return Inertia::render('Stocks/Index', compact('stocks'));
        } catch (\Exception $ex) {
            return response()->json('Error listing stocks: ' . $ex, 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $products = Products::all();

            return response()->json($products, 200);
        } catch (\Exception $ex) {
            return response()->json('Error listing products: ' . $ex, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockRequest $request)
    {
        try {
            Stock::create([
                'fk_product' => $request->fk_product,
                'inbound' => $request->inbound,
                'balance' => $request->inbound,
                'reserved' => 0,
                'validate_date' => $request->validate_date,
                'value' => $request->value,
            ]);

            return Redirect::route('stocks.index');
        } catch (\Exception $ex) {
            return response()->json('Error adding stock: ' . $ex, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockRequest  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        try {
            $stock->update([
                'fk_product' => $request->fk_product,
                'inbound' => $request->inbound,
                'validate_date' => $request->validate_date,
                'value' => $request->value,
            ]);

            return Redirect::route('stocks.index');
        } catch (\Exception $ex) {
            return response()->json('Error updating product: ' . $ex, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        try {
            $stock->delete();

            return Redirect::route('stocks.index');
        } catch (\Exception $ex) {
            return response()->json('Error deleting product: ' . $ex, 500);
        }
    }
}
