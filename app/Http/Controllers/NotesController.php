<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NoteService;
use App\Http\Requests\NoteRequest;

class NotesController extends Controller
{
    public function __construct(NoteService $noteService)
    {
        $this->service = $noteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = $this->service->paginated();
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $notes = $this->service->search($request->search);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('notes.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('notes.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the notes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = $this->service->find($id);
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the notes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = $this->service->find($id);
        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the notes in storage.
     *
     * @param  \Illuminate\Http\NoteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the notes from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('notes.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('notes.index'))->with('message', 'Failed to delete');
    }
}
