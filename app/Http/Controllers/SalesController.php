<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Forrest;
use Session;

class SalesController extends Controller
{
	public function accounts()
	{
		$accounts = Forrest::sobjects('Account')['recentItems'];

		// dd($accounts['recentItems']);

		return view('account.index', compact('accounts'));
	}

	public function addAccount()
	{
		return view('account.add');
	}

	public function store(Request $request)
	{
		// create new account on salesforce.
		Forrest::sobjects('Account',[
		    'method' => 'post',
		    'body'   => [
		    	'Name' => $request->Name,
		    	'Phone' => $request->Phone
		    ]
		]);

		$request->session()->flash('status', 'Account has been created.');
		return redirect()->route('salesforce.account');
	}

	public function destroy($id, Request $request)
	{
		$request->session()->flash('status', 'Account has been deleted.');
		Forrest::sobjects('Account/' . $id, ['method' => 'delete']);
		return redirect()->route('salesforce.account');
	}

	public function editAccount($id)
	{
		$account = Forrest::sobjects('Account/' . $id);
		return view('account.edit', compact('account'));
	}

	public function update($id, Request $request)
	{
		Forrest::sobjects('Account/' . $id,[
		    'method' => 'patch',
		    'body'   => [
		        'Name'  => $request->Name,
		        'Phone' => $request->Phone
		    ]
		]);

		$request->session()->flash('status', 'Account has been updated.');
		return redirect()->route('salesforce.account');
	}

	public function createJob()
	{
		$response = Forrest::post('/services/data/v41.0/jobs/ingest', [
		    "object" => "Contact",
		    "contentType" => "CSV",
		    "operation" => "insert",
		    "lineEnding" => "CRLF"
		]);

		$content = $response;

		dd($content);
	}

	public function getAllJobs()
	{
		$response = Forrest::get('/services/data/v41.0/jobs/ingest');

		return $response;
	}

	public function deleteJobs()
	{
		$jobs = Forrest::get('/services/data/v41.0/jobs/ingest');

		foreach ($jobs['records'] as $key => $job) {
			if ($job['apiVersion'] == 41.0) {
				Forrest::delete('/services/data/v41.0/jobs/ingest/' . $job['id']);
			}
		}

	}

	public function abortJob()
	{
		$jobs = Forrest::get('/services/data/v41.0/jobs/ingest');

		foreach ($jobs['records'] as $key => $job) {
			if ($job['apiVersion'] == 41.0) {
				Forrest::patch('/services/data/v41.0/jobs/ingest/' . $job['id'], [
					"state" => "Aborted"
				]);
			} else {
				Forrest::patch('/services/data/v44.0/jobs/ingest/' . $job['id'], [
					"state" => "Aborted"
				]);
			}
		}
	}

	public function contacts()
	{
		return view('contact.index');
	}

	public function importCsv(Request $request)
	{
		$file = $request->file;
		$csvdata = file_get_contents($file);

		$rows = array_map('str_getcsv', explode("\n", $csvdata));

		$header = array_shift($rows);

		$new_data = [];
		foreach ($rows as $row) {
			$new_data[] = $row = array_combine($header, $row);
		}

		dd($new_data);
	}
}
