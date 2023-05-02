<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQs;
use App\Models\Settings;
use App\Models\Currencies;
use App\Models\Countries;
use App\Models\Pages;
use Response;

class StaticPagesController extends Controller
{

    public function mainpage(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }
        $dely = 400;
        $boxes = [];
        for($i = 1; $i <=6 ; $i++ ){
          $boxes[] = [
            'title' => getSettingValue('feature_'.$i.'title_'.$lang),
            'desc' => getSettingValue('feature_'.$i.'des_'.$lang),
            'icon' => getSettingImageLink('feature'.$i.'icon'),
            'delay' => $dely,
          ];
          $dely = $dely + 200;
        }
        $detailsDely = 400;
        $details = [];
        for($i = 1; $i <=4 ; $i++ ){
          $details[] = [
            'title' => getSettingValue('details_'.$i. 'title_'.$lang),
            'number' => getSettingValue('details_'.$i.'number'),
            'delay' => $detailsDely,
          ];
          $detailsDely = $detailsDely + 200;
        }
        $list = [
            'general' => [
                'title' => getSettingValue('siteTitle_'.$lang),
                'description' => getSettingValue('siteDescription'),
                'logo' => getSettingImageLink('logo'),
            ],
            'mainpage' => [
                'title' => getSettingValue('mainPageTitle_'.$lang),
                'description' => getSettingValue('mainPageTitle_'.$lang),
                'image1' => getSettingImageLink('mainPageImage1'),
                'image2' => getSettingImageLink('mainPageImage2'),
            ],
            'features' => [
                'title' => getSettingValue('featureTitle_'.$lang),
                'description' => getSettingValue('featureDes_'.$lang),
                'image' => getSettingImageLink('featureImage'),
                'boxes' => $boxes,
            ],
            'details' => [
                'image' => getSettingImageLink('detailsImage'),
                'details' => $details,
            ],
        ];
        $resArr = [
            'status' => true,
            'data' => $list
        ];
        return response()->json($resArr);
    }
    public function contactus(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }
        $list = [
            'contactus' => [
                'name' => getSettingValue('contactusName'),
                'email' => getSettingValue('contactusEmail'),
                'phone' => getSettingValue('contactusPhone'),
                'address' => getSettingValue('contactusAddress'),
                'message' => getSettingValue('contactusMessage'),
            ],
            'followUs' => [
                'facebook' => getSettingValue('facebook'),
                'youtube' => getSettingValue('youtube'),
                'twitter' => getSettingValue('twitter'),
                'instagram' => getSettingValue('instagram'),
                'linkedin' => getSettingValue('linkedin'),
                'whatsapp' => getSettingValue('whatsapp'),
                'tiktok' => getSettingValue('tiktok'),
                'snapchat' => getSettingValue('snapchat'),
            ]
        ];
        $resArr = [
            'status' => true,
            'data' => $list
        ];
        return response()->json($resArr);
    }

    public function aboutus(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
            ];
            return response()->json($resArr);
        }
        $list = [
            'aboutus' => [
                'title' => getSettingValue('aboutusTitle_'.$lang),
                'description' => getSettingValue('aboutusDes_'.$lang),
                'image' => getSettingImageLink('aboutusImage'),
            ]
        ];
        $resArr = [
            'status' => true,
            'data' => $list
        ];
        return response()->json($resArr);
    }


}
