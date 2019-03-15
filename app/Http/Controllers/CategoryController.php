<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\CategoryManager;
use Illuminate\Http\Request;
use Image;
use File;

class CategoryController extends Controller {

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
        $categories = Category::orderBy('name')->get();
        return view('pages.admin.category.all_categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create() {
        $categoryName = Category::all('name','id');
        return view('pages.admin.category.create_category',compact('categoryName'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required  | max:100',
            'description' => 'nullable | max:255',
            'category_image' => ' nullable|image '
        ],
        [
            'name.max' => 'Name Field is require. And not more than 100 character',
            'name.required' => 'Name Field is require.'
        ]);

        $category = new Category();

        if ($request->hasFile('category_image')) {
            $category_image = $request->file('category_image');
            $image = rand() . '.' . $category_image->getClientOriginalExtension();
            $path = public_path('images/categories/' . $image);
            Image::make($category_image)->save($path);
            $category->image = $image;
        }
        
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        $category->save();
//Category Manager
        // $categoryManager = new CategoryManager();
        // $categoryManager->category_id = $category->id;
        // $categoryManager->parend_id = $request->parent_id;
        // $categoryManager->save();

        // if($request->input('parent_id') > 0){

        //     $categoryManager2 = new CategoryManager();
        //     $categoryManager2->category_id = $request->parent_id;
        //     $categoryManager2->child_id = $categoryManager->category_id;
        //     $categoryManager2->save();
        // }


        return back()->with('success', 'Category Added Successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
     $category = Category::findOrFail($id);
     return view('pages.admin.category.show_category', compact('category'));
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $category = Category::findOrFail($id);
        $categoryName = Category::all('name','id');
        return view('pages.admin.category.edit_category', compact('category','categoryName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
     $request->validate([
        'name' => 'required  | max:100',
        'description' => 'nullable | max:255',
        'category_image' => ' nullable|image '
    ]);
     $category = Category::findOrFail($id);
     $category->name = $request->name;
     $category->description = $request->description;
     $category->parent_id = $request->parent_id;
     if ($request->hasFile('category_image')) {
        if(File::exists('images/categories/'.$category->image)){
            File::delete('images/categories/'.$category->image);
        }

        $category_image = $request->file('category_image');
        $image = rand() . '.' . $category_image->getClientOriginalExtension();
        $path = public_path('images/categories/' . $image);
        Image::make($category_image)->save($path);
    }else{
        $image = $category->image;
    }
    $category->image = $image;
    $category->save();
    return redirect()->route('categories.index')->with('success', 'Category Update Successful.');


}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $childCategory = Category::where('parent_id',$category->id)->get();
        if(File::exists('images/categories/'.$category->image)){
            File::delete('images/categories/'.$category->image);
        }
        if($childCategory != null){
            foreach ($childCategory as $child) {
                $doubleChild = Category::where('parent_id',$child->id)->get();
                if($doubleChild != null){
                    foreach ($doubleChild as $dChild) {
                        if(File::exists('images/categories/'.$dChild->image)){
                            File::delete('images/categories/'.$dChild->image);
                        }
                        $trippleChild = Category::where('parend_id',$dChild)->get();
                        if($trippleChild != null){
                            foreach ($trippleChild as $tChild) {
                                if(File::exists('images/categories/'.$tChild->image)){
                                    File::delete('images/categories/'.$tChild->image);
                                }
                                $tChild->delete();
                            }
                        }

                        $dChild->delete();
                    }
                }
                if(File::exists('images/categories/'.$child->image)){
                    File::delete('images/categories/'.$child->image);
                }

                $child->delete();
            }
        }
        $category->delete();
        return back()->with('success', 'Categories Delete Successful.');
    }

}
