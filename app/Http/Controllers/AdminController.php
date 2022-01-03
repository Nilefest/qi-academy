<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\Team;

use App\CourseOffline;
use App\Setting;
use App\Contact;
use App\Review;
use App\User;
use App\UserCourse;

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
        $this->data['setting_fields'] = Setting::getFields();

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
        // Sort data
        $sort_by_column = 'name';
        if($request->input('sort_by') !== null){
            $sort_by_column = $request->input('sort_by');
            if(!in_array($sort_by_column, ['name', 'phone', 'email', 'total_courses'])) $sort_by_column = 'name';
        }
        // Search data
        $search_by = '';
        if($request->input('search_by') !== null){
            $search_by = $request->input('search_by');
        }

        $clients = User::getListByType('client', $sort_by_column, $search_by); // client

        // If POST
        if($request->isMethod('post')) return ['data' => ['clients' => $clients], 'mess' => ''];

        $this->data['total_with_courses'] = User::getTotalWithCourses();
        $this->data['clients'] = $clients;

        $this->data['title'] = 'Clients';
        return view('admin.clients', $this->data);
    }

    /**
     * Show offline course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clients_download(Request $request)
    {
        // Sort data
        $sort_by_column = 'name';
        if($request->input('sort_by') !== null){
            $sort_by_column = $request->input('sort_by');
            if(!in_array($sort_by_column, ['name', 'phone', 'email', 'total_courses'])) $sort_by_column = 'name';
        }
        // Search data
        $search_by = '';
        if($request->input('search_by') !== null){
            $search_by = $request->input('search_by');
        }

        $clients = User::getListByType('client', $sort_by_column, $search_by); // client
        $this->data['clients'] = $clients;

        $headers = [
            'Content-type' => 'text/plain', 
            'Content-Disposition' => sprintf('attachment; filename="clients_list-' . time() . '.txt"')
        ];
        
        // $content = "";
        // foreach($clients as $client) $content .= $client['email'] . ";\n";
        // return response($content)->withHeaders($headers);

        return response()->view('admin.clients_txt', $this->data, 200)->withHeaders($headers);
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
     * Setting data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting(Request $request)
    {
        if($request->isMethod('post')){
            if($request->input('save_setting') !== null){
                $fields = $request->input('fields');
                foreach($fields as $field){
                    Setting::saveField($field['type'], $field['name'], $field['value']);
                }
                print_r($request->all());
                return ['status' => 'success', 'mess' => 'Success!'];
            }
        }
        return;
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
