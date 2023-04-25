<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'location', 'start', 'duration', 'workingHours', 'hospital_id', 'supervisor_id', 'manager_id',
    ];

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

    public function supervisor() {
        return $this->belongsTo(Operative::class);
    }

    public function manager() {
        return $this->belongsTo(Operative::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
