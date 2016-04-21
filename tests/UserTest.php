<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Laradev\Models\User;
use Philsquare\LaraManager\Models\Resource;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserPageLoads()
    {
        $response = $this->actingAs(User::find(1))
            ->call('GET', 'admin/users');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->actingAs(User::find(1))
            ->visit('admin/users/create')
            ->type('Bob', 'name')
            ->type('bob@bob.com', 'email')
            ->type('password', 'password')
            ->check('is_admin')
            ->press('Save')
            ->seePageIs('admin/users');

        $retrievedResource = User::find(2);

        $this->assertEquals('Bob', $retrievedResource->name);
        $this->assertEquals('bob@bob.com', $retrievedResource->email);
        $this->assertTrue(Hash::check('password', $retrievedResource->password));
        $this->assertEquals('1', $retrievedResource->is_admin);
    }

    public function testEditUser()
    {
        $this->actingAs(User::find(1))
            ->visit('admin/users/1/edit')
            ->type('Admin2', 'name')
            ->type('admin2@admin2.com', 'email')
            ->type('newPassword', 'password')
            ->press('Update')
            ->seePageIs('admin/users');

        $retrievedResource = User::find(1);

        $this->assertEquals('Admin2', $retrievedResource->name);
        $this->assertEquals('admin2@admin2.com', $retrievedResource->email);
        $this->assertTrue(Hash::check('newPassword', $retrievedResource->password));
        $this->assertEquals('1', $retrievedResource->is_admin);
    }
}