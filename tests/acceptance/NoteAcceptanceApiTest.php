<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NoteAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->note = factory(App\Models\Note::class)->make([
            'id' => '1',
		'title' => '1',
		'body' => 'I am Batman',

        ]);
        $this->noteEdited = factory(App\Models\Note::class)->make([
            'id' => '1',
		'title' => '1',
		'body' => 'I am Batman',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/notes');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/notes', $this->note->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/notes', $this->note->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/notes/1', $this->noteEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('notes', $this->noteEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/notes', $this->note->toArray());
        $response = $this->call('DELETE', 'api/v1/notes/'.$this->note->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'note was deleted']);
    }

}
