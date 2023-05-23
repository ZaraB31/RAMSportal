<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperativeQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'operative_id', 'qualification_id',
    ];
}
