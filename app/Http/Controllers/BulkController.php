<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SalesforceBulkApi\dto\CreateJobDto;
use SalesforceBulkApi\objects\SFBatchErrors;
use SalesforceBulkApi\conf\LoginParams;
use SalesforceBulkApi\services\JobSFApiService;
use Forrest;
use Session;

class BulkController extends Controller
{

	public function newjob()
	{
		$client = new Client;

		$response = $client->request('POST', 'https://ap15.salesforce.com/services/async/44.0/job', [
		    'headers' => [
		        'X-SFDC-Session' => '00D2v0000026WnZ!ARkAQLuOdbEnHY485.Smjq.Aw2fi8iRzCh_yo8OR8avA9ABfYGV4hATQctF74zgEWY6Ott3BV.fztVO_ASK3c8xhSAerkyne',
		        'Content-Type'     => 'application/json',
		    ],
		    'json' => [
	    		"operation" => "insert",
	    		"object" => "Contact",
	    		"contentType" => "JSON"
	        ]
		]);

		$result = $response->getBody();
		// dd(json_decode($result)->id);

		return $result;
	}

	public function abortJob($id)
	{
		$url = 'https://ap15.salesforce.com/services/async/44.0/job/';

		$client = new Client;

		$response = $client->request('POST', $url . $id, [
		    'headers' => [
		        'X-SFDC-Session' => '00D2v0000026WnZ!ARkAQLuOdbEnHY485.Smjq.Aw2fi8iRzCh_yo8OR8avA9ABfYGV4hATQctF74zgEWY6Ott3BV.fztVO_ASK3c8xhSAerkyne',
		        'Content-Type'     => 'application/json',
		    ],
		    'json' => [
	    		"state" => "Aborted",
	        ]
		]);

		return $response->getBody();
	}

	public function closeJobs($id)
	{
		$url = 'https://ap15.salesforce.com/services/async/44.0/job/';

		$client = new Client;

		$response = $client->request('POST', $url . $id, [
		    'headers' => [
		        'X-SFDC-Session' => '00D2v0000026WnZ!ARkAQLuOdbEnHY485.Smjq.Aw2fi8iRzCh_yo8OR8avA9ABfYGV4hATQctF74zgEWY6Ott3BV.fztVO_ASK3c8xhSAerkyne',
		        'Content-Type'     => 'application/json',
		    ],
		    'json' => [
	    		"state" => "Closed",
	        ]
		]);

		return $response->getBody();
	}

	public function createBatch($id)
	{
		$url = 'https://ap15.salesforce.com/services/async/44.0/job/';

		// 7502v00000EwCVEAA3
		// 7512v00000MBPouAAH
		$client = new Client;

		$data = [
			[
				"FirstName" => "Tom",
				"LastName" => "Jones",
				"Title" => "Senior Director",
				"Birthdate" => "1940-06-07",
				"Description" => "Self-described as the top branding guru on the West Coast" 
			],
			[
				"FirstName" => "Ian",
				"LastName" => "Dury",
				"Title" => "Chief Imagineer",
				"Birthdate" => "1940-06-07",
				"Description" => "World-renowned expert in fuzzy logic design" 
			]
		];


		$response = $client->request('POST', $url . $id . '/batch', [
		    'headers' => [
		        'X-SFDC-Session' => '00D2v0000026WnZ!ARkAQLuOdbEnHY485.Smjq.Aw2fi8iRzCh_yo8OR8avA9ABfYGV4hATQctF74zgEWY6Ott3BV.fztVO_ASK3c8xhSAerkyne',
		        'Content-Type'     => 'application/json; charset=UTF8',
		    ],
		    'json' => $data
		]);

		return $response->getBody();
	}

	public function createAccountBatch($id)
	{
		$url = 'https://ap15.salesforce.com/services/async/44.0/job/';

		// 7502v00000EwCVEAA3
		// 7512v00000MBPouAAH
		$client = new Client;

		$data = [
			[
				"Name" => "Tom Jode",
			],
			[
				"Name" => "Ian Ram",
			]
		];


		$response = $client->request('POST', $url . $id . '/batch', [
		    'headers' => [
		        'X-SFDC-Session' => '00D2v0000026WnZ!ARkAQLuOdbEnHY485.Smjq.Aw2fi8iRzCh_yo8OR8avA9ABfYGV4hATQctF74zgEWY6Ott3BV.fztVO_ASK3c8xhSAerkyne',
		        'Content-Type'     => 'application/json; charset=UTF8',
		    ],
		    'json' => $data
		]);

		return $response->getBody();
	}

	public function batchInfo($id)
	{
		// 7512v00000MBPouAAH
		$url = 'https://ap15.salesforce.com/services/async/44.0/job/7502v00000EwCVEAA3/batch/';

		$client = new Client;

		$response = $client->request('GET', $url . $id, [
		    'headers' => [
		        'X-SFDC-Session' => '00D2v0000026WnZ!ARkAQLuOdbEnHY485.Smjq.Aw2fi8iRzCh_yo8OR8avA9ABfYGV4hATQctF74zgEWY6Ott3BV.fztVO_ASK3c8xhSAerkyne',
		        'Content-Type'     => 'application/json',
		    ]
		]);

		return $response->getBody();
	}

	public function checkChanges()
	{
		$response = Forrest::get('/services/data/v34.0/sobjects');

		dd($response);
	}
}
