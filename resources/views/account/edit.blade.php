@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit Account
    	{{-- <div class="pull-right"><a href="" class="btn btn-xs btn-primary">Add New</a></div> --}}
    </div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('salesforce.account.update', $account['Id']) }}">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label for="name">Account Name</label>
            <input type="text" class="form-control" value="{{ $account['Name'] }}" name="Name" id="name" aria-describedby="emailHelp" placeholder="">
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
          </div>
          <div class="form-group">
            <label for="name">Phone</label>
            <input type="number" class="form-control" value="{{ $account['Phone'] }}" name="Phone" id="name" aria-describedby="emailHelp" placeholder="">
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection