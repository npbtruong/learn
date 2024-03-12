<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    static public function getCategories(){
        return self::select('categories.*','users.name as created_by_name')
        ->join('users', 'users.id', '=', 'categories.created_by')
        ->where('categories.is_delete','=',0)
        ->orderBy('categories.id','desc')
        ->get();
    }

    static function getSingle($id){
        return self::find($id);
    }
}
