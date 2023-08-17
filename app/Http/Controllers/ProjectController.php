<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Models\project;
use App\Models\tasks;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function deleteProjects(Request $request, $project_id)
    {
        $project = Project::findOrFail($project_id);
        $project->delete();
        return redirect()->route('projects')->with('success', 'Projects deleted successfully');
    }

    public function updateProjects(Request $request, $project_id)
    {
        // Validate the request data if needed
        $validatedData = $request->validate([
            'projectName' => 'required|string|max:255|',
            'descriptions' => 'required|string|max:230',
            'dueDate' => 'required|date|after_or_equal:today',
            // Add other validation rules as needed
        ]);

        $projects = project::findOrFail($project_id);

        $projects->update([
            'projectName' => $validatedData['projectName'],
            'descriptions' => $validatedData['descriptions'],
            'dueDate' => $validatedData['dueDate'],
            'user_id' => $request->user_id,

        ]);

        $search = '';
        if ($projects) {
            return redirect()->route('projects')->with('success', 'project Updated Succesfully');
            // return view('frontend.projects', compact('search', 'projects'))->with('success', 'Project Updated.');
        } else {
            Session::flash('taskName', $request->input('taskName'));
            Session::flash('descriptions', $request->input('descriptions'));
            Session::flash('dueDate', $request->input('dueDate'));
            return redirect()->back()->withInput()->withErrors(['errors' => 'Invalid credentials. Please try again.']);
        }
    }

    public function editProject(Request $request, $id)
    {
        $projects = Project::findOrFail($id);

        return view('frontend.updateProject', compact('projects'));
    }

    public function createTask1(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate(
            [
                'taskname' => 'required|max:255|unique:tasks',
                'description' => 'required',
                'project_id' => 'required',
            ]
        );

        $task = tasks::create([
            'taskname' => $validatedData['taskname'],
            'description' => $validatedData['description'],
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
        ]);


        if ($task) {
            return redirect()->back()->with('success', 'Task created successfully.');
        } else {
            Session::flash('taskname', $request->input('taskname'));
            Session::flash('description', $request->input('description'));

            return redirect()->back()->withInput()->withErrors(['errors' => 'Invalid credentials. Please try again.']);
        }
    }
    public function createTask(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate(
            [
                'taskname' => 'required|max:255|unique:tasks',
                'description' => 'required',
                'project_id' => 'required',
            ]
        );

        $task = tasks::create([
            'taskname' => $validatedData['taskname'],
            'description' => $validatedData['description'],
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
        ]);


        if ($task) {
            return redirect()->back()->with('success', 'Task created successfully.');
        } else {
            Session::flash('taskname', $request->input('taskName'));
            Session::flash('description', $request->input('description'));

            return redirect()->back()->withInput()->withErrors(['errors' => 'Invalid credentials. Please try again.']);
        }
    }





    public function create(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'projectName' => 'required|string|max:255|:projects', // Add 'unique' rule here
            'dueDate' => 'required|date|after_or_equal:today',
            'descriptions' => 'required|string|max:255',
        ], [
            // Custom error messages for each validation rule
            'projectName.required' => 'The project name is required.',
            'projectName.string' => 'The project name must be a string.',
            'projectName.max' => 'The project name may not be greater than :max characters.',
            'projectName.unique' => 'The project name is already exist.', // Custom message for uniqueness
            'dueDate.required' => 'The due date is required.',
            'dueDate.date' => 'The due date must be a valid date.',
            'dueDate.after_or_equal' => 'The due date must be in the future or present.',
            'descriptions.string' => 'The descriptions must be a string.',
            'descriptions.max' => 'The descriptions may not be greater than :max characters.',
        ]);

        if ($validator->fails()) {
            // Redirect back with the errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        project::create([
            'projectName' => $request->projectName,
            'dueDate' => $request->dueDate,
            'descriptions' => $request->descriptions,
            'user_id' => $request->user_id,

        ]);


        return redirect()->back()->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        //
    }
    public function viewProject($project_id)
    {

        $projects = Project::findOrFail($project_id);
        $now = Carbon::now();
        $dueDate = Carbon::parse($projects->dueDate);
        $remainingTime = $dueDate->diff($now);


        return view('frontend.viewProject', compact('projects', 'remainingTime'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($projects)
    {
        $project = project::findOrFail($projects);

        // Delete the project
        $project->delete();
        return redirect()->route('projects')->with('success', 'project Deleted Succesfully');
    }
}
