<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'method_id', 'tool_id',  
    ];
}
