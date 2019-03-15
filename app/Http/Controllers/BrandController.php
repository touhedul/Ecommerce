<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $brands = Brand::orderBy('name')->get();
        return view('pages.admin.brand.all_brand', compact('brands'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryNameId = Category::all('name','id');
        return view('pages.admin.brand.create_brand',compact('categoryNameId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $request->validate([
        'name' => 'required  | max:100',
        'category_id' => 'required|numeric'
    ]);
     $brand = new Brand();

     $brand->name = $request->name;
     $brand->category_id = $request->category_id;

     $brand->save();
     return back()->with('success', 'Brand Added Successful.');
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\app\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\app\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $categoryNameId = Category::all('name','id');
        return view('pages.admin.brand.edit_brand', compact('brand','categoryNameId'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\app\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate([
            'name' => 'required  | max:100',
            'category_id' => 'required|numeric'
        ]);
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;

        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand Update Successful.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\app\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);        
        $brand->delete();
        return back()->with('success', 'Brand Delete Successful.');
    }
}
