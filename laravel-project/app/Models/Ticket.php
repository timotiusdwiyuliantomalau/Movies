<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $cast=[
        'seat'=>'array',
    ];
    public function user(){
        return $this->BelongsTo(User::class);
    }
}
