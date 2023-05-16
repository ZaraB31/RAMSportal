<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'hazard', 'effect', 'likelihood', 'severity', 'control', 'residualLikelihood', 'residualSeverity', 'person_id', 'type_id',
    ];

    public function project() {
        return $this->belongsToMany(Project::class, 'project_risks');
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }

    public function type() {
        return $this->belongsTo(RiskType::class);
    }

    public function section() {
        return $this->belongsToMany(Section::class, 'risk_sections');
    }
}
