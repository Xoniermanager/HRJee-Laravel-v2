<?php

namespace App\Http\Controllers\Employee;

use DateInterval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\HolidayServices;

class HolidaysMangementController extends Controller
{
    public $holidayService;

    public function __construct(HolidayServices $holidayService)
    {
        $this->holidayService = $holidayService;
    }
    public function index()
    {
        $allHolidayDetails = $this->holidayService->getListByCompanyId(Auth()->guard('employee')->user()->company_id);
        $calender = $this->showCalendar();
        return view('employee.holidays.index', compact('allHolidayDetails', 'calender'));
    }
    public function showCalendar($month = '', $year = '')
    {
        // First of all, lets create an array containing the names of all days in a week
        $days_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

        $month = (!empty($month)) ? (int)$month : 7; // let
        $year  = (!empty($year)) ? (int)$year : 2024; // let

        // Create a Carbon instance for the first day of the month
        $firstDayOfMonth = Carbon::create($year, $month, 1, 0, 0, 0);

        // Now getting the number of days this month contains
        $number_of_days = Carbon::now()->month($month)->daysInMonth;

        // Get the name of the month
        $monthName = $firstDayOfMonth->format('F');  // e.g., "July"
        // Get the index value (0-6) of the first day of the month
        // $dayOfWeek = $firstDayOfMonth->dayOfWeek;
        // Getting some information about the first day of this month
        // $dateToday = Carbon::now()->toDateString();  // e.g., "2024-07-03"

        // Create the HTML table
        $calendar = "<div class='calendar'><table class='table table-bordered'>";
        $calendar .= "<div class='calen-header'>";
        // $calendar .= "<h3>$monthName $year</h3>";
        $previous_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
        $previous_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
        $calendar .= "<button onclick='ajax_update_calendar($previous_month,$previous_year)' class='btn bten-pre'><i class='fa fa-chevron-left'></i></button>";
        $current_month = date('m');
        $current_year = date('Y');
        $calendar .= "<button onclick='ajax_update_calendar($current_month,$current_year)' class='btn btn-cur'> $monthName $year </button>";
        $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
        $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));
        $calendar .= "<button onclick='ajax_update_calendar($next_month,$next_year)' class='btn btn-nex'><i class='fa fa-chevron-right'></i></button>";
        $calendar .= "</div>";
        $calendar .= "<tr style='background-color:#F2F2F2;'>";
        // Create the calendar headers
        foreach ($days_of_week as $day) {
            $calendar .= "<th>$day</th>";
        }
        $calendar .= "</tr><tr>";
        // Initialize day counter
        $current_day = 1;

        // Calculate the number of empty cells before the first day of the month
        $start_day_of_week = date('w', strtotime("$year-$month-01"));
        for ($k = 0; $k < $start_day_of_week; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
        while ($current_day <= $number_of_days) {
            if ($start_day_of_week == 7) {
                $start_day_of_week = 0;
                $calendar .= "</tr><tr>";
            }
            $current_day_rel = str_pad($current_day, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$current_day_rel";
            $today_date = date('Y-m-d');

            $todayClasses = array();
            $todayClasses[] = "btn";
            $todayClasses[] = ($date == $today_date) ? "today" : "";
            $allHolidayDetails = $this->holidayService->getHolidayByDate(Auth()->guard('employee')->user()->company_id, $date);

            $todayId = '';
            $tittle = '';
            if (isset($allHolidayDetails)) {
                $todayClasses[] = "holiday addMore";
                $todayId = $date;
                $tittle = $allHolidayDetails->name;
            }
            $todayClasses = implode(' ', $todayClasses);
            $calendar .= "<td><button id='$todayId' class='$todayClasses' title='$tittle'><h4>$current_day</h4></button></td>";

            $current_day++;
            $start_day_of_week++;
        }
        // Complete the row of the last week in month, if necessary
        if ($start_day_of_week != 7) {
            $remaining_days = 7 - $start_day_of_week;
            for ($i = 0; $i < $remaining_days; $i++) {
                $calendar .= "<td></td>";
            }
        }
        $calendar .= "</tr>";
        $calendar .= "</table></div>";
        return $calendar;
    }

    public function updateCalendar(Request $request)
    {
        $updateCalenderDetails = $this->showCalendar($request->month, $request->year);
        if ($updateCalenderDetails) {
            return response()->json([
                'status' => true,
                'data'    =>  view('employee.holidays.calendar', with(['calender' => $updateCalenderDetails]))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
