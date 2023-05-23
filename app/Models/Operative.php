<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phoneNo', 'position', 'profilePic', 'company_id',
    ];

    public function supervisor() {
        return $this->hasMany(Detail::class);
    }

    public function manager() {
        return $this->hasMany(Detail::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function project() {
        return $this->belongsToMany(Project::class, 'project_oeratives');
    }

    public function qualification() {
        return $this->belongsToMany(Qualification::class, 'operative_qualifications');
    }
}
