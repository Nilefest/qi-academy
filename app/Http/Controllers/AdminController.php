<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\Team;
use File;

class AdminController extends Controller
{
    /**
     * Dashboard for Admin
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $this->middleware('auth');

        $this->data['title'] = 'Dashboar for Admin';
        return view('admin.dashboard', $this->data);
    }

    /**
     * Dashboard for Admin
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team(Request $request)
    {
        $this->middleware('auth');

        if($request->isMethod('post')){
            // Save new data about team
            if($request->input('type') === 'save_team'){ //return ['data' => ['id' => '$team->id'], 'mess' => $_FILES];
                $team = new Team;
                if($request->input('id') !== null && $request->input('id') !== '') $team = Team::findOrFail($request->input('id'));
                
                if($request->input('name') === null) return ['data' => ['id' => 0], 'message' => 'Invalid temmate`s name'];
                $team->name = $request->input('name') . '';
                $team->info = $request->input('info') . '';
                $team->instagram = $request->input('instagram') . '';
                $team->facebook = $request->input('facebook') . '';
                if(isset($_FILES['img_file'])){
                    $team->img = CommonService::uploadFile('team', $_FILES['img_file'], $team->img);
                }

                $team->save();
                return ['data' => ['id' => $team->id], 'mess' => ''];
            }
            // Save new data about team
            if($request->input('type') === 'delete_team'){
                if($request->input('id') === null && $request->input('id') === '') return ['data' => ['id' => 0], 'message' => 'Invalid temmate`s name'];
                
                $team = Team::findOrFail($request->input('id'));
                $team->delete();
                
                return ['data' => ['id' => $team->id], 'mess' => ''];
            }
            return;
        }


        $team_list = Team::getList();
        foreach($team_list as $key => $team_one) $team_list[$key]['info'] = CommonService::replaceBrToLn($team_one['info']);
        $this->data['team_list'] = $team_list;


        $this->data['title'] = 'Edit Team';
        return view('admin.team', $this->data);
    }
}
