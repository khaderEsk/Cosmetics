<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::whereHas('roles', function ($query) {
                $query->where('id', 1);
            })->get();
            return $this->returnData($user, __('backend.operation completed successfully', [], app()->getLocale()));
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->returnError($e->getCode(), 'some thing went wrongs');
        }
    }


    public function getProductsWithFavorites()
    {
        try {
            $products = Product::with(['favoritedByUsers' => function ($query) {
                $query->select('users.id', 'users.firstName', 'users.lastName'); // اختر الحقول المطلوبة من المستخدمين
            }])->get();

            // إضافة عدد المستخدمين الذين قاموا بتفضيل كل منتج
            $products->map(function ($product) {
                $product->favorites_count = $product->favoritedByUsers->count();
                return $product;
            });
            return $this->returnData($products, __('backend.operation completed successfully', [], app()->getLocale()));
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->returnError($e->getCode(), 'some thing went wrongs');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function addPoint($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->returnError(404, __('not found', [], app()->getLocale()));
            }
            $user->update([
                'point' => $user->point + 1
            ]);
            return $this->returnData(200, __('backend.operation completed successfully', [], app()->getLocale()));
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->returnError($e->getCode(), 'some thing went wrongs');
        }
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
