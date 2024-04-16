<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    static public function getproducts(){
        return self::select('products.*','users.name as created_by_name')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->where('products.is_delete','=',0)
        ->orderBy('products.id','desc')
        ->paginate(4);
        
    }

    static public function getproduct($category_id = '', $subcategory_id = ''){
        $return = self::select('products.*','users.name as created_by_name', 'sub_categories.name as sub_category_name', 'sub_categories.slug as sub_category_slug', 'categories.name as category_name', 'categories.slug as category_slug')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id');
        if(!empty($category_id)){
            $return = $return->where('products.category_id','=',$category_id);
        }
        if(!empty($subcategory_id)){
            $return = $return->where('products.sub_category_id','=',$subcategory_id);
        }
        //#35
        if(!empty(Request::get('sub_category_id'))){
            $sub_category_id = rtrim(Request::get('sub_category_id'),',');
            
            $sub_category_id_array = explode(',',$sub_category_id);

            $return = $return->whereIn('products.sub_category_id',$sub_category_id_array);
        }
        
        if(!empty(Request::get('color_id'))){
            $color_id = rtrim(Request::get('color_id'),',');
            
            $color_id_array = explode(',',$color_id);
            $return = $return->join('product_colors', 'product_colors.product_id', '=', 'products.id');
            $return = $return->whereIn('product_colors.color_id',$color_id_array);
        }

        if(!empty(Request::get('brand_id'))){
            $brand_id = rtrim(Request::get('brand_id'),',');
            
            $brand_id_array = explode(',',$brand_id);

            $return = $return->whereIn('products.brand_id',$brand_id_array);
        }
        //#35
        $return = $return->where('products.is_delete','=',0)
        ->where('products.status','=',0)
        ->groupBy('products.id')
        ->orderBy('products.id','desc')
        ->paginate(3);

        return $return;
        
    }

    static public function getImageSingle($product_id)
    {
        return ProductImage::where('product_id','=',$product_id)->orderBy('order_by','asc')->first();
    }

    static function getSingle($id){
        return self::find($id);
    }

    static function checkSlug($slug){
        return self::where('slug','=',$slug)->count();
    }

    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function getSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function getImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by','asc');
    }
}
