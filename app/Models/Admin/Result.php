<?php

namespace App\Models\Admin;

use App\Abstracts\BaseModel;

class Result extends BaseModel
{
    protected $fillable = [
        'pigeon_number', 'pigeon_time', 'total_time',
        'player_id', 'tournament_id','pigeon_total','time_in_seconds'
    ];
    public function resultOfPlayer()
    {
        return $this->belongsTo(Player::class);
    }
    public function resultOfFlyingDay()
    {
        return $this->belongsTo(TournamentFlyingDay::class);
    }
    public function resultOfTournament()
    {
        return $this->belongsTo(Tournament::class);
    }
    public static function setLogsTableName(): string
    {
        return 'website_activity_logs';
    }
}
