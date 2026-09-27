<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('marketlink:promote-admin {email}', function (string $email) {
    $user = User::where('email', $email)->first();

    if (! $user) {
        $this->error('No account exists with that email. Register it first.');

        return self::FAILURE;
    }

    $user->forceFill(['role' => 'admin', 'is_active' => true])->save();
    $this->info("{$email} can now sign in as an administrator.");

    return self::SUCCESS;
})->purpose('Promote an existing account to MarketLink administrator');
