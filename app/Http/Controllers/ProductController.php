<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function getCategory($slug, $subslug = '')
    {
        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = SubCategory::getSingleSlug($subslug);
        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        if(!empty($getCategory) && !empty($getSubCategory))
        {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;

            $data['getProduct'] = Product::getproduct($getCategory->id, $getSubCategory->id);

            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);
            
            return view('product.list',$data);
        }

        else if(!empty($getCategory))
        {
            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);
            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            $data['getProduct'] = Product::getproduct($getCategory->id);

            return view('product.list',$data);
        }
        else
        {
            abort(404);
        }

    }

    public function getFilterProductAjax(Request $request)
    {
        $getProduct = Product::getproduct();
        return response()->json([
            "status" => true,
            "success" => view("product._list",[
                "getProduct" => $getProduct
            ])->render(),
        ], 200);
    }
}
