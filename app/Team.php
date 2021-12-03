<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;

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
    
    public static function saveOrCreate(Request $request)
    {
        if($request->input('id') !== null && $request->input('id') !== ''){ 
            $team = self::find($request->input('id'));
            if($team === null) $team = new self;
        } else $team = new self;

        $team->name = $request->input('name') . '';
        $team->info = $request->input('info') . '';
        $team->instagram = $request->input('instagram') . '';
        $team->facebook = $request->input('facebook') . '';
        if(isset($_FILES['img_file'])){
            $team->img = CommonService::uploadFile('team', $_FILES['img_file'], $team->img);
        }
        $team->save();

        return $team->id;
    }
    
    public static function deleteById($team_id)
    {
        $team = self::find($team_id);
        $team->delete();

        return $team->id;
    }
}
