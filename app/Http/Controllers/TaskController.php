<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->task->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->taskValidator($request);

        $data = $request->only(['title', 'description']);
        $data['user_id'] = Auth::user()->id;
        
        $this->task->create($data);

        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->task->findOrFail($id);
        
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->taskValidator($request);

        $task = $this->task->findOrFail($id);
        $task->update($request->only('title', 'description'));

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = $this->task->findOrFail($id);
        $task->delete();

        return response()->json(null, 200);
    }

    public function markAsDone($id){
        $task = $this->task->findOrFail($id);
        $task->done = true;
        $task->save();

        return response()->json(null, 200);
    }

    private function taskValidator($request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
    }
}
