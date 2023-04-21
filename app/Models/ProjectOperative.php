<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOperative extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'operative_id',
    ];

    public function project() {
        return $this->hasMany(Project::class);
    }

    public function operative() {
        return $this->hasMany(Operative::class);
    }
}
