<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\models\Todo;
use Illuminate\Http\Request;

/**
 * @group  Todos management
 * APIs for managing Todos
 * authenticated false
 */
class TodosController extends Controller
{
    /**
     * Get List of Todos
     * [Insert optional longer description of the API endpoint here.]
     * @queryParam is_completed boolean optional Field to filter by if they have been done or not
     * @response {
     * "data": [
     * {
     * "title": "first  todo updated",
     * "is_completed": 0
     * },
     * {
     * "title": "second todo",
     * "is_completed": 0
     * },
     * {
     * "title": "third  todo",
     * "is_completed": 0
     * },
     * {
     * "title": "fourth  todo",
     * "is_completed": 1
     * }
     * ],
     * "links": {
     * "first": "http://localhost:8000/api/v1/todos?page=1",
     * "last": "http://localhost:8000/api/v1/todos?page=1",
     * "prev": null,
     * "next": null
     * },
     * "meta": {
     * "current_page": 1,
     * "from": 1,
     * "last_page": 1,
     * "path": "http://localhost:8000/api/v1/todos",
     * "per_page": 10,
     * "to": 4,
     * "total": 4
     * }
     * }
     */

    public function index(Request $request)
    {
        $this->validate($request, [
            'is_completed' => 'boolean'
        ]);

        return TodoResource::collection(Todo::withFilters());


    }

    /**
     * Create a Todo
     * @bodyParam  title string required The title of the todo.
     * @response  201 {
     * "data": {
     * "id": 3,
     * "title": "neww  todo",
     * "is_completed": null
     * }
     * }
     * @response  422 {
     * "title": [
     * "The title field is required."
     * ]
     * }
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string'
        ]);
        return TodoResource::make(Todo::create($request->only('title')));
    }

    /**
     * Update a Todo Item
     * @urlParam id required id of todo that you want to update
     * @bodyParam  title string required The title of the todo.
     * @bodyParam  is_completed boolean required The state if tge todo, if it has been done or not
     * @response  200
     * 1
     *
     * @response  422 {
     * "title": [
     * "The title field is required."
     * ],
     * "is_completed": [
     * "The is completed field is required."
     * ]
     * }
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'is_completed' => 'required|boolean'
        ]);

        return Todo::findOrFail($id)->update($request->only('title', 'is_completed'));
    }

    /**
     * Remove a Todo Item
     * @urlParam id required id of todo that you want to remove
     * @response  200
     * 1
     */
    public function destroy($id)
    {
        return Todo::findOrFail($id)->delete();
    }
}
