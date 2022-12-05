<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Project;
use App\Rules\DepositValidation;
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
        $request->validate([new DepositValidation()]);
        $project = Project::find($request['project_id']);
        $project->progress = $project->progress + $request['amount'];
        $project->update();

        $deposit = new Deposit();
        $deposit->amount = $request['amount'];
        $deposit->user_id = Auth::user()->id;
        $deposit->project_id = $project->id;
        $deposit->save();

        return redirect()->route('dashboard');
    }
}
