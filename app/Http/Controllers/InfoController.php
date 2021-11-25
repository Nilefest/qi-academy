<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        $this->data['title'] = 'ONas';
        return view('info.about', $this->data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team()
    {
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
