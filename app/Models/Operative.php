<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phoneNo', 'position', 'profilePic', 'company_id',
    ];
}
