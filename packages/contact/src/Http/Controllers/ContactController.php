<?php

namespace Bicky\Contact\Http\Controllers;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
	public function index()
	{
		return view('contact::contact');
	}
}