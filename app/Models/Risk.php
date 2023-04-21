<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'hazard', 'effect', 'likelihood', 'severity', 'control', 'residualLikelihood', 'residualSeverity', 'person_id',
    ];
}
