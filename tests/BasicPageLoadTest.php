<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Philsquare\LaraManager\Models\User;

class BasicPageLoadTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminRedirectsToDashboard()
    {
        $this->withoutMiddleware();

        $this->call('GET', 'admin');
        $this->assertRedirectedTo('admin/dashboard');
    }

    /**
     * @dataProvider provideBasicRoutes
     */
    public function testPageLoads($method, $route)
    {
        $this->actingAs(User::find(1))
            ->call($method, $route);
        $this->assertResponseOk();
    }

    public function provideBasicRoutes()
    {
        return [
            ['GET', 'admin/dashboard']
        ];
    }

    /**
     * @dataProvider provideBasicRoutes
     */
    public function testFormLoads($method, $route)
    {
        $this->actingAs(User::find(1))
            ->call($method, $route);
        $this->assertResponseOk();
    }

    public function provideFormRoutes()
    {
        return [
            ['GET', 'admin/dashboard']
        ];
    }
}