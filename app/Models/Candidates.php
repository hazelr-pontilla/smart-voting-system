<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Candidates extends Model
{
    use HasFactory;

    protected $fillable = [
        //PROFILE

      'date_filing',
      'student_id',
      'position',

      'fullname',
      'gender',
      'email',
      'c_year_level',
      'c_course',
      'motivation',

        //AGENDAS
        'key_issues',
        'key_solutions',
        'plan_to_action',
        'conclusion',

        //PLANS
        'vision_statement',
        'key_priorities',
        'action_plan',
    ];

    public function partylist()
    {
        return $this->belongsToMany(Partylist::class);
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(Partylist::class, 'partylists_candidates');
    }

    public function candidates()
    {
        return $this->belongsToMany(Kandidato::class,'election_partylist')->withTimestamps();
    }



}
