@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Boards
      <div class="pull-right"><a href="{{ route('monday.board.add') }}" class="btn btn-xs btn-primary">Add New</a></div>
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
              <th scope="col">Board Kind</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($boards)
              @foreach($boards as $key => $item)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $item['name'] }}</td>
                  <td>{{ $item['board_kind'] }}</td>
                  <td>
                    <a href="{{ route('monday.board.detail', $item['id']) }}" class="btn btn-xs btn-success">Detail</a>
                  </td>
                </tr>
              @endforeach       
            @endif
          </tbody>
        </table>
    </div>
</div>
@endsection