@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Terms of Service</div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="form-group">
                    <a href="{{ route('terms/add') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="panel-body">
                    @foreach($terms as $term)
                    <div class="form-group">
                        <b>
                            {{ $term->id }}.
                            {{ $term->administrative_name }}
                            @if($term->published)
                            (Published on: {{ $term->publication_date }})
                        </b>
                        @else
                        (Unpublished)
                        </b>
                        If you want to publish, you can click <a href="{{ route('terms/publish', ['id'=>$term->id]) }}">here</a>
                        <br/>
                        <a href="{{ route("terms/edit", ['id'=>$term->id]) }}">Edit</a> | 
                        <a href="{{ route("terms/delete", ['id'=>$term->id]) }}">Delete</a> 
                        @endif
                        <br/>
                        {{ $term->content }}.
                    </div>    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection