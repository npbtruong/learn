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
            $data['getSubCategory'] = $getSubCategory;
            $data['getCategory'] = $getCategory;
            return view('product.list',$data);
        }

        else if(!empty($getCategory))
        {
            $data['getCategory'] = $getCategory;
            return view('product.list',$data);
        }
        else
        {
            abort(404);
        }

    }
}
