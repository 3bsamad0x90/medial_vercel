<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $table = 'testimonials';
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'address',
        'image',
    ];
    public function photoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');

        if ($this->image != '') {
            $image = asset('uploads/testimonials/' . $this->id . '/' . $this->image);
        }
        return $image;
    }

    public function apiData($lang)
    {
        $data = [
            'id' => $this->id,
            'name' => $this['name_' . $lang],
            'description' => $this['description_' . $lang],
            'address' => $this->address,
            'image' => $this->photoLink(),
            'date' => Carbon::parse($this->created_at)->format('M d, Y'),
        ];
        return $data;
    }
}
