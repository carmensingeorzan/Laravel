@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Term</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('terms/update', ['id' => $term->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('administrative_name') ? ' has-error' : '' }}">
                            <label for="administrative_name" class="col-md-4 control-label">Administrative Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="administrative_name" value="{{ $term->administrative_name }}" autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('administrative_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="54" id="content" name="content" class="form-control">{{ $term->content }}</textarea>

                                @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
