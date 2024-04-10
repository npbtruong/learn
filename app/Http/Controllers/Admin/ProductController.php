<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\SubCategory;
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
            $data['getSubCategory'] = SubCategory::getRecordSubCategory($product->category_id);
            $data['header_title'] = 'Edit Product';
            return view('admin.product.edit', $data);
        }
    }

    public function update($product_id, Request $request)
    {

        $product = Product::getSingle($product_id);
        if(!empty($product))
        {           

            $product->title = trim($request->title);
            $product->sku = trim($request->sku);
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->price = trim($request->price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additonal_infomation);
            $product->shipping_returns = trim($request->shipping_returns);
            $product->status = trim($request->status);
            $product->save();

            ProductColor::DeleteRecord($product->id);

            if(!empty($request->color_id)){
                foreach($request->color_id as $color_id){
                    $product_color = new ProductColor;
                    $product_color->product_id = $product->id;
                    $product_color->color_id = $color_id;
                    $product_color->save();
                }
            }

            ProductSize::DeleteRecord($product->id);

            if(!empty($request->size)){
                foreach($request->size as $size)
                {
                    
                    if(!empty($size['name']))
                    {
                        $product_size = new ProductSize;
                        $product_size->name = $size['name'];
                        $product_size->price = !empty($size['price']) ? $size['price'] : 0;
                        $product_size->product_id = $product->id;
                        $product_size->save();
                    }
                }
            }


            if(!empty($request->file('image')))
            {
                foreach($request->file('image') as $value)
                {
                    if($value->isValid())
                    {
                        $ext = $value->getClientOriginalExtension();
                        $randomStr = $product->id.Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;
                        $value->move('upload/product/', $filename);
                        //$value->storeAs('upload/product/', $filename);
                        $imageupload = new ProductImage;
                        $imageupload->product_id = $product->id;
                        $imageupload->image_name = $filename;
                        $imageupload->image_extension = $ext;

                        $imageupload->save();

                    }
                }
            }

            
            return redirect()->back()->with('success', 'Product updated successfully');
            
        }
        else{
            abort(404);
        }
        
    }

    public function delete($id)
    {
        //
        $product = Product::getSingle($id);
        $product->is_delete = 1;
        $product->save();
        
        return redirect()->back()->with('success', 'Product successfully Deleted');
    }

    public function image_delete($id)
    {
        //
        $image = ProductImage::getSingle($id);
        if(!empty($image->getLogo()))
        {
           unlink('upload/product/'.$image->image_name);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Product Image successfully Deleted');
    }

    public function product_image_sortable(Request $request)
    {
        //
        if(!empty($request->photo_id))
        {
            $i = 1;
            foreach($request->photo_id as $photo_id)
            {
                $image = ProductImage::getSingle($photo_id);
                $image->order_by = $i;
                $image->save();

                $i++;
            }
        }

        $json['success'] = true;
        echo json_encode($json);
    }

}
