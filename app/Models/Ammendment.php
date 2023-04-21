<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ammendment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'version', 'comment',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}