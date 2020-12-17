<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessMailer;
use App\Models\User;
use Carbon\Carbon;

class MailerRemindStudentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail to students who are not in school for 7 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sevenDaysAgo = Carbon::now()->subDays(config('number.day_for_chart'));
        $users = User::where('last_studied_at', '<', $sevenDaysAgo)->get();
        if ($users->count()) {
            foreach ($users as $user) {
                ProcessMailer::dispatch($user);
            }
        }
    }
}
