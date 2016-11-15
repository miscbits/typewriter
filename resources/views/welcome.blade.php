@extends('layouts.home')

@section('app-content')
    {!! Form::open(['route' => 'notes.store']) !!}

    {!! InputMaker::create('body', ['type' => 'text','alt_name' => 'Note Body','class' => 'form-control']) !!}

    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}

    {!! Form::close() !!}
@stop