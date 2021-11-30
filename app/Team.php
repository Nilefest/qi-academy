<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team';

    public static function getList()
    {
        $list = self::orderBy('name')->get();
        return $list;
    }
}
