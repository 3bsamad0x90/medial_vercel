<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'image',
        'images',
    ];
    public function photoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
        if ($this->image != '') {
            $image = asset('uploads/blogs/' . $this->id . '/' . $this->image);
        }
        return $image;
    }
    public function apiData($lang){
        $images = [];
        foreach(json_decode($this->images) as $image){
            $images [] = asset('uploads/blogs/' . $this->id . '/' . $image);
        }
        $data =  [
            'id' => $this->id,
            'title' => $this['title_'.$lang],
            'description' => $this['description_' . $lang],
            'image' => $this->photoLink(),
            'images' => $images
        ];
        return $data;
    }
}
