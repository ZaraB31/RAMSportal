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
        return $this->belongsTo(Detail::class);
    }

    public function manager() {
        return $this->belongsTo(Detail::class);
    }

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function project() {
        return $this->belongsToMany(ProjectOperative::class);
    }
}
