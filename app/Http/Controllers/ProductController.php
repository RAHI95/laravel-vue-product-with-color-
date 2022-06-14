<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048',
            'color' => 'required',
            'sizes' => 'required',
            'description' => 'required',
            'category_id' => 'required',

        ]);

        $product = Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'color' => $request->color,
            'sizes' =>json_encode($request->sizes),
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->image) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product){
            return response()->json($product,200);
          }else{
            return response()->json('failed',404);
          }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $this->validate($request, [
            'title' => "required|max:255|unique:products,title, $product->id",
            'price' => 'required|integer',
            'color' => 'required',
            'sizes' => 'required',
            'image' => 'sometimes|nullable|image|max:2048',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $product->update([
            'title'=>$request->title,
            'price' => $request->price,
            'color' => $request->color,
            'sizes' => $request->sizes,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
        ]);

        if ($request->image) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product){
            $productImage = $product->image;
            $imagePath = public_path($productImage);

            if ($productImage && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $product->delete();
            return response()->json('success', 200);
           }
           else{
            return response()->json('failed',404);
           }
    }
}

