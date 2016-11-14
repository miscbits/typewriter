<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NoteAcceptanceTest extends TestCase
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
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'notes');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('notes');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'notes/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'notes', $this->note->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('notes/'.$this->note->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'notes', $this->note->toArray());

        $response = $this->actor->call('GET', '/notes/'.$this->note->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('note');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'notes', $this->note->toArray());
        $response = $this->actor->call('PATCH', 'notes/1', $this->noteEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('notes', $this->noteEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'notes', $this->note->toArray());

        $response = $this->call('DELETE', 'notes/'.$this->note->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('notes');
    }

}
