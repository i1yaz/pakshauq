<?php

namespace App\Models\Admin;

use App\Abstracts\BaseModel;

class Slider extends BaseModel
{
    protected $fillable = [
        'slider'
    ];

    public static function setLogsTableName(): string
    {
        return 'website_activity_logs';
    }
}
