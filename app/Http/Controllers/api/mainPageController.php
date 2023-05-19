<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\mainPage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class mainPageController extends Controller
{
    public function index(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }
        // $data = mainPage::select('id','title_'.$lang.' as title','description_'.$lang.' as description','image')->get();
        $mainPages = mainPage::get();
        $data = [];
        foreach($mainPages as $mainPage){
            $data [] = $mainPage->apiData($lang);
        }
        return response()->json(['status'=> true, 'data'=>$data], Response::HTTP_OK);

    }
}
