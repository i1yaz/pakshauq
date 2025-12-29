<?php

namespace App\Models\Admin;

use App\Abstracts\BaseModel;

class TournamentPrize extends BaseModel
{
    protected $fillable = ['tournament_id', 'name', 'position'];
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public static function setLogsTableName(): string
    {
        return 'website_activity_logs';
    }
}
