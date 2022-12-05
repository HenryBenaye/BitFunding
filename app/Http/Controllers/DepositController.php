<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
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
        $project = Project::find($request['project_id']);
        $project->amount = $project->amount + $request['amount'];
        $project->update();

        $deposit = new Deposit();
        $deposit->user_id = Auth::user()->id;
        $deposit->project_id = $project->id;
        $deposit->save();
        
        return redirect()->route('dashboard');
    }
}
