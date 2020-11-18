<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class NewCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'new
                            {project-name : The name of the project}
                           ';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new project with the Cat framework';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        /**
        * Download boilerplate and setup project.
        *
        * @return bool
        */
        $this->task("Downloading boilerplate and setting up project", function () {

            echo "\n\n";

            $command = shell_exec('git clone https://github.com/vasco-martins/cat.git ' . $this->argument('project-name'));

            if(is_null($command)) {



                $command = chdir($this->argument('project-name'));

                $installComposer = shell_exec('composer install');

                $command = chdir('Cat');

                $submoduleInit = shell_exec('git submodule init');
                $submoduleUpdate = shell_exec('git submodule update');

                return true;

            }

            return false;

        });

    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
