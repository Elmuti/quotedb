<?php

namespace App\Console\Commands;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Console\Command;

class CreateQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:create {--author=} {--quote=}';

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
        $user = User::first();
        Quote::create([
            'author' => $this->option('author'),
            'quote' => $this->option('quote'),
            'user_id' => $user->id,
        ]);
    }
}
