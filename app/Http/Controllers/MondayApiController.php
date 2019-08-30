<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7;

class MondayApiController extends Controller
{
	public function getBoards()
	{
		// query
		// $graphQLquery = '{"query": "query { updates (limit:10) { id }}"}';
		$graphQLquery = '{"query": "query { boards (limit:10) {id name permissions board_kind} }"}';
		// $graphQLquery = '{"query": "query { boards (ids:309675790, limit:10) {id name permissions board_kind groups {title color position}} }"}';

		// mutation
		// $graphQLquery = '{"query": "mutation { create_board (board_name:commission, board_kind:public) {id} }"}';
		// $graphQLquery = '{"query": "mutation { create_column (board_id:309687987, title:"Work status", column_type:status) {id} }"}';

		$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIxMTMzNjc0LCJ1aWQiOjEwMjE4NzcxLCJpYWQiOiIyMDE5LTA4LTI5IDA1OjA1OjQ1IFVUQyIsInBlciI6Im1lOndyaXRlIn0.gtwwMAFZV_OH6tOSAQ5SmaK-EOLuIkJDzkKDEthu6TM';

		$url = 'https://api.monday.com/v2/';
		try {
			$client = new Client();
			$response = $client->request('post', $url, [
			    'headers' => [
			        'Authorization' => $token,
			        'Content-Type' => 'application/json'
			    ],
			    'body' => $graphQLquery
			]);
			return json_decode($response->getBody(), true);
		} catch (RequestException  $e) {
			// echo Psr7\str($e->getRequest());
			    if ($e->hasResponse()) {
			        return Psr7\str($e->getResponse());
			    }
		}


	}
}
