<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\Contact;

class InfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->data = array_merge($this->data, CommonService::getDataFromFile());
        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        $this->data['about_data'] = CommonService::getDataFromFile('about.default.json');

        $this->data['title'] = 'O Nas';
        return view('info.about', $this->data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team()
    {
        $this->data['team_list'] = Team::getList(true);

        $this->data['title'] = 'Our team';
        return view('info.team', $this->data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function personal_data_policy()
    {
        $this->data['title'] = 'Polityka przetwarzania danych osobowych';
        return view('info.info_page', $this->data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function public_offer()
    {
        $this->data['title'] = 'Oferta publiczna';
        return view('info.info_page', $this->data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payment_cart()
    {
        $this->data['title'] = 'Płatność kartą kredytową';
        return view('info.info_page', $this->data);
    }
}
