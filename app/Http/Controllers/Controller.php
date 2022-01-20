<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $data = [
        'title' => 'Qi academy',
        'description' => 'Qi academy. Online szkolenia dla fryzjerów. Profesjonalna wiedza przekazywana w profesjonalny sposób.',
        'keywords' => 'qiacademy, qi, Online szkolenia, fryzjerów',
        'site_name' => 'Qi-ACADEMY',
    ];
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function print_pre($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
