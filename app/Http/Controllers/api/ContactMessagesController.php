<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessages;
use Response;

class ContactMessagesController extends Controller
{
    public function sendContactMessage(Request $request)
    {
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => false,
                'message' => trans('api.pleaseSendLangCode'),
            ];
            return response()->json($resArr);
        }

        $rules = [
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'message' => 'required|string'
                ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => false,
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token']);

        $message = ContactMessages::create($data);
        if ($message) {
            $resArr = [
                'status' => true,
                'message' => trans('api.yourDataHasBeenSentSuccessfully'),
            ];
        } else {
            $resArr = [
                'status' => false,
                'message' => trans('api.someThingWentWrong'),
            ];
        }
        return response()->json($resArr);

    }
}
