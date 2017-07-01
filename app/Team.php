<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'matches_won',
        'matches_drawn',
        'matches_lost'
    ];

    
}