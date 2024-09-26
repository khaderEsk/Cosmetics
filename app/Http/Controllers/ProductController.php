<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            return $this->returnData(Product::all(), __('backend.operation completed successfully', [], app()->getLocale()));
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->returnError($e->getCode(), 'some thing went wrongs');
        }
    }
    public function addFavorite($id)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return $this->returnError(404, 'Not found');
            }
            $product = Product::find($id);
            if (!$product) {
                return $this->returnError(404, 'Product not found');
            }
            if ($user->favoriteProducts()->where('product_id', $product->id)->exists()) {
                return $this->returnError(400, 'Product is already in your favorites');
            }
            $user->favoriteProducts()->attach($product->id);
            return $this->returnData(200, __('backend.operation completed successfully', [], app()->getLocale()));
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->returnError($e->getCode(), 'some thing went wrongs');
        }
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
    public function destroy($id)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return $this->returnError(404, 'Not found');
            }
            $product = Product::find($id);
            if (!$product) {
                return $this->returnError(404, 'Product not found');
            }
            if (!$user->favoriteProducts()->where('product_id', $product->id)->exists()) {
                return $this->returnError(400, 'Product not found in your favorites');
            }
            $user->favoriteProducts()->detach($product->id);
            return $this->returnData(200, __('backend.operation completed successfully', [], app()->getLocale()));
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->returnError($e->getCode(), 'some thing went wrongs');
        }
    }
}
