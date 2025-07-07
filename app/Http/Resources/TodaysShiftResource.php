<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodaysShiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'shift_name' => $this->shift->name,
            'date' => now()->toDateString(),
            'start_time' => \Carbon\Carbon::parse($this->shift->start_time)->format('H:i'),
            'end_time' => \Carbon\Carbon::parse($this->shift->end_time)->format('H:i'),
            'half_day_login' => \Carbon\Carbon::parse($this->shift->half_day_login)->format('H:i'),
            'check_in_buffer' => (int) $this->shift->check_in_buffer,
            'check_out_buffer' => (int) $this->shift->check_out_buffer,
            'auto_punch_out' => (int) $this->shift->auto_punch_out,
            'office_timing' => [
                'shift_hours' => (float) ($this->shift->officeTimingConfigs->shift_hours ?? 0),
                'half_day_hours' => (float) ($this->shift->officeTimingConfigs->half_day_hours ?? 0),
                'min_shift_hours' => (float) ($this->shift->officeTimingConfigs->min_shift_Hours ?? 0),
                'min_half_day_hours' => (float) ($this->shift->officeTimingConfigs->min_half_day_hours ?? 0),
            ]
        ];
    }
}
