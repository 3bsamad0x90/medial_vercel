<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\mainPage\StoreRequest;
use App\Http\Requests\mainPage\UpdateRequest;
use App\Models\mainPage;
use Illuminate\Http\Request;
use Response;
use File;

class mainPageController extends Controller
{
    public function index()
    {
        $mainPages = mainPage::paginate(5);
        return view('AdminPanel.mainPages.index', [
            'active' => 'mainPage',
            'title' => trans('common.mainPage'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.mainPage')
                ]
            ]
        ], compact('mainPages'));
    }
    public function store(StoreRequest $request)
    {
        $mainPage = mainPage::create($request->validated());
        if ($request->hasFile('image')) {
            $mainPage['image'] = upload_image('mainPage/' . $mainPage->id, $request->image);
            $mainPage->update();
        }
        if ($mainPage) {
            return redirect()->route('admin.mainPages')
            ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }
    public function update(UpdateRequest $request, mainPage $mainPage)
    {
        $mainPage->update($request->except('_token', 'image'));
        if ($request->hasFile('image')) {
            if ($mainPage->image != '' && file_exists(public_path('uploads/mainPage/' . $mainPage->id . '/' . $mainPage->image))) {
                unlink(public_path('uploads/mainPage/' . $mainPage->id . '/' . $mainPage->image));
            }
            $mainPage['image'] = upload_image('mainPage/' . $mainPage->id, $request->image);
            $mainPage->update();
        }
        if ($mainPage) {
            return redirect()->route('admin.mainPages')
            ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }
    public function delete(mainPage $mainPage)
    {
        if ($mainPage->image != '') {
            File::deleteDirectory(public_path('uploads/mainPage/' . $mainPage->id),);
        }
        if ($mainPage->delete()) {
            return Response::json($mainPage->id);
        } else {
            return Response::json("false");
        }
    }
}
