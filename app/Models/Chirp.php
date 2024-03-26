<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    // Protection to MASS Asignment Vulnerability
    protected $fillable = [
        'message'
    ];

    protected $dispatchesEvents = [
        // Cada vez que se cree un Chirp, ChirpCreated sera lanzada, para enviar un email
        'created' => ChirpCreated::class
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
