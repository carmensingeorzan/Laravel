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
                <div class="panel-body">
                    <div class="form-group">
                        <b>
                            {{ $term->id }}. 
                            {{ $term->administrative_name }}
                            @if($term->published)
                            (Published on: {{ $term->publication_date }})
                        </b>
                        @else
                        (Unpublished)
                        @endif
                        <br/>
                        {{ $term->content }}.
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection