<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TodosControllerTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatingTodoInDatabase()
    {
        $response = $this->post('/api/v1/todos/', ['title' => 'My Test Todo in Db']);

        $response->seeStatusCode(201);

        $response->seeJson([
            'title' => 'My Test Todo in Db'
        ]);

        $this->seeInDatabase('todos', ['title' => 'My Test Todo in Db']);
    }

    /**
     * @test
     */
    public function testCreatingTodoInDatabaseShouldFail()
    {
        $response = $this->post('/api/v1/todos/', []);

        $response->seeStatusCode(422);

        $response->seeJson([
            'title' => ['The title field is required.']
        ]);
    }

    /**
     * @test
     */
    public function testUpdatingTodoInDatabase()
    {
        $todo = \App\models\Todo::Create(['title' => 'my update test in db']);

        $response = $this->patch(('/api/v1/todos/' . $todo->id), [
            'title' => 'my update test in db has been updated',
            'is_completed' => 1
        ]);

        $response->seeStatusCode(200);

        $this->seeInDatabase('todos', [
            'title' => 'my update test in db has been updated',
            'is_completed' => 1
        ]);
    }

    /**
     * @test
     */
    public function testUpdatingTodoInDatabaseShouldFail()
    {
        $todo = \App\models\Todo::Create(['title' => 'my update test in db should fail']);

        $response = $this->patch(('/api/v1/todos/' . $todo->id), [
            'title' => 'my update test in db should fail has been updated'
        ]);

        $response->seeStatusCode(422);

        $response->seeJson([
            'is_completed' => ['The is completed field is required.']
        ]);

        $this->notSeeInDatabase('todos', [
            'title' => 'my update test in db should fail has been updated',
        ]);
    }

    /**
     * @test
     */
    public function testDeletingTodoInDatabase()
    {
        $todo = \App\models\Todo::Create(['title' => 'my delete test in db']);

        $response = $this->delete(('/api/v1/todos/' . $todo->id));

        $response->seeStatusCode(200);

        $this->notSeeInDatabase('todos', ['title' => 'my delete test in db']);
    }

    /**
     * @test
     */
    public function testGettingTodosJson()
    {
        \App\models\Todo::Create(['title' => 'my getting test in db 1']);
        \App\models\Todo::Create(['title' => 'my getting test in db 2']);
        \App\models\Todo::Create(['title' => 'my getting test in db 3']);

        $response = $this->get('/api/v1/todos/');

        $response->seeStatusCode(200);

        $response->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'is_completed'
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ], 'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ]
        ]);
    }

    /**
     * @test
     */
    public function testGettingTodosJsonForJustIsCompleted()
    {
        \App\models\Todo::Create(['title' => 'my getting isCompleted test in db 1', 'is_completed' => 1]);
        \App\models\Todo::Create(['title' => 'my getting isCompleted test in db 2']);
        \App\models\Todo::Create(['title' => 'my getting isCompleted test in db 3']);

        $response = $this->get('/api/v1/todos/?is_completed=1');

        $response->seeStatusCode(200);

        $response->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'is_completed'
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ], 'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ]
        ]);

        $response->seeJson([
            'is_completed' => "1"
        ]);

        $response->dontSeeJson([
            'is_completed' => "0"
        ]);
    }

    /**
     * @test
     */
    public function testGettingTodosJsonForJustNotCompleted()
    {
        \App\models\Todo::Create(['title' => 'my getting NotCompleted test in db 1', 'is_completed' => 0]);
        \App\models\Todo::Create(['title' => 'my getting NotCompleted test in db 2','is_completed' => 1]);

        $response = $this->get('/api/v1/todos/?is_completed=0');

        $response->seeStatusCode(200);

        $response->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'is_completed'
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ], 'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ]
        ]);

        $response->seeJson([
            'is_completed' => "0"
        ]);

        $response->dontSeeJson([
            'is_completed' => "1"
        ]);
    }
}
