<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApiDataController extends Controller
{
    public function index()
    {
        $users = DB::table('api_posts')
            ->join('api_users', 'api_posts.user_id', '=', 'api_users.id')->get();

        return view('apidata.index', ['users' => $users]);
    }
}