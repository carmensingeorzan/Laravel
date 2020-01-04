@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <form action="{{ route('search') }}" method="GET">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-controller" id="search" name="search" placeholder="Search Users"></input>
                        </div>
                    </form>

                    <table class="table"> 
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">PHONE</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="fade{{ $user->id }}">
                                <th scope="col">{{ $user->id }}</th>
                                <th scope="col">{{ $user->name }}</th>
                                <th scope="col">{{ $user->email }}</th>
                                <th scope="col">{{ $user->phone }}</th>
                                <th scope="col">
                                    <a href="{{route('edit', ['id' => $user->id])}}">Edit</a> | 
                                    <a class="deleteProduct" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}" >Delete</a> | 
                                    <a href="{{route('unverify', ['id' => $user->id])}}">Unverify</a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection