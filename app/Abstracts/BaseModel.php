<?php

namespace App\Abstracts;

use App\Interfaces\ILogActivity;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model implements ILogActivity
{
    // use Loggable;
    // const CACHE_KEY=null;

     public static function updateOrCreateInstance(int $id = null)
    {
        if (null !== ($instance = self::find($id))) {
            return $instance;
        }

        return  new static();
    }
}
