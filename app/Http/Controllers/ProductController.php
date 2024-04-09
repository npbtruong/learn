<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function getCategory($slug, $subslug = '')
    {
        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = subCategory::getSingleSlug($subslug);
        if(!empty($getCategory) && !empty($getSubCategory))
        {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;
            return view('product.list',$data);
        }

        else if(!empty($getCategory))
        {
            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            return view('product.list',$data);
        }
        else
        {
            abort(404);
        }

    }
}
