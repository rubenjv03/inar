<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    public function get_all_drivers(){
        $client = new Client(['base_uri' => 'http://ergast.com/api/f1/']);
        $response = $client->request('GET', 'drivers');
        return json_encode($response->getBody()->getContents());
    }
    public function get_all_teams(){
        $client = new Client(['base_uri' => 'http://ergast.com/api/f1/']);
        $response = $client->request('GET', 'constructors');
        return json_encode($client->getBody()->getContents());
    }
    public function get_results_by_season_and_race($season, $race){
        $client = new Client(['base_uri' => 'http://ergast.com/api/f1/']);
        $response = $client->request('GET', "$season/$race/results");
        return json_encode($client->getBody()->getContents());
    }
    public function get_laptime_by_season_race_and_driver($season,$race,$driver,$lap){
        $client = new Client(['base_uri' => 'http://ergast.com/api/f1/']);
        $response = $client->request('GET', "$season/$race/drivers/$driver/laps/$lap");
        return json_encode($client->getBody()->getContents());
    }
    public function get_standings_by_season($season){
        $client = new Client(['base_uri' => 'http://ergast.com/api/f1/']);
        $response = $client->request('GET', "$season/driverStandings"); 
        return json_encode($client->getBody()->getContents());
    }
    public function get_circuit_by_id($id){
        $client = new Client(['base_uri' => 'http://ergast.com/api/f1/']);
        $response = $client->request('GET', "circuits/$id"); 
        return json_encode($client->getBody()->getContents());
    }
}
