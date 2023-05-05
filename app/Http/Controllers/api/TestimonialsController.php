<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialsResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimonialsController extends Controller
{
    public function products(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
            ];
            return response()->json($resArr);
        }
        $products = Products::orderBy('id', 'asc')->get();
        if($products){
            $resArr = [
                'status' => true,
                'data' => ProductsResource::collection($products),
            ];
            return response()->json($resArr);
        }else{
            $resArr = [
                'status' => false,
            ];
            return response()->json($resArr);
        }
    }
    public function productDetails(Request $request, Products $product){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }
        if($product){
            $resArr = [
                'status' => true,
                'data' => new ProductsResource($product),
            ];
            return response()->json($resArr, Response::HTTP_OK);
        }else{
            $resArr = [
                'status' => false,
                'data' => []
            ];
            return response()->json($resArr, Response::HTTP_NOT_FOUND);
        }
    }
    public function review(Request $request, Products $product){
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => false,
          'message' => trans('api.pleaseSendLangCode'),
          'data' => []
        ];
        return response()->json($resArr);
      }
      $request->validate([
        'review' => 'required',
      ]);
      $data = $request->except('_token');
      $product['review'] = $data['review'];
      $review = $product->update();
      if ($review) {
        $resArr = [
          'status' => true,
          'data' => new ProductsResource($product),
        ];
        return response()->json($resArr, Response::HTTP_OK);
      } else {
        $resArr = [
          'status' => false,
          'data' => []
        ];
        return response()->json($resArr, Response::HTTP_NOT_FOUND);
      }
    }
}
