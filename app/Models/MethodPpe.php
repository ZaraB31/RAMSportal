<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPpe extends Model
{
    use HasFactory;

    protected $fillable = [
        'method_id', 'ppe_id',  
    ];

}
