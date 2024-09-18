<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kandidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'course',

        'position_vote',
        'candidates_id',
        'vote',
    ];

    protected $casts = [
        'vote' => 'json'
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidates::class);
    }

    public function kandidatoItem(): HasMany
    {
        return $this->hasMany(Kandidato::class);
    }


}
