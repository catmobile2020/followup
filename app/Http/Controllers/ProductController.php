<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($index)
    {
        $category = Category::findOrFail($index);
        return view('product.index', compact('category'));
    }

    public function all(){
        $products = Product::all();
        return view('product.all', compact('products'));
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
            'title'=>'required|min:10',
            'description'=>'required',
            'image'=>'required|image',
            'price'=>'required|numeric'
        ]);
        $image = $request->file('image');
        $title = $request->title;
        $description = $request->input('description');
        $price = $request->price;

        $product = Product::create(['title'=>$title, 'price'=>$price, 'description'=>$description, 'category_id'=>$request->category_id]);
        if($image)
        {
            $image_filename = $product->id.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $image_filename);
        }

        $product->photos()->create(['path'=>'uploads/'.$image_filename]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->hasFile('photo')) {
            foreach ($product->photos as $photo){
                if(file_exists($photo->path)){
                    @unlink($photo->path);
                }

            }


            $image = $request->file('photo');
            $image_filename = $product->id.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $image_filename);
            if(count($product->photos) > 0){
                $product->photos()->update(['path' => 'uploads/' . $image_filename]);
            }else{
                $product->photos()->create(['path' => 'uploads/' . $image_filename]);
            }


        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        foreach ($product->photos as $photo) {
            if (file_exists($product->path)) {
                @unlink($product->path);
            }
        }
        $product->photos()->delete();

        return redirect()->back();
    }
}
