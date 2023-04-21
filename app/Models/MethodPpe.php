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

    public function method() {
        return $this->hasMany(Method::class);
    }

    public function PPE() {
        return $this->hasMany(Ppe::class);
    }
}
