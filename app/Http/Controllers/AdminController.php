<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
