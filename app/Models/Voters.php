<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    use HasFactory;

    protected $fillable = [

        //PROFILE
        'voters_id',
        'voters_fullname',
        'gender',

        'email',
        'v_year_level',
        'v_course',
    ];
}
