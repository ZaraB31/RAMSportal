<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'jobNo', 'client_id', 'user_id', 'company_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function operative() {
        return $this->belongsToMany(Operative::class, 'project_operatives');
    }

    public function detail() {
        return $this->hasOne(Detail::class);
    }

    public function risk() {
        return $this->belongsToMany(Risk::class, 'project_risks');
    }

    public function method() {
        return $this->hasOne(Method::class);
    }

    public function ammendment() {
        return $this->hasMany(Ammendment::class);
    }
 
    public function client() {
        return $this->belongsTo(Client::class);
    }
}
