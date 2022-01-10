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

    public static function getById($team_id, $replace_nl_to_br = false)
    {
        $team_one = self::find($team_id);
        if($team_one === null) return [];

        if($replace_nl_to_br){
            $team_one->info = CommonService::replaceNlToBr($team_one->info);
        }
        return $team_one;
    }

    public static function getList($replace_nl_to_br = false, $limit = -1, $for_main = false)
    {
        if($for_main) $list = self::where('for_main_page', 1)->orderBy('name')->limit($limit)->get();
        else $list = self::orderBy('name')->limit($limit)->get();
        
        if($replace_nl_to_br){
            foreach($list as $key => $row) $list[$key]->info = CommonService::replaceNlToBr($row->info);
        }
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
        $team->info = CommonService::replaceNlToBr($team->info);
        $team->instagram = $request->input('instagram') . '';
        $team->facebook = $request->input('facebook') . '';
        if(isset($_FILES['img_file'])) {
            $team->img = CommonService::uploadFile('team', $_FILES['img_file'], $team->img);
        }
        if($request->input('for_main_page') !== null) {
            $team->for_main_page = $request->input('for_main_page') * 1;
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
