@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Boards ({{ $board['name'] }})
      {{-- <div class="pull-right"><a href="{{ route('monday.board.add') }}" class="btn btn-xs btn-primary">Add New</a></div> --}}
    </div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h3>Groups</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($board['groups'])
              @foreach($board['groups'] as $key => $item)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $item['title'] }}</td>
                </tr>
              @endforeach       
            @endif
          </tbody>
        </table>
    </div>
</div>
@endsection