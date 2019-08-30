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
        $graphQLquery = '{"query": "query { boards (limit:100) {id name permissions board_kind} }"}';
        // $graphQLquery = '{"query": "query { boards (ids:309675790, limit:10) {id name permissions board_kind groups {title color position}} }"}';

        // mutation
        // $graphQLquery = '{"query": "mutation { create_board (board_name:commission, board_kind:public) {id} }"}';
        // $graphQLquery = '{"query": "mutation { create_column (board_id:309687987, title:"Work status", column_type:status) {id} }"}';

        $token = env('MONDAY_ACCESS_TOKEN');

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
            $boards = json_decode($response->getBody(), true)['data']['boards'];
            return view('board.index', compact('boards'));
        } catch (RequestException  $e) {
            // echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                return Psr7\str($e->getResponse());
            }
        }
    }

    public function addBoard()
    {
    	return view('board.add');
    }

    public function storeBoard(Request $request)
    {
    	$data = $this->mutationToMonday($request);

    	return redirect()->route('monday.boards');
    }

    public function queryToMonday()
    {

    }

    public function mutationToMonday(Request $request)
    {

    	$token = env('MONDAY_ACCESS_TOKEN');

    	$url = 'https://api.monday.com/v2/';
    	try {
    	    $client = new Client();
    	    $response = $client->request('post', $url, [
    	        'headers' => [
    	            'Authorization' => $token,
    	            'Content-Type' => 'application/json'
    	        ],
    	        RequestOptions::JSON => [
    	        	'query' => 'mutation { create_board(board_name: "' . $request['board_name'] . '" , board_kind:' . $request['board_kind'] . ') {id name} }'
    	        ]
    	        // 'body' => $graphQLquery
    	    ]);
    	    return  json_decode($response->getBody(), true);
    	} catch (RequestException  $e) {
    	    // echo Psr7\str($e->getRequest());
    	    if ($e->hasResponse()) {
    	        return Psr7\str($e->getResponse());
    	    }
    	}
    }

    public function destroyBoard($id, Request $request)
    {
    	$graphQLquery = '{"query": "mutation { delete_board (id:' . $id . ') {id deleted} }"}';
    	// $graphQLquery = '{"query": "mutation { create_column (board_id:309687987, title:"Work status", column_type:status) {id} }"}';

    	$token = env('MONDAY_ACCESS_TOKEN');

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
    	    return  json_decode($response->getBody(), true);
    	} catch (RequestException  $e) {
    	    // echo Psr7\str($e->getRequest());
    	    if ($e->hasResponse()) {
    	        return Psr7\str($e->getResponse());
    	    }
    	}
    }

    public function getBoardDetail($id)
    {
    	$graphQLquery = '{"query": "query { boards (ids:' . $id . ', limit:10) {id name permissions board_kind groups {title color position}} }"}';

    	$token = env('MONDAY_ACCESS_TOKEN');

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
    	    $board = json_decode($response->getBody(), true)['data']['boards'][0];
	    	return view('board.detail', compact('board'));
    	} catch (RequestException  $e) {
    	    // echo Psr7\str($e->getRequest());
    	    if ($e->hasResponse()) {
    	        return Psr7\str($e->getResponse());
    	    }
    	}
    }
}
