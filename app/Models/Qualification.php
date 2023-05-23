<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function project() {
        return $this->belongsToMany(Project::class, 'project_qualifications');
    }

    public function operative() {
        return $this->belongsToMany(Operative::class, 'operative_qualifications');
    }
}
