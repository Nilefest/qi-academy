<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\Team;

use App\CourseOffline;
use App\Contact;
use App\Review;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');

        $this->data = array_merge($this->data, CommonService::getDataFromFile());
        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');
    }
    
    /**
     * Dashboard for Admin
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
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

    /**
     * Show offline course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clients(Request $request)
    {
        $this->data['clients'] = User::getListByType('client');

        $this->data['title'] = 'Clients';
        return view('admin.clients', $this->data);
    }

    /**
     * Show offline course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contacts(Request $request)
    {
        if($request->isMethod('post')){
            if($request->input('save_contacts') !== null){
                $contacts = $request->input('contacts');
                Contact::saveByType('contacts', $contacts);
                $social = $request->input('social');
                Contact::saveByType('social', $social);
                
                $data['form_result'] = ['status' => 'success', 'mess' => 'Success!'];
            }
        }

        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');        

        $this->data['title'] = 'Edit contacts';
        return view('admin.contacts', $this->data);
    }

    /**
     * Show offline course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews(Request $request)
    {
        if($request->isMethod('post')){
            // Save new / update review
            if($request->input('type') === 'save_video_reviews'){
                $review = new Review;
                if($request->input('id') !== null && $request->input('id') !== '') $review = Review::findOrFail($request->input('id'));
                
                $review->video = $request->input('video') . '';

                $youtube_code =  $request->input('video');
                $youtube_code = str_replace('https://youtu.be/', '', $youtube_code);
                $youtube_code = str_replace('https://www.youtube.com/watch?v=', '', $youtube_code);
                $review->youtube_code = $youtube_code . '';

                $review->save();

                return ['data' => ['id' => $review->id], 'mess' => ''];
            }
            // Delete review
            if($request->input('type') === 'delete_video_review'){
                if($request->input('id') === null && $request->input('id') === '') return ['data' => ['id' => 0], 'message' => 'Invalid review`s id'];
                
                $review = Review::findOrFail($request->input('id'));
                $review->delete();
                
                return ['data' => ['id' => $review->id], 'mess' => ''];
            }
            return;
        }

        $this->data['reviews'] = Review::getList();

        $this->data['title'] = 'Edit reviews';
        return view('admin.reviews', $this->data);
    }
}
