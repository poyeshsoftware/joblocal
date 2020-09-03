<?php

namespace App\Http\Controllers;

use App\models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(){
        return Todo::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string'
        ]);
        return Todo::create($request->only('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'is_completed' => 'required|boolean'
        ]);

        return Todo::findOrFail($id)->update($request->only('title','is_completed'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Todo::findOrFail($id)->delete();
    }
}
