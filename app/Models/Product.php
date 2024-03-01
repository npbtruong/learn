<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    static public function getproducts(){
        return self::select('products.*','users.name as created_by_name')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->where('products.is_delete','=',0)
        ->orderBy('products.id','desc')
        ->get();
    }

    static function getSingle($id){
        return self::find($id);
    }

    static function checkSlug($slug){
        return self::where('slug','=',$slug)->count();
    }
}
