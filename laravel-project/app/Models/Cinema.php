<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $cast=[
        'time'=>'array',
    ];
}
