<?php

namespace Arealtime\Auth\App\Console\Commands;

use Illuminate\Console\Command;

class Auth extends Command
{
    protected $signature = 'arealtime:auth';
    protected $description = 'Command for Auth module';
    public function handle()
    {
        $this->info('Auth executed successfully.');
    }
}
