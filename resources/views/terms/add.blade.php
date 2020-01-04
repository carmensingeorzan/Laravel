@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Terms Service</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('terms/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('administrative_name') ? ' has-error' : '' }}">
                            <label for="administrative_name" class="col-md-4 control-label">Administrative Name</label>

                            <div class="col-md-6">
                                <input id="administrative_name" type="text" class="form-control" name="administrative_name" value="{{ old('administrative_name') }}" autofocus>

                                @if ($errors->has('administrative_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('administrative_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="54" id="content" name="content" class="form-control" value="{{ old('content') }}"></textarea>

                                @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
                            <div style="margin-left:160px">
                                <label class="control-label">
                                    <input type="checkbox" name="published" {{ old('published') ? 'checked' : '' }}> 
                                    Published
                                </label>
                            </div>

                            <div class="col-md-6">
                                @if ($errors->has('published'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('published') }}</strong>
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
