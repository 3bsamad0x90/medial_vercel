<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessages extends Model
{
    use HasFactory;
    protected $table = 'contact_messages';
    protected $fillable = [
        'name',
        'email',
        'subject',
        'phone',
        'address',
        'country',
        'title',
        'message',
        'status',
    ];
}
