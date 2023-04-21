<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'risk_id', 'section_id',
    ];

    public function risk() {
        return $this->hasMany(Risk::class);
    }

    public function section() {
        return $this->hasMany(Section::class);
    }
}
