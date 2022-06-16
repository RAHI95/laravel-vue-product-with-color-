<?php

namespace App\Http\Controllers;

use App\Product;
// use App\Variation;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use phpDocumentor\Reflection\Types\Nullable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::with('category','color')->get();

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
            'color_id' => 'required',
            'sizes' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'media.*' => 'required|mimes:jpg,jpeg,png|max:20000'

        ]);


        $product = Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'color_id' => $request->color_id,
            'sizes' =>json_encode($request->sizes),
            'media' =>json_encode($request->media),
            'price' => $request->price,
            'quantity' => json_encode($request->quantity),
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->image) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }

        foreach($request->media as $image){
            $from = public_path('tmp/uploads/'.$image);
            $to = public_path('product_images/'.$image);

            File::move($from, $to);
            $product->images()->create([
              'name' => $image,
            ]);
          }
        //   $products = Product::get();
        //   return redirect()->route('product.images', ['products'=>$products]);

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
            'color_id' => 'required',
            'sizes' => 'required',
            'quantity' => 'required',
            'image' => 'sometimes|nullable|image|max:2048',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $product->update([
            'title'=>$request->title,
            'color_id' => $request->color_id,
            'sizes' =>json_encode($request->sizes),
            'price' => $request->price,
            'quantity' => $request->quantity,
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

