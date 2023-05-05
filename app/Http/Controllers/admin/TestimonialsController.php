<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\testimonial\StoreRequest;
use App\Http\Requests\testimonial\UpdateRequest;
use App\Models\Testimonial;
use File;
use Illuminate\Http\Request;
use Response;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::paginate(25);
        return view('AdminPanel.testimonials.index',[
            'active' => 'testimonials',
            'title' => trans('common.testimonials'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.testimonials')
                ]
            ]
        ],compact('testimonials'));
    }
    public function store(StoreRequest $request){
        $testimonial = Testimonial::create($request->validated());
        if($request->hasFile('image')){
            $testimonial['image'] = upload_image('testimonials/'.$testimonial->id , $request->image );
             $testimonial->update();
        }
        if($testimonial){
            return redirect()->route('admin.testimonials')
                            ->with('success',trans('common.successMessageText'));
        }else{
            return redirect()->back()
                            ->with('failed',trans('common.faildMessageText'));
        }
    }
    public function update(UpdateRequest $request, Testimonial $testimonial){
        $testimonial->update($request->except('_token','image'));
        if($request->hasFile('image')){
            if($testimonial->image != '' && file_exists(public_path('uploads/Testimonials/'.$testimonial->id.'/'.$testimonial->image))){
                unlink(public_path('uploads/Testimonials/'.$testimonial->id.'/'.$testimonial->image));
            }
            $testimonial['image'] = upload_image('Testimonials/'.$testimonial->id , $request->image );
            $testimonial->update();
        }
        if($testimonial){
            return redirect()->route('admin.testimonials')
                                ->with('success', trans('common.successMessageText'));
        }else{
            return redirect()->back()
                                ->with('failed', trans('common.faildMessageText'));
        }
    }
    public function delete(Testimonial $testimonial){

        if($testimonial->image != ''){
            File::deleteDirectory(public_path('uploads/testimonials/'.$testimonial->id),);
        }
        if($testimonial->delete()){
            return Response::json($testimonial->id);
        }else{
            return Response::json("false");
        }
    }
}
