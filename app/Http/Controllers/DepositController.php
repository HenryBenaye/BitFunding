<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function deposit($id)
    {
        $project = Project::find($id);
        return view('deposits.create', ['project'=>$project]);
    }

    public function store(Request $request)
    {
        $project = Project::find($space->id);
        $space->name = $request['space_name'];
        $space->max_students = $request['max_students'];
        $space->update();
        return redirect()->route('space.index');
    }
}
