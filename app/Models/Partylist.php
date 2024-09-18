<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partylist extends Model
{
    use HasFactory;

    protected $fillable = [

        'p_date_filling',
        'name_of_partylist',

        'candidates_id',

        'members',

        'p_vision_statement',
        'p_key_priorities',
        'collaboration_plan',

        'partylist',
    ];

    public function candidates()
    {
        return $this->belongsTo(Candidates::class);
    }

    public function persons() :BelongsToMany //authors inin han yt
    {
        return $this->belongsToMany(Candidates::class, 'partylists_candidates');
    }

    public function partylist()
    {
        return $this->belongsToMany(Election::class,'election_partylist')->withTimestamps();
    }


}
