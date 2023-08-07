<?php

namespace App\Http\Controllers;


use App\Models\project;
use App\Models\tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    public function ok()
    {
        return view('ok');
    }
    public function index()
    {
        return view('frontend.dashboard');
    }
    public function profilepage()
    {
        return view('frontend.profile');
    }
    public function showProject(Request $request)
    {

        $search = $request->input('search');

        $user_id = Auth::id();

        $projects = Project::where('user_id', $user_id)
            ->when($search, function ($query) use ($search) {
                $query->where('projectName', 'like', '%' . $search . '%');
            })
            ->paginate(3);
        return view('frontend.projects', compact('projects', 'search'));
    }



    public function showTask(Request $request)
    {
        $search = $request->input('search', '');

        $user_id = Auth::id();

        $tasks = tasks::where('user_id', $user_id)
            ->when($search, function ($query) use ($search) {
                $query->where('taskname', 'like', '%' . $search . '%');
            })
            ->paginate(5);
        return view('frontend.tasks', compact('tasks', 'search'));
    }
}
