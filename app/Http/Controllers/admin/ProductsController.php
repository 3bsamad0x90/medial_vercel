<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\StoreRequest;
use App\Http\Requests\product\UpdateRequest;
use App\Models\Products;
use File;
use Illuminate\Http\Request;
use Response;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::paginate(25);
        return view('AdminPanel.products.index',[
            'active' => 'products',
            'title' => 'المنتجات',
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'المنتجات'
                ]
            ]
        ],compact('products'));
    }
    public function store(StoreRequest $request){
        $product = Products::create($request->validated());
        if($request->hasFile('image')){
            $product['image'] = upload_image_without_resize('products/'.$product->id , $request->image );
             $product->update();
        }
        if($product){
            return redirect()->route('admin.products')
                            ->with('success','تم حفظ البيانات بنجاح');
        }else{
            return redirect()->back()
                            ->with('failed','لم نستطع حفظ البيانات');
        }
    }
    public function update(UpdateRequest $request, Products $product){
        $product->update($request->except('_token','image'));
        if($request->hasFile('image')){
            if($product->image != '' && file_exists(public_path('uploads/products/'.$product->id.'/'.$product->image))){
                unlink(public_path('uploads/products/'.$product->id.'/'.$product->image));
            }
            $product['image'] = upload_image_without_resize('products/'.$product->id , $request->image );
            $product->update();
        }
        if($product){
            return redirect()->route('admin.products')
                            ->with('success','تم تعديل البيانات بنجاح');
        }else{
            return redirect()->back()
                            ->with('failed','لم نستطع تعديل البيانات');
        }
    }
    public function delete(Products $product){

        if($product->image != ''){
            File::deleteDirectory(public_path('uploads/products/'.$product->id),);
        }
        if($product->delete()){
            return Response::json($product->id);
        }else{
            return Response::json("false");
        }
    }
}
