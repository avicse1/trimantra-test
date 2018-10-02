<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
class CategoryController extends Controller
{
    public function index() {
        // Category List
        $categories = Category::all();
        return view('category_list', compact('categories'));
    }

    public function create() {
        return view('add_category');
    }

    public function store(Request $request) {
        // validation
        $validatedData = $request->validate([
            'name' => 'required',
            // 'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $category = new Category;

        $category->name = $request->name;

        $imageName = str_random(10).time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        $category->image = $imageName;

        $category->save();

        Session::flash('success', 'Category added successfully!');

        return redirect()->back();
    }

    public function show($id) {
        $category = Category::find($id);
        return view('edit_category', compact('category'));
    }

    public function edit(Request $request, $id) {
        // validation
        $validatedData = $request->validate([
            'name' => 'required',
            // 'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $category = Category::find($id);

        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $imageName = str_random(10).time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        }
        $category->save();

        Session::flash('success', 'Category Updated successfully!');

        return redirect()->route('category_list');
    }

    public function delete($id) {
        Category::destroy($id);
        Session::flash('success', 'Category deleted successfully!');
        return redirect()->back();
    }
}
