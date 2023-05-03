<?php

namespace App\Models;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'image',
    ];
    public function photoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');

        if ($this->image != '') {
            $image = asset('uploads/products/'.$this->id.'/'.$this->image);
        }
        return $image;
    }

    public function apiData($lang)
    {
        $data = [
          'id' => $this->id,
          'title' => $this['title_'.$lang],
          'description' => $this['description_'.$lang],
          'image' => $this->photoLink(),
        ];
        return $data;
    }
}
