<?php

namespace App\Models\Admin;

use App\Abstracts\BaseModel;

class News extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';
    protected $fillable = [
        'name', 'show'
    ];
    public static function setLogsTableName(): string
    {
        return 'website_activity_logs';
    }
}
