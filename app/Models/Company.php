<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phoneNo', 'email',
    ];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function operative() {
        return $this->HasMany(Operative::class);
    }

    public function project() {
        return $this->hasMany(Project::class);
    }
}
