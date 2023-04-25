<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'icon',   
    ];

    public function method() {
        return $this->belongsToMany(Method::class, 'method_ppes');
    }
} 
