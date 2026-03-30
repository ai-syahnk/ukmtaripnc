<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CheckExpiredBookings extends Command
{
    protected $signature = 'bookings:check-expired';

    protected $description = 'Mark approved bookings as expired if payment deadline has passed';

    public function handle(): int
    {
        $count = Booking::where('status', 'approved')
            ->whereNotNull('payment_deadline')
            ->where('payment_deadline', '<', now())
            ->update(['status' => 'expired']);

        $this->info("Marked {$count} booking(s) as expired.");

        return self::SUCCESS;
    }
}
