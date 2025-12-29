<?php

namespace App\Interfaces;

interface ILogActivity
{
    /**
     * @return string $logTableName
     */
    public static function setLogsTableName(): string;
}
