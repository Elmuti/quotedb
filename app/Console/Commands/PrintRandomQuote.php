<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PrintRandomQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:print {--email=}';

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
        $user = User::where('email', $this->option('email'))->firstOrFail();
        $quote = $user->quotes()->inRandomOrder()->first();
        $this->alert($quote->quote);
    }
}
