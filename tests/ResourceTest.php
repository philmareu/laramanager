<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateResource()
    {
        $createdResource = factory(\Philsquare\LaraManager\Models\Resource::create([]));
        $retrievedResource = Resource::find(1);

        $this->assertEquals($createdResource->id, $retrievedResource->id);
    }
}
