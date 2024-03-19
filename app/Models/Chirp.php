<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    use HasFactory;

    // Protection to MASS Asignment Vulnerability
    protected $fillable = [
        'message',
    ];
}
