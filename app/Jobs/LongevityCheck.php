<?php

namespace App\Jobs;

use App\Mail\FailedMail;
use App\Mail\SuccesMail;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LongevityCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Project::all() as $project)
        {
            $date = Carbon::now()
                ->diffInWeeks(
                    Carbon::parse($project->created_at));

            if ($date > 14)
            {
                Project::destroy($project->id);
                Mail::to('henry.be@outlook.com')->send(new FailedMail());
            }
        }
    }
}
