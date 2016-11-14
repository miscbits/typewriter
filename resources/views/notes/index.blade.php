<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'notes.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Notes</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('notes.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($notes->isEmpty())
            <div class="well text-center">No notes found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($notes as $note)
                    <tr>
                        <td>
                            <a href="{!! route('notes.edit', [$note->id]) !!}">{{ $note->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('notes.edit', [$note->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('notes.destroy', [$note->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this note?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $notes; !!}
            </div>
        @endif
    </div>
</div>