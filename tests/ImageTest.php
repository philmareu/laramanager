<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Philsquare\LaraManager\Models\Image;
use Philsquare\LaraManager\Models\Resource;
use Philsquare\LaraManager\Models\User;

class ImageTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    public function testCreateAndRetrieveImageWithEloquent()
    {
        $image = new Image();
        $image->create([
            'filename' => 'sunflower.png',
            'title' => 'Sunflower',
            'description' => 'It is a sunflower.',
            'original_filename' => 'image001.png',
            'alt' => 'A photograph of a sunflower',
            'size' => 200000
        ]);

        $retrievedImage = Image::find(1);

        $this->assertEquals('sunflower.png', $retrievedImage->filename);
        $this->assertEquals('Sunflower', $retrievedImage->title);
        $this->assertEquals('It is a sunflower.', $retrievedImage->description);
        $this->assertEquals('image001.png', $retrievedImage->original_filename);
        $this->assertEquals('A photograph of a sunflower', $retrievedImage->alt);
        $this->assertEquals(200000, $retrievedImage->size);
    }

    public function testUpdateImageWithEloquent()
    {
        $image = new Image();
        $image->create([
            'filename' => 'sunflower.png',
            'title' => 'Sunflower',
            'description' => 'It is a sunflower.',
            'original_filename' => 'image001.png',
            'alt' => 'A photograph of a sunflower',
            'size' => 200000
        ]);

        $retrievedImage = Image::find(1);
        $retrievedImage->update([
            'filename' => 'tree.png',
            'title' => 'Tree',
            'description' => 'It is a tree.',
            'original_filename' => 'image002.png',
            'alt' => 'A photograph of a tree',
            'size' => 500000
        ]);

        $retrievedImage = Image::find(1);

        $this->assertEquals('tree.png', $retrievedImage->filename);
        $this->assertEquals('Tree', $retrievedImage->title);
        $this->assertEquals('It is a tree.', $retrievedImage->description);
        $this->assertEquals('image002.png', $retrievedImage->original_filename);
        $this->assertEquals('A photograph of a tree', $retrievedImage->alt);
        $this->assertEquals(500000, $retrievedImage->size);
    }

    public function testDeleteImageWithEloquent()
    {
        $image = new Image();
        $image->create([
            'filename' => 'sunflower.png',
            'title' => 'Sunflower',
            'description' => 'It is a sunflower.',
            'original_filename' => 'image001.png',
            'alt' => 'A photograph of a sunflower',
            'size' => 200000
        ]);

        $retrievedImage = Image::find(1);
        $retrievedImage->delete();

        $this->assertNull(Image::whereId(1)->first());
    }

    public function testImageUpdateThroughEndPoint()
    {
        if(file_exists(storage_path('app/laramanager/images/tree.jpg'))) unlink(storage_path('app/laramanager/images/tree.jpg'));
        copy(__DIR__ . '/files/sunflower.jpg', storage_path('app/laramanager/images/sunflower.jpg'));

        $image = new Image();
        $image->create([
            'filename' => 'sunflower.jpg',
            'title' => 'Sunflower',
            'description' => 'It is a sunflower.',
            'original_filename' => 'image001.jpg',
            'alt' => 'A photograph of a sunflower',
            'size' => 200000
        ]);

        $this->call('PUT', 'admin/images/1', [
            'filename' => 'tree.jpg',
            'title' => 'Tree',
            'description' => 'It is a tree.',
            'original_filename' => 'image002.jpg',
            'alt' => 'A photograph of a tree'
        ]);

        $this->assertResponseOk();
        $this->seeJson([
            'attributes' => [
                'filename' => 'tree.jpg',
                'title' => 'Tree',
                'description' => 'It is a tree.',
                'original_filename' => 'image002.jpg',
                'alt' => 'A photograph of a tree'
            ],
            'paths' => [
                'original' => url('images/original/tree.jpg')
            ]
        ]);
    }
}