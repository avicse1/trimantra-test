<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Session;
use DB;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('product.product_list', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('product.add_product', compact('categories'));
    }

    public function store(Request $request) {
        // validation
        $validatedData = $request->validate([
            'name' => 'required',
            // 'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|not_in:0',
        ]);

        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        if ($request->hasFile('image')) {
            $imageName = str_random(10).time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }
        $product->save();

        Session::flash('success', 'Product added successfully!');

        return redirect()->back();
    }

    public function show($id) {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit_product', compact('product', 'categories'));
    }

    public function edit(Request $request, $id) {
        // validation
        $validatedData = $request->validate([
            'name' => 'required',
            // 'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|not_in:0',
        ]);

        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;

        if ($request->hasFile('image')) {
            $imageName = str_random(10).time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        Session::flash('success', 'Product Updated successfully!');

        return redirect()->route('product_list');
    }

    public function delete($id) {
        Product::destroy($id);
        Session::flash('success', 'Category deleted successfully!');
        return redirect()->back();        
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("products")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
