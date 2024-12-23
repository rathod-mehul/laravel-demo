<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DemoController extends Controller
{
    public function index($userID = 0)
    {
        // return 'This is demo controller.';
        // return $userID;
        // return view('home', ['userId' => $userID]);
        $car = array("brand" => "Ford", "model" => "Mustang", "year" => 1964);
        return view('home', ['car' => $car]);
        // return view('home')->with('name', 'Victoria')
        //     ->with('occupation', 'Astronaut');
    }

    public function getName()
    {
        return redirect(route('get.subject'));
        // return redirect(url('get-subject'));
        return 'Default Name';
    }

    public function getSubject()
    {
        // return 'Default Subject';
    }

    public function bladeDirective()
    {
        $records = array("brand" => "Ford", "model" => "Mustang", "year" => 1964);
        // $records = [];

        return view('blade-directive')->with('arrayRecords', $records);
    }
}
