<?php

namespace App\Console;

use App\Events\SendAdminNotificationUserRegisted;
use App\Mail\SendMail;
use App\Models\Course;
use App\Models\Notification;
use App\Models\User;
use App\Models\User_Course;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $data = User_Course::select(DB::raw('user_id, course_id'))->whereNull('end_day')->get();

            Notification::destroy(Notification::where('role', "<>", "ADM")->pluck('id'));

            $users = [];
            foreach ($data as $item) {
                array_push($users, $item->user_id);
            }
            $users = array_unique($users);
            $_max = max($users);
            $userData = array_fill(1, $_max, []);

            foreach ($data as $item) {
                if (Arr::exists($userData, $item->user_id)) {
                    array_push($userData[$item->user_id], $item->course_id);
                }
            }

            foreach ($userData as $key => $value) {
                if (count($value) == 0) {
                    unset($userData[$key]);
                }
            }

            foreach ($userData as $user_id=>$courses_id) {
                $user = User::find($user_id);
                $email = $user->email;
                $name = $user->name;
                $body = 'You have not completed the course: *';
                foreach ($courses_id as $course_id){
                    $course = Course::find($course_id);
                    $body .= "- $course->name (". Config::get('app.url') ."/lessons/$course_id) *";
                    event(new SendAdminNotificationUserRegisted($email, $course, Config::get('variable.notifi_user_completed_course')));
                }

                $details = [
                    'title' => 'Dear ' . $name,
                    'body' => $body. "Please try to take some time to complete it! Fighting ^^",
                ];

                Mail::to($email)->send(new SendMail($details));

            }
        })->dailyAt('17:00')->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected function scheduleTimezone()
    {
        return 'Asia/Ho_Chi_Minh';
    }
}
