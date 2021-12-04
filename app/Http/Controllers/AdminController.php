<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\Team;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = array_merge($this->data, CommonService::getDataFromFile());
    }
    
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
            if($request->input('type') === 'save_team'){
                if($request->input('name') === null) return ['data' => ['id' => 0], 'message' => 'Invalid temmate`s name'];
                $team_id = Team::saveOrCreate($request);
                return ['data' => ['id' => $team_id], 'mess' => ''];
            }
            // Save new data about team
            if($request->input('type') === 'delete_team'){
                if($request->input('id') === null) return ['data' => ['id' => 0], 'message' => 'Nofound ID'];
                $team_id = Team::deleteById($request->input('id'));
                return ['data' => ['id' => $team_id], 'mess' => ''];
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
