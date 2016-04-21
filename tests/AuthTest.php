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

        // http://localhost/admin/auth/password/reset/abad32327f28e484c6aa7cd9b90b2d5a73acc1747d79469dc7b8e6d158f5b452

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

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
//        $this->actingAs(User::find(1))
//            ->visit('admin/users/create')
//            ->type('Bob', 'name')
//            ->type('bob@bob.com', 'email')
//            ->type('password', 'password')
//            ->check('is_admin')
//            ->press('Save')
//            ->seePageIs('admin/users');
//
//        $retrievedResource = User::find(2);
//
//        $this->assertEquals('Bob', $retrievedResource->name);
//        $this->assertEquals('bob@bob.com', $retrievedResource->email);
//        $this->assertTrue(Hash::check('password', $retrievedResource->password));
//        $this->assertEquals('1', $retrievedResource->is_admin);
    }
}