<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'section_id',
    ];

    public function section() {
        return $this->hasOne(Section::Class);
    }

    public function method() {
        return $this->belongsToMany(MethodTool::class);
    }
}