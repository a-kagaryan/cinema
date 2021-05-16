<?php

namespace App\Rules;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ScheduleAvailable implements Rule
{
    protected Carbon $endTime;
    protected int $hallId;
    protected Carbon $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $hallId, Carbon $date, Carbon $endTime)
    {
        $this->endTime = $endTime;
        $this->hallId = $hallId;
        $this->date = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return !Schedule::where(['hall_id' => $this->hallId, 'date' => $this->date->toDateString()])
            ->where(function ($query) use ($value) {
                return $query->whereBetween('start_time', [$value, $this->endTime])
                    ->orWhereBetween('end_time', [$value, $this->endTime]);
            })
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This period already in use for this hall.';
    }
}
