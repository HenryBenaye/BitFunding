<?php

namespace App\Rules;

use App\Models\Project;
use Illuminate\Contracts\Validation\InvokableRule;

class DepositValidation implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ($this->amountReached())
        {
            $fail('Dit gaat over het doelbedrag heen!');
        }

        if (request()->amount < 0)
        {
            $fail('Getal moet meer dan 0 zijn');
        }
    }

    public function amountReached()
    {
        $projectGoal = Project::find(request()->project_id);
        $projectProgress = $projectGoal->progress + request()->amount;
        return ($projectProgress > $projectGoal->goal);
    }
}
