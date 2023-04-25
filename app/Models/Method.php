<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'description',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function sequence() {
        return $this->hasMany(Sequence::class);
    }

    public function PPE() {
        return $this->belongsToMany(Ppe::class, 'method_ppes');
    }

    public function tool() {
        return $this->belongsToMany(Tool::class, 'method_tools');
    }
}
