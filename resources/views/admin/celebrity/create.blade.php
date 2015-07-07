@extends('admin.layouts.one_col')

@section('title')
    <h1>Add Celebrity</h1>
@stop

@section('style')
    @parent
@stop

@section('script')
    @parent
@stop

@section('content')

    <div class="mTop10">
        {!! Form::open(['action' => 'Admin\CelebrityController@store', 'method' => 'post','files'=>true, 'class'=>'form-horizontal'])
        !!}

        <div class="form-group">
            {!! Form::label('name', 'Celebrity Name', ['class' => 'control-label']) !!} <span class="red">*</span>
            {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Celebrity Name']) !!}
        </div>

        <div class="form-group">
            <span class="btn btn-default fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Select Celebrity Image...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="thumbnail" type="file" name="thumbnail" class="cover form-control">
            </span>
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@stop