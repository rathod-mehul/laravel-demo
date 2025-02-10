<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class DemoController extends Controller
{
    public function encryptDecrypt()
    {
        $value = 123;
        $encryptValue = Crypt::encrypt($value);
        $decryptValue = Crypt::decrypt($encryptValue);

        return [$encryptValue, $decryptValue];
    }

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
        $arrayRecords = array("brand" => "Ford", "model" => "Mustang", "year" => 1964);
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['id' => 3, 'name' => 'Mark Taylor', 'email' => 'mark@example.com'],
            ['id' => 4, 'name' => 'Sara Connor', 'email' => 'sara@example.com'],
            ['id' => 5, 'name' => 'Paul Walker', 'email' => 'paul@example.com'],
            ['id' => 6, 'name' => 'Emily Davis', 'email' => 'emily@example.com'],
            ['id' => 7, 'name' => 'Chris Brown', 'email' => 'chris@example.com'],
            ['id' => 8, 'name' => 'Olivia Johnson', 'email' => 'olivia@example.com'],
            ['id' => 9, 'name' => 'Mike Tyson', 'email' => 'mike@example.com'],
            ['id' => 10, 'name' => 'Sophia Wilson', 'email' => 'sophia@example.com'],
        ];
        // $records = [];

        // return view('blade-directive')->with('arrayRecords', $records);
        return view('blade-directive', compact('arrayRecords', 'users'));
    }

    public function modelNaming()
    {
        $posts = Post::all();

        dd($posts);
    }

    public function getTodos()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos')->json();

        //Try to create pagination in table todos

        //Convert array to laravel Collection
        $todos = collect($response);

        // paginate the result (20 per page)
        $perPage = 20;
        $currentPage = request()->query('page', 1); //Get current page from URL query, default is 1
        $currentItems = $todos->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Create LengthAwarePaginator instance
        $paginatedTodos = new LengthAwarePaginator(
            $currentItems, // Items for the current page
            $todos->count(), // Total items
            $perPage, // Items per page
            $currentPage, // Current page
            ['path' => request()->url()] // Maintain the current URL
        );

        return view('argon_dashboard.pages.todos', ['todos' => $paginatedTodos]);
    }
}
