<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Session;
use Forrest;

class SalesForceApiController extends Controller
{
	public function getAccessToken(Request $request)
	{
		Forrest::callback();
		// $code = $request->code;
		// $client = new Client();

		// $response = $client->request('POST', 'https://login.salesforce.com/services/oauth2/token',
		//     [
		//         'form_params' => [
		//             'grant_type' => 'authorization_code',
		//             'redirect_uri' => 'https://laravel.localhost/salesforce/oauth/_salesforce-callback',
		//             'client_id' => '3MVG9G9pzCUSkzZtlTBlYN1t6DLv8wmoX7JBBIXYWejVsRbdhv6rnkMEp7Gpq2alIbSZ00yoAIN8mDD038i1x',
		//             'client_secret' => '1B8B46E7E8C5ED9C9156B58F2324CA891AB39CE45EBDC98AE8E37BB8A4B5402D',
		//             'code' => $code
		//         ]
		//     ]
		// );

		// $data = json_decode($response->getBody());

		// Session::put('salesforce_', $data);
		return redirect('/home');
	}

	public function testsalesforce(Request $request)
	{
		
	}
}
