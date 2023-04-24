<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type',  
    ];

    public function risk() {
        return $this->belongsToMany(RiskSection::class);
    }

    public function tool() {
        return $this->hasMany(Tool::class);
    }
}
