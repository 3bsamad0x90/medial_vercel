<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\blog\StoreblogRequest;
use App\Http\Requests\blog\UpdateblogRequest;
use App\Models\Blog;
use File;
use Illuminate\Http\Request;
use Response;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(25);
        return view('AdminPanel.blogs.index', [
            'active' => 'blogs',
            'title' => trans('common.blog'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.blog')
                ]
            ]
        ], compact('blogs'));
    }
    public function store(StoreblogRequest $request)
    {
        $data = $request->except('_token', 'image', 'images');
        $blog = Blog::create($data);
        if ($request->hasFile('image')) {
            $blog['image'] = upload_image('blogs/' . $blog->id, $request->image);
            $blog->update();
        }
        $images = [];
        if ($files = $request->file('images')) {
            foreach ($files as $image) {
                $imageData = upload_image('blogs/' . $blog->id, $image);
                $images[] = $imageData;
            }
            $blog['images'] = json_encode($images);
            $blog->update();
        }
        if ($blog) {
            return redirect()->route('admin.blogs')
            ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }
    public function update(UpdateblogRequest $request, Blog $blog)
    {
        $blog->update($request->except('_token', 'image'));
        if ($request->hasFile('image')) {
            unlink('uploads/blogs/' . $blog->id . '/' . $blog->image);
            $blog['image'] = upload_image('blogs/' . $blog->id, $request->image);
            $blog->update();
        }
        if ($blog) {
            return redirect()->route('admin.blogs')
            ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }
    public function updateImages(Request $request, Blog $blog)
    {
        $request->validate(
            [
                'images.*' => 'mimes:png,jpg,jpeg, webp',
            ],
            [
                'images.mimes' => 'يجب ان تكون الصورة من نوع png, jpg, jpeg, webp',
                'images.*.mimes' => 'يجب ان تكون الصورة من نوع png, jpg, jpeg,  webp',
            ]
        );
        $oldImage = $request['image_hidden'] ?? [];
        $allImages = [];
        if ($files = $request->File('images')) {
            $allImages += $oldImage;
            foreach ($files as $image) {
                $imageData = upload_image('blogs/' . $blog->id, $image);
                $allImages[] = $imageData;
            }
            $data['images'] = json_encode($allImages);
        } else {
            $data['images'] = json_encode($oldImage);
        }
        $blog->images = $data['images'];
        $updateImages = $blog->update();
        if ($updateImages) {
            return redirect()->route('admin.blogs')
            ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }
    public function delete(Blog $blog)
    {
        if ($blog->image != '') {
            File::deleteDirectory(public_path('uploads/blogs/' . $blog->id),);
        }
        if ($blog->delete()) {
            return Response::json($blog->id);
        }else {
            return Response::json("false");
        }
    }
}
