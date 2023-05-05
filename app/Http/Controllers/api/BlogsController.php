<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\blog\BlogsResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
            ];
            return response()->json($resArr);
        }
        $blogs = Blog::orderBy('id', 'asc')->get();
        if ($blogs) {
            $resArr = [
                'status' => true,
                'data' => BlogsResource::collection($blogs),
            ];
            return response()->json($resArr);
        } else {
            $resArr = [
                'status' => false,
            ];
            return response()->json($resArr);
        }
    }
    public function show(Request $request, Blog $media){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
            ];
            return response()->json($resArr);
        }
        if($media){
            $resArr = [
                'status' => true,
                'data' => $media->apiData($lang)
            ];
            return response()->json($resArr);
        }

    }
}
