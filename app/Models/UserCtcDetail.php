<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCtcDetail extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ctc_value', 'salary_id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
    public function createCtcHistory($ctcValue, $effectiveDate, $componentDetails)
    {
        $userDetails = UserCtcHistory::where('user_id', $this->user_id)->first();
        if ($userDetails) {
            $payload = [
                'salary_id' => $this->salary_id,
                'user_id' => $this->user_id,
                'ctc_value' => $ctcValue,
                'effective_date' => $effectiveDate,
            ];
        } else {
            $payload = [
                'salary_id' => $this->salary_id,
                'user_id' => $this->user_id,
                'ctc_value' => $ctcValue,
                'effective_date' => $this->user->details->joining_date,
            ];
        }
        $ctctHistoryDetail = UserCtcHistory::create($payload);
        foreach ($componentDetails as $details) {
            $details['user_ctc_history_id'] = $ctctHistoryDetail->id;
            $details['salary_id'] = $this->salary_id;
            UserCtcComponentHistory::create($details);
        }
    }

    public function effectiveDate()
    {
        return UserCtcHistory::where('salary_id',$this->salary_id)->latest()->first()->effective_date ?? '';
    }
}
