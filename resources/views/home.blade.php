@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table"> 
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">PHONE</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <th scope="col">{{ $user->id }}</th>
                                <th scope="col">{{ $user->email }}</th>
                                <th scope="col">{{ $user->phone }}</th>
                                <th scope="col">
                                    <a href="{{route('edit', ['id' => $user->id])}}">edit</a> | 
                                    <a href="#">delete</a> |
                                    <a href="#">unverify</a>
                                </th>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
