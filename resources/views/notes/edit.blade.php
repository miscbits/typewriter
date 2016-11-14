<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($note, ['route' => ['notes.update', $note->id], 'method' => 'patch']) !!}

    @form_maker_object($note, FormMaker::getTableColumns('notes'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
