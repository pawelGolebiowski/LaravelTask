<?php

namespace App\Http\Controllers;

use App\ApiUsers;
use App\Charts\UserChart;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{
    public function index()
    {
        $chart = new UserChart;
        $users1 = DB::table('api_users')->get();
        $users2 = ApiUsers::select(DB::raw("COUNT(*) as count"))
            ->pluck('count');


        $projects = DB::table('api_posts')
            ->join('api_users', 'api_posts.user_id', '=', 'api_users.id')
            ->select('api_users.id', DB::raw('COUNT(api_posts.user_id) AS ilosc'))
            ->groupBy('api_users.id')
            ->pluck('ilosc');

        $chart->labels($users1->pluck('name'));
        $chart->dataset('User Activity Chart', 'bar', $projects)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return view('charts.chart', compact('chart'));
    }
}