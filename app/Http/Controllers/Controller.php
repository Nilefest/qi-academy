<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $data = [
        'title' => 'Official site',
        'description' => '',
        'keywords' => '',
        'site_name' => 'QiACADEMY.site',
    ];
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function print_pre($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
