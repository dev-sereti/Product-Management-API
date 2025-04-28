<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): ProductResource
    {
        $userId = Auth::check() ? Auth::id() : null;
        
        $product = Product::create(array_merge(
            $request->validated(),
            ['user_id' => $userId]
        ));
        
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): ProductResource
    {
        Gate::authorize('update', $product);
        
        $product->update($request->validated());
        
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response
    {
        Gate::authorize('delete', $product);
        
        $product->delete();
        
        return response()->noContent();
    }

    /**
     * Search for products by name.
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        $name = $request->query('name');
        
        $products = Product::where('name', 'like', "%{$name}%")->get();
        
        return ProductResource::collection($products);
    }
}