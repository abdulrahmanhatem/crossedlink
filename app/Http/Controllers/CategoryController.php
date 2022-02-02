<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use Hash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(500);
        $data = array(
            'categories' => $categories, 
            'search' => '', 
        );
        return view('dashboard.categories.index')->with($data);
    }
    
    public function search(Request $request)
    {
        $name = $request->input('search');
        $categories = Category::where('name', 'LIKE', "%".$name."%")->orWhere('name_ar', 'LIKE', "%".$name."%" )->paginate(100);
        $data = array(
            'categories' => $categories, 
            'search' => $name, 
        );
        return view('dashboard.categories.index')->with($data);
        
    }

    public function companies()
    {
        $categories = Category::whereIn('role', [2, 3])->orderBy('name', 'asc')->paginate(500);
        $data = array(
            'categories' => $categories, 
        );
        return view('dashboard.categories.companies')->with($data);
    }

    public function personal()
    {
        $categories = Category::whereIn('role', [1, 3])->orderBy('name', 'asc')->paginate(500);
        $data = array(
            'categories' => $categories, 
        );
        return view('dashboard.categories.personal')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
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
            'name' => 'required',
            'name_ar' => 'required',
            'role' => 'required',
            /*'number' => 'required',*/
        ]);

        // Create category
        $category = new Category;
        $category->role = $request->input('role');
        $category->name = $request->input('name');
        $category->name_ar = $request->input('name_ar');
        $category->icon = $request->input('icon');
        $category->save();
        return Redirect::back()->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $data = array(
            'category' => $category
        );
        return view('dashboard.categories.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $data = array(
            'category' => $category
        );
        return view('dashboard.categories.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'name' => 'required',
            'name_ar' => 'required',
            'role' => 'required',
        ]);
        
        // Create category
        $category = Category::find($id);
        $category->role = $request->input('role');
        $category->name = $request->input('name');
        $category->name_ar = $request->input('name_ar');
        $category->icon = $request->input('icon');
        $category->save();
        return Redirect::back()->with('success', 'Category Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete category
        $category = Category::find($id);

        $category->delete();

        return Redirect::to('dashboard/categories')->with('success', 'Category Deleted');
    }

    
}
