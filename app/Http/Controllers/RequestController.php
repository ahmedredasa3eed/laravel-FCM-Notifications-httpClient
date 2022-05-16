<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestController extends Controller
{
    public function getAllPosts(){

        ### if you want to make dd before return results.
        //$response = Http::dd()->get('https://jsonplaceholder.typicode.com/posts');

        ### Default Shape of requesting.
        //$response = Http::get('https://jsonplaceholder.typicode.com/posts');

        ### append array of data you want to filter results.
        $response = Http::get('https://jsonplaceholder.typicode.com/posts',['id'=>12]);

        ### Define that you are expect to recieve json response;
        $response = Http::acceptJson()->get('https://jsonplaceholder.typicode.com/posts');

        //return $response->headers();
        return $response->json();
    }

    public function getPostsCollect(){

        $response = Http::acceptJson()->get('https://jsonplaceholder.typicode.com/posts');

        $data =  $response->collect();

        //to hide specific item from collection.
        return $data->map(function ($item) {
            return collect($item)->except(['title','userId']);
        });
    }


    public function newPost(){
        $post = Http::post('https://jsonplaceholder.typicode.com/posts',[
            'userId' => 2,
            'title' => 'Hello Im Ahmed',
            'body' => 'Body Here',
        ]);
        return $post->json();
    }

    public function auth(){
        Http::withBasicAuth('ahmed@gmail.com','123456')->get('https://jsonplaceholder.typicode.com/posts');
        Http::withDigestAuth('ahmed@gmail.com','123456')->get('https://jsonplaceholder.typicode.com/posts');
    }

    public function getPostIfAuth(){
        $api_password = array(
            'api_password' => 'AhmedReda',
        );

        $response = Http::withHeaders(['auth_token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTY1MjM3MDk5OSwiZXhwIjoxNjUyMzc0NTk5LCJuYmYiOjE2NTIzNzA5OTksImp0aSI6IjZuUzRld25YV1FMTzFIOFIiLCJzdWIiOjksInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.HPKjjxsG4P6tkPqQYH_HnJKw4qK8OHP29gSr2ETiwok'])
            ->post('http://127.0.0.1:8000/api/getCategories',$api_password);
        return $response->json();
    }

    public function getPostIfAuthByUsingMacro(){

        //Ahmed is A macro added to AppServiceProvider in Boot Method
        $response = Http::Ahmed()->post('/getCategories',['api_password'=>'AhmedReda']);
        return $response->json();
    }

    public function concurrentRequests(){
        $responses = Http::pool(function(Pool $pool){
            [
                $pool->as('firstRequest')->get('https://jsonplaceholder.typicode.com/posts'),
                $pool->as('secondRequest')->get('https://jsonplaceholder.typicode.com/posts/100'),

            ];
        });

        return $responses['firstRequest']->json() && $responses['secondRequest']->json();
    }

    public function deletePost($id){
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/1');
        return $response->json();
    }
}
