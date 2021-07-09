<?php

namespace App\Console\Commands;

use App\ApiPosts;
use App\ApiUsers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetDataFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getData:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Komenda pobierająca dane z API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $responseUsers = Http::get('https://jsonplaceholder.typicode.com/users');
        $responseUsers = json_decode($responseUsers, true);

        $responsePosts = Http::get('https://jsonplaceholder.typicode.com/posts');
        $responsePosts = json_decode($responsePosts, true);

        $apidata = new ApiUsers();



        foreach ($responseUsers as $userInfo) {
            $data = [
                'name' => $userInfo['name'],
                'username' => $userInfo['username'],
                'email' => $userInfo['email'],
                'street' => $userInfo['address']['street'],
                'city' => $userInfo['address']['city'],
                'zipcode' => $userInfo['address']['zipcode'],
                'phone' => $userInfo['phone'],
                'website' => $userInfo['website'],
                'companyname' => $userInfo['company']['name']
            ];

            $apidata = ApiUsers::firstOrCreate($data);
        };

        foreach ($responsePosts as $userPosts) {
            $data = [
                'user_id' => $userPosts['userId'],
                'title' => $userPosts['title'],
                'body' => $userPosts['body']
            ];

            $apidata = ApiUsers::firstOrCreate($data);
        };

        return 0;
    }
}
