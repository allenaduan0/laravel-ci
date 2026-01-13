<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'about',
        'photo_path',
        'cover_photo_path',
        'first_name',
        'last_name',
        'email',
        'country',
        'street_address',
        'city',
        'region',
        'postal_code',
    ];
}
