<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseOfflineController extends Controller
{
    /**
     * Show offline course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_admin()
    {
        $this->middleware('auth');

        $this->data['title'] = 'Offline courses for Admin';
        return view('course.offline.list_admin', $this->data);
    }
}
