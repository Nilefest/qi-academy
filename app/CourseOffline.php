<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseOffline extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses_offline';
    
    public static function getList($convert_date_of = false)
    {
        $list = self::orderBy('place')->orderBy('date_of')->orderBy('name')->get()->toArray();
        foreach($list as $key => $row) {
            if($convert_date_of){
                if($row['period'] * 1 > 1) {
                    $day = date('d', strtotime($row['date_of']));
                    $next_date = strtotime($row['date_of'] . ' +' . ($row['period'] * 1 - 1) . ' day');
                    $list[$key]['date_of'] = $day . '-' . date('d/m/Y', $next_date);
                } else {
                    $list[$key]['date_of'] = date('d/m/Y', strtotime($row['date_of']));
                }
            }
        }
        return $list;
    }
}
