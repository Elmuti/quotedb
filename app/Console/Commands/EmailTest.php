<?php

namespace App\Console\Commands;

use App\Mail\QuoteAdded;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email-test';

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
        $user = User::where('id', 1)->firstOrFail();
        $quote = $user->quotes()->inRandomOrder()->first();
        $pending = Mail::to(config('quotedb.mailToAddress'));
        try {
            $sent = $pending->send(new QuoteAdded(quote: $quote));
            $this->info($sent->getDebug());
            $this->info($sent->toString());
        } catch (\Exception $ex) {
            Log::Error($ex);
        }
    }
}
