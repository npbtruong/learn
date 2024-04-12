<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    static public function getSubcategories(){
        return self::select('sub_categories.*','users.name as created_by_name','categories.name as category_name')
        ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->join('users', 'users.id', '=', 'sub_categories.created_by')
        ->where('sub_categories.is_delete','=',0)
        ->orderBy('sub_categories.id','desc')
        ->paginate(5);
        
    }

    static public function getRecordSubCategory($category_id){
        return self::select('sub_categories.*')
        ->join('users', 'users.id', '=', 'sub_categories.created_by')
        ->where('sub_categories.is_delete','=',0)
        ->where('sub_categories.status','=',0)
        ->where('sub_categories.category_id','=', $category_id)
        ->orderBy('sub_categories.name','asc')
        ->get();
        
    }

    static function getSingle($id){
        return self::find($id);
    }

    static function getSingleSlug($slug){
        return self::where('slug', '=', $slug)
                ->where('sub_categories.is_delete','=',0)
                ->where('sub_categories.status','=',0)->first();
    }

    public function totalProducts()
    {
        return $this->hasMany(Product::class, 'sub_category_id')
            ->where('is_delete', 0)
            ->where('status', 0)
            ->count();
    }
}
