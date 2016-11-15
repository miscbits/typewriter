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
		'title' => 'laravel',
		'body' => 'I am Batman',
		'user_id' => '1',
		'created_at' => '2016-11-15 12:18:35',
		'updated_at' => '2016-11-15 12:18:35',

        ]);
        $this->noteEdited = factory(App\Models\Note::class)->make([
            'id' => '1',
		'title' => 'laravel',
		'body' => 'I am Batman',
		'user_id' => '1',
		'created_at' => '2016-11-15 12:18:35',
		'updated_at' => '2016-11-15 12:18:35',

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
