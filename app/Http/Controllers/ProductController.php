<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('category_id')->get();
        return view('pages.products.index', compact('products'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function searchProduct(Request $request){
        $value = $request->value;
        $products = Product::orWhere('title','like','%'.$value.'%')
        ->orWhere('description','like','%'.$value.'%')
        ->orWhere('slug','like','%'.$value.'%')
        ->orWhere('price','like','%'.$value.'%')
        ->orWhere('quantity','like','%'.$value.'%')->get();

        $cat = Category::select('*')->where('name','like','%'.$value.'%')->get();
        $cat_id = 0;
        foreach ($cat as $id) {
          $cat_id = $id->id;
        }
        $categoryProduct="";
        if($cat_id>0){
            $categoryProduct = Product::select('*')->where('category_id',$cat_id)->get();
            
        }
        $brand = Brand::select('*')->where('name','like','%'.$value.'%')->get();
        $brand_id = 0;
        foreach ($brand as $id) {
          $brand_id = $id->id;
        }
        $brandProduct="";
        if($brand_id>0){
            $categoryProduct = Product::select('*')->where('brand_id',$brand_id)->get();
            
        }
        return view('pages.products.search_product',compact('products','value','categoryProduct','brandProduct'));
    }

    public function categorySearch($id){
        $category = Category::findOrFail($id);
        $categoryProduct = Product::select('*')->where('category_id',$id)->get();
         return view('pages.products.category_product',compact('categoryProduct','category'));
    }
    public function brandSearch($id){
        $brand = Brand::findOrFail($id);
        $brandProduct = Product::select('*')->where('brand_id',$id)->get();
         return view('pages.products.brand_product',compact('brandProduct','brand'));

    }
}
