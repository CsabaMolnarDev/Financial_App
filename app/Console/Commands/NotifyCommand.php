<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use App\Models\User;
use Carbon\Carbon;

class NotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //iterate over the users by chunks, its optimal for bigger user base
        User::chunk(50, function ($users){
            foreach ($users as $user) {
                $userTime = Carbon::now()->setTimezone($user->timezone);

                if($userTime->hour == 18){
                    Mail::to($user->email)->send(new NotificationMail());
                }
            }

        });
    }
}
