@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Accounts
    	<div class="pull-right"><a href="{{ route('salesforce.account.add') }}" class="btn btn-xs btn-primary">Add New</a></div>
    </div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          	@if($accounts)
      				@foreach($accounts as $key => $item)
		            <tr>
		              <th scope="row">{{ ++$key }}</th>
		              <td>{{ $item['Name'] }}</td>
		              <td>
		              	<a href="{{ route('salesforce.account.edit', $item['Id']) }}" class="btn btn-xs btn-success">Edit</a>
		              	<form method="POST" action="{{ route('salesforce.account.delete', $item['Id']) }}">
	                        {{ method_field('DELETE') }}
                            {{ csrf_field() }}
	                        <button title="remove" type="submit" class="btn btn-xs btn-danger">Delete</button>
		              	</form>
		              </td>
		            </tr>
      				@endforeach      	
          	@endif
          </tbody>
        </table>
    </div>
</div>
@endsection