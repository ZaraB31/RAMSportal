<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasFactory;

    protected $fillable = [
        'method_id', 'stepNo', 'description',
    ];

    public function method() {
        return $this->belongsTo(Method::class);
    }
}
