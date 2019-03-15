<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use Image; //http://image.intervention.io/getting_started/installation install,add file in config/app.php
use App\Model\ProductImage;
use File;
class AdminPageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index() {
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::select('name','id')->orderBy('name')->get();
        $brands = Brand::select('name','id')->orderBy('name')->get();
        return view('pages.admin.product.create_product',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'title' => 'required  | max:100',
            'description' => 'nullable | max:255',
            'quantity' => 'required | numeric',
            'price' => 'required | numeric',
            'category_id' => 'required | numeric',
            'brand_id' => 'required | numeric',
            'display_image' => ' required | image '
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = str_slug($request->title);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->status = 1;
        $product->offer_price = 1000;


       // Single image save
        if($request->hasFile('display_image')){
         $display_image = $request->file('display_image');
         $image = time().'.'.$display_image->getClientOriginalExtension();
         $path = public_path('images/products/display_image/'.$image);
         Image::make($display_image)->save($path);
     }

     $product->display_image = $image;
     $product->save();
//        
//        $productImage = new ProductImage();
//        $productImage->product_id = $product->id;
//        $productImage->image = $image;
//        $productImage->save();
//        
//        
        //multiple image insert
     if(is_array($request->product_image)){


        if (count($request->product_image) > 0) {
            foreach ($request->product_image as $product_image) {
                $image = rand() . '.' . $product_image->getClientOriginalExtension();
                $path = public_path('images/products/' . $image);
                Image::make($product_image)->save($path);


                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $image;
                $productImage->save();
            }
        }
    }
    return back()->with('success','Product Added Successful.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $product = Product::findOrFail($id);
        $cat_id = $product->category_id;
        $category = Category::findOrFail($cat_id);
        $bnd_id = $product->brand_id;
        $brand = Brand::findOrFail($bnd_id);
        $categories = Category::select('name','id')->orderBy('name')->get();
        $brands = Brand::select('name','id')->orderBy('name')->get();
        return view('pages.admin.product.edit_product', compact('product','category','brand','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $request->validate([
            'title' => 'required  | max:100',
            'description' => 'nullable | max:255',
            'quantity' => 'required | numeric',
            'category_id' => 'required | numeric',
            'brand_id' => 'required | numeric',
            'price' => 'required | numeric',
            'display_image' => 'image '
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = str_slug($request->title);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->status = 1;
        $product->offer_price = 1000;

        if($request->hasFile('display_image')){
            if(File::exists('images/products/display_image/'.$product->display_image)){
                File::delete('images/products/display_image/'.$product->display_image);
            }
            $display_image = $request->file('display_image');
            $image = rand().'.'.$display_image->getClientOriginalExtension();
            $path = public_path('images/products/display_image/'.$image);
            Image::make($display_image)->save($path);

            $product->display_image = $image;
            
        }

        if(is_array($request->product_image)){


        if (count($request->product_image) > 0) {
            foreach ($request->product_image as $product_image) {
                $image = rand() . '.' . $product_image->getClientOriginalExtension();
                $path = public_path('images/products/' . $image);
                Image::make($product_image)->save($path);


                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $image;
                $productImage->save();
            }
        }
    }
        
        $product->save();
        
        return redirect()->route('admin_page.products')->with('success','Product Update Successful.');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $productImage = ProductImage::where('product_id',$product->id)->get();
        foreach ($productImage as $pImage) {
         if(File::exists('images/products/'.$pImage->image)){
            File::delete('images/products/'.$pImage->image);
        }
        $pImage->delete();
    }
    if(File::exists('images/products/display_image/'.$product->display_image)){
        File::delete('images/products/display_image/'.$product->display_image);
    }
    $product->delete();
    return redirect()->route('admin_page.products')->with('success', 'Product Delete Successful.');
}


public function products() {
    $products = Product::all();
    return view('pages.admin.product.all_product', compact('products'));
}
public function imgDelete(Request $request,$id){
    $product_id = $request->product_id;
    $product_image = ProductImage::findOrFail($id);
    if(File::exists('images/products/'.$product_image->image)){
        File::delete('images/products/'.$product_image->image);
    }
    $product_image->delete();

    return redirect()->route('admin_page.edit',$product_id)->with('success', 'Image Delete Successful.');
}

}
