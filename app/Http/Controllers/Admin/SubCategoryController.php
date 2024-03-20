<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = SubCategory::getSubcategories();
        $data['header_title'] = 'Sub Category';
        return view('admin.subcategory.list', $data);
    }

    public function add(){
        $data['getCategory'] = Category::getCategories();
        $data['header_title'] = 'Add New Sub Category';
        return view('admin.subcategory.add', $data);
    }

    public function insert(Request $request){
        request()->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        $subcategory = new SubCategory();
        $subcategory->name = trim($request->name);
        $subcategory->status = trim($request->status);
        $subcategory->slug = trim($request->slug);

        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Sub Category added successfully');
    }

    public function edit($id){
        $data['getCategory'] = Category::getCategories();
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['header_title'] = 'Edit Sub Category';
        return view('admin.subcategory.edit', $data);
    }

    public function update($id, Request $request){

        request()->validate([
            'slug' => 'required|unique:sub_categories,slug,'.$id,
        ]);

        $subcategory = SubCategory::getSingle($id);
        $subcategory->name = trim($request->name);
        $subcategory->status = trim($request->status);
        $subcategory->slug = trim($request->slug);

        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect('admin/sub_category/list')->with('success', 'Sub Category Successfully Updated');
    }

    public function delete($id)
    {
        $subcategory = SubCategory::getSingle($id);
        $subcategory->is_delete = 1;
        $subcategory->save();
        return redirect()->back()->with('success', 'Sub Category Successfully Deleted');
    }

    public function get_sub_category(Request $request)
    {
        $category_id = $request->id;
        $get_sub_category = SubCategory::getRecordSubCategory($category_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($get_sub_category as $row) {
            $html .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        
        $json['html'] = $html;
        echo json_encode($json);
    }

}
