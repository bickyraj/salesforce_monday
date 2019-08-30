@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Add New Board
    	{{-- <div class="pull-right"><a href="" class="btn btn-xs btn-primary">Add New</a></div> --}}
    </div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('monday.board.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Board Name</label>
            <input type="text" class="form-control" name="board_name" id="name" aria-describedby="" placeholder="">
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
          </div>
          <div class="form-group">
            <label for="board_kind">Board Kind</label>
            <select name="board_kind" id="" class="form-control">
              <option value="private">Private</option>
              <option value="public">Public</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection