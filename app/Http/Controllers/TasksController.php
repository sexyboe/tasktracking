<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'taskName' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'project_id' => 'required', // Add this line to validate the presence of project_id
        ]);

        // Create and save the task with start time
        $task = tasks::create([
            'user_id' => auth()->id(),
            'project_id' => $request->input('project_id'),
            'taskname' => $request->input('taskname'),
            'description' => $request->input('description'),
            'start_time' => Carbon::now(),
        ]);

        // Redirect or do other actions
        return redirect()->route('frontend.task')->with('success', 'Task created successfully.');
    }




    public function startTimer(Request $request, $taskId)
    {
        // Validate the request data if needed
        $request->validate([
            'start_time' => 'required|numeric',
        ]);

        $startTime = $request->input('start_time');

        // Find the task by ID
        $task = tasks::findOrFail($taskId);

        // Update the start_time field in the tasks table
        $task->start_time = $startTime;
        $task->save();

        return response()->json(['status' => 'success', 'message' => 'Timer data saved successfully']);
    }









    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(tasks $tasks)
    {
        //
    }
}
