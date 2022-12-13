<?php

namespace App\Http\Controllers;

use App\Mail\SuccesMail;
use App\Models\Deposit;
use App\Models\Project;
use App\Rules\DepositValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;


class DepositController extends Controller
{
    public function deposit($id)
    {
        $project = Project::find($id);
        return view('deposits.create', ['project' => $project]);
    }

    public function store(Request $request)
    {
        $request->validate(['amount' => new DepositValidation()]);

        $project = Project::find($request['project_id']);
        $project->progress = $project->progress + $request['amount'];
        if ($project->goal == $project->progress) {
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

    public function charge(Request $request)
    {
        $request->validate(['amount' => new DepositValidation()]);

        $user = Auth::user();
        return view('deposits.payment',[
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'price' => $request['amount']
        ]);
    }

    public function processPayment(Request $request, $price)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        try
        {
            $user->charge($price*100, $paymentMethod);
        }
        catch (\Exception $e)
        {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect()->route('dashboard');
    }
}
