<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Public page for view course
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view($course_id)
    {
        $this->data['title'] = 'View course by ID';
        return view('course.view', $this->data);
    }

    /**
     * Show lecture list for student
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_account()
    {
        $this->middleware('auth');

        $this->data['title'] = 'Courses by Account';
        return view('course.list_account', $this->data);
    }

    /**
     * Page with one lecture for study student
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lecture($lecure_id)
    {
        $this->middleware('auth');

        $this->data['title'] = 'Lecture by ID';
        return view('course.lecture', $this->data);
    }

    /**
     * Show course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_admin()
    {
        $this->middleware('auth');

        $this->data['title'] = 'Courses for Admin';
        return view('course.list_admin', $this->data);
    }

    /**
     * Page for Edit Courses. Only for Admin
     * 
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($course_id)
    {
        $this->middleware('auth');

        $this->data['title'] = 'Edit Course by ID for Admin';
        return view('course.edit', $this->data);
    }
}
