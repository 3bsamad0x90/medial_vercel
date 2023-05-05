<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimonialsController extends Controller
{
    public function testimonials(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
            ];
            return response()->json($resArr);
        }
        $testimonials = Testimonial::orderBy('id', 'asc')->get();
        $resArr = [];
        foreach($testimonials as $testimonial){
            $resArr [] = $testimonial->apiData($lang);
        }
        if($testimonials){
            return response()->json(['status' => true, 'data'=> $resArr], Response::HTTP_OK);
        }else{
            return response()->json(['status'=> false, 'data' => trans('common.nothingToView')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function testimonialsDetails(Request $request, Testimonial $testimonial){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }
        if($testimonial){
            return response()->json(['status'=> true, 'data' =>$testimonial->apiData($lang) ], Response::HTTP_OK);
        }else{
            return response()->json(['status' => true, 'data' => trans('common.nothingToView') ], Response::HTTP_NOT_FOUND);
        }
    }
}
