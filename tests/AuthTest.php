<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laradev\Models\User;
use Philsquare\LaraManager\Models\Resource;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function testLinks()
    {
        $this->visit('admin/auth/login')
            ->click('Forgot Password?')
            ->seePageIs('admin/auth/password/email');

        $this->visit('admin/auth/password/email')
            ->click('Back')
            ->seePageIs('admin/auth/login');
    }

    public function testGuestAuthPages()
    {
        $this->visit('admin/auth/login')->assertResponseOk();
        $this->visit('admin/auth/password/email')->assertResponseOk();
    }

    public function testAdminCanLogIn()
    {
        $this->visit('admin/auth/login')
            ->type('admin@admin.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->seePageIs('admin/dashboard');
    }

    public function testResetPassword()
    {
        $this->visit('admin/auth/password/email')
            ->type('admin@admin.com', 'email')
            ->press('Send Password Reset Link')
            ->seePageIs('admin/auth/password/email');

        $reset = DB::table('password_resets')->where('email', 'admin@admin.com')->select('token')->first();

        $resetLink = url('admin/auth/password/reset/' . $reset->token);

        $this->visit($resetLink)
            ->type('admin@admin.com', 'email')
            ->type('newPassword', 'password')
            ->type('newPassword', 'password_confirmation')
            ->press('Reset Password')
            ->seePageIs('admin/dashboard');

        $user = User::find(1);

        $this->assertTrue(Hash::check('newPassword', $user->password));
    }
}