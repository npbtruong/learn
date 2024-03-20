<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Product::getProducts();
        $data['header_title'] = 'Product';
        return view('admin.product.list', $data);
    }

    public function add(){
        $data['header_title'] = 'Add New Product';
        return view('admin.product.add', $data);
    }

    public function insert(Request $request){

        $title = trim($request->title);
        $product = new Product;
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        $product->save();

        $slug = Str::slug($title, "-");

        $checkSlug = Product::checkSlug($slug);
        if (empty($checkSlug)){
            $product->slug = $slug;
            $product->save();
            
        }else{
            $new_slug = $slug.'-'.$product->id;
            $product->slug = $new_slug;
            $product->save();
        }

        return redirect('admin/product/edit/'.$product->id)->with('success', 'Product added successfully');
    }

    public function edit($product_id){
        
        $product = Product::getSingle($product_id);
        if(!empty($product)){
            $data['getCategory'] = Category::getCategoriesActive();
            $data['getBrand'] = Brand::getRecordActive();
            $data['getColor'] = Color::getRecordActive();
            $data['product'] = $product;
            $data['header_title'] = 'Edit Product';
            return view('admin.product.edit', $data);
        }
    }

}
