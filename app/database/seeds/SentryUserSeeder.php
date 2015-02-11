<?php
class SentryUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        Sentry::getUserProvider()->create(array(
            'email'    => 'admin@admin.com',
            'password' => 'sentryadmin',
            'activated' => 1,
            'subscription_id' => 1,
            'username' => 'admin'
        ));
        Sentry::getUserProvider()->create(array(
            'email'    => 'user@user.com',
            'password' => 'sentryuser',
            'activated' => 1,
            'subscription_id' => 0,
            'username' => 'users'
        ));
    }
}