<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'major',
        'minor',
        'uid',
        'description',
        'address',
    ];
}
