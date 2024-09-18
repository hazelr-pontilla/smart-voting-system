<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'election'

    ];


    public function election_id()
    {
        return $this->belongsToMany(Partylist::class,'election_partylist')->withTimestamps();
    }

}
