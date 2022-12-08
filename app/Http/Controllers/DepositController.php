<?php

namespace App\Http\Controllers;

use App\Mail\SuccesMail;
use App\Models\Deposit;
use App\Models\Project;
use App\Rules\DepositValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
    public function deposit($id)
    {
        $project = Project::find($id);
        return view('deposits.create', ['project'=>$project]);
    }

    public function store(Request $request)
    {
        $request->validate(['amount' => new DepositValidation()]);

        $project = Project::find($request['project_id']);
        $project->progress = $project->progress + $request['amount'];
        if ($project->goal == $project->progress)
        {
            Mail::to('henry.be@outlook.com')->send(new SuccesMail());
        }
        $project->update();


        $deposit = new Deposit();
        $deposit->amount = $request['amount'];
        $deposit->user_id = Auth::user()->id;
        $deposit->project_id = $project->id;
        $deposit->save();


        return redirect()->route('dashboard');
    }
}
