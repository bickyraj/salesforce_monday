@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Contacts
    	{{-- <div class="pull-right"><a href="{{ route('salesforce.account.add') }}" class="btn btn-xs btn-primary">Contact</a></div> --}}
    </div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('salesforce.import.csv') }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Import Csv</label>
            <input type="file" class="form-control" name="file">
          </div>
          <div class="form-group">
            <input type="submit" value="Submit">
          </div>
        </form>
    </div>
</div>
@endsection