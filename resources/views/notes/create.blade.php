<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'notes.store']) !!}

    @form_maker_table("notes")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>