<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laradev\Models\User;
use Philsquare\LaraManager\Models\Resource;

class ResourceTest extends TestCase
{
    use DatabaseMigrations;

    public function testResourcePageLoads()
    {
        $response = $this->actingAs(User::find(1))
            ->call('GET', 'admin/resources');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateResource()
    {
        $this->actingAs(User::find(1))
            ->visit('admin/resources/create')
            ->type('Events', 'title')
            ->type('events', 'slug')
            ->type('Laradev', 'namespace')
            ->type('Models\Event', 'model')
            ->type('0', 'order_column')
            ->type('asc', 'order_direction')
            ->type('uk-icon-calendar', 'icon')
            ->press('Save')
            ->seePageIs('admin/resources/1/fields');

        $retrievedResource = Resource::find(1);

        $this->assertEquals('Events', $retrievedResource->title);
        $this->assertEquals('events', $retrievedResource->slug);
        $this->assertEquals('Laradev', $retrievedResource->namespace);
        $this->assertEquals('Models\Event', $retrievedResource->model);
        $this->assertEquals('0', $retrievedResource->order_column);
        $this->assertEquals('asc', $retrievedResource->order_direction);
        $this->assertEquals('uk-icon-calendar', $retrievedResource->icon);
    }
}
