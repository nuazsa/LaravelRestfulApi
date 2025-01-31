<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Employee extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    public $fillable = [
        'id', 'image', 'name', 'phone', 'division_id', 'position'
    ];

    public function division() {
        return $this->belongsTo(Division::class);
    }
}
