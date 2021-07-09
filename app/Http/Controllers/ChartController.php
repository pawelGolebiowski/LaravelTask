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
        $usersLabel = DB::table('api_users')->get();

        $usersActivity = DB::table('api_posts')
            ->join('api_users', 'api_posts.user_id', '=', 'api_users.id')
            ->select('api_users.id', DB::raw('COUNT(api_posts.user_id) AS ilosc'))
            ->groupBy('api_users.id')
            ->pluck('ilosc');

        $chart->labels($usersLabel->pluck('name'));
        $chart->dataset('User Activity Chart', 'bar', $usersActivity)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);

        return view('charts.chart', compact('chart'));
    }
}
