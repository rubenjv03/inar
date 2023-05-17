<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GHController extends Controller
{
    private string $accessToken;
    private string $githubUser;
    public function __construct()
    {
        $this->accessToken = env('TOKEN_GITHUB');
        $this->githubUser = env('USER_GITHUB');
    }
    public function get_repositories(){
        $client = new Client(['base_uri' => 'https://api.github.com/']);
        $response = $client->request('GET', 'user/repos', [
            "headers" => [
                'Accept' => 'application/vnd.github.v3+json',
                "Authorization" => "Bearer ".$this->accessToken
            ]
        ]);
        return json_encode($response->getBody()->getContents());
    }
    public function get_collaborators_by_repo($repo){
        $client = new Client(['base_uri' => 'https://api.github.com/']);
        $response = $client->request('GET', "repos/". $this->githubUser ."/$repo/collaborators", [
            "headers" => [
                'Accept' => 'application/vnd.github.v3+json',
                "Authorization" => "Bearer ".$this->accessToken
            ]
        ]);
        return json_encode($response->getBody()->getContents());
    }
    public function create_new_repo($repoName){
        $client = new Client(['base_uri' => 'https://api.github.com/']);
        $response = $client->request('POST', "user/repos", [
            "headers" => [
                'Accept' => 'application/vnd.github.v3+json',
                "Authorization" => "Bearer ".$this->accessToken
            ],
            "json" => [
                'name' => "$repoName",
                'description' => "repositorio de prueba para el ejercicio de M07"
            ]
            ]);
        return json_encode($response->getBody()->getContents());
    }
    public function make_repository_private($repo){
        $client = new Client(['base_uri' => 'https://api.github.com/']);
        $response = $client->request('PATCH', "repos/".$this->githubUser."/$repo", [
            "headers" => [
                'Accept' => 'application/vnd.github.v3+json',
                "Authorization" => "Bearer ".$this->accessToken
            ],
            "json" => [
                'visibility' => 'private'
            ]
            ]);
        return json_encode($response->getBody()->getContents());
    }
}
