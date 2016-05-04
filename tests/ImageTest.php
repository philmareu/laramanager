<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Philsquare\LaraManager\Models\Image;
use Philsquare\LaraManager\Models\Resource;
use Philsquare\LaraManager\Models\User;
use Philsquare\LaraManager\Repositories\ImageRepository;

class ImageTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    public function testImagePageLoads()
    {
        $this->actingAs(User::find(1))
            ->call('GET', 'admin/images');
        $this->assertResponseOk();
    }

    public function testCreateAndRetrieveImage()
    {
        $this->createTestImage();
        $retrievedImage = $this->retrieveTestImage();

        $this->assertEquals('sunflower.jpg', $retrievedImage->filename);
        $this->assertEquals('Sunflower', $retrievedImage->title);
        $this->assertEquals('It is a sunflower.', $retrievedImage->description);
        $this->assertEquals('image001.jpg', $retrievedImage->original_filename);
        $this->assertEquals('A photograph of a sunflower', $retrievedImage->alt);
        $this->assertEquals(200000, $retrievedImage->size);
    }

    public function testUpdateImage()
    {
        $this->createTestImage();
        $imageRepository = new ImageRepository;

        $imageRepository->update(1, [
            'filename' => 'tree.jpg',
            'title' => 'Tree',
            'description' => 'It is a tree.',
            'original_filename' => 'image002.jpg',
            'alt' => 'A photograph of a tree',
            'size' => 500000
        ]);

        $retrievedImage = $this->retrieveTestImage();

        $this->assertEquals('tree.jpg', $retrievedImage->filename);
        $this->assertEquals('Tree', $retrievedImage->title);
        $this->assertEquals('It is a tree.', $retrievedImage->description);
        $this->assertEquals('image002.jpg', $retrievedImage->original_filename);
        $this->assertEquals('A photograph of a tree', $retrievedImage->alt);
        $this->assertEquals(500000, $retrievedImage->size);
    }

    public function testDeleteImage()
    {
        $this->createTestImage();
        $imageRepository = new ImageRepository;

        $imageRepository->delete(1);

        $this->assertNull($this->retrieveTestImage());
    }

    public function testImageUpdateThroughEndPoint()
    {
        if(file_exists(storage_path('app/laramanager/images/tree.jpg'))) unlink(storage_path('app/laramanager/images/tree.jpg'));
        if(file_exists(storage_path('app/laramanager/images/sunflower.jpg'))) unlink(storage_path('app/laramanager/images/sunflower.jpg'));
        copy(__DIR__ . '/files/sunflower.jpg', storage_path('app/laramanager/images/sunflower.jpg'));

        $this->createTestImage();

        $this->call('PUT', 'admin/images/1', [
            'filename' => 'tree.jpg',
            'title' => 'Tree',
            'description' => 'It is a tree.',
            'original_filename' => 'image002.jpg',
            'alt' => 'A photograph of a tree'
        ]);

        $this->assertResponseOk();
        $this->seeJson([
            'filename' => 'tree.jpg',
            'title' => 'Tree',
            'description' => 'It is a tree.',
            'original_filename' => 'image002.jpg',
            'alt' => 'A photograph of a tree',
            'paths' => [
                'original' => url('images/original/tree.jpg')
            ]
        ]);
    }

    public function testDoNotOverwriteExistingFilename()
    {
        if(! file_exists(storage_path('app/laramanager/images/tree.jpg')))
        {
            copy(__DIR__ . '/files/sunflower.jpg', storage_path('app/laramanager/images/tree.jpg'));
        }

        $this->createTestImage();

        $this->call('PUT', 'admin/images/1', [
            'filename' => 'tree.jpg',
            'title' => 'Tree',
            'description' => 'It is a tree.',
            'original_filename' => 'image002.jpg',
            'alt' => 'A photograph of a tree'
        ]);

        $this->assertResponseStatus(302);
    }

    private function createTestImage()
    {
        $imageRepository = new ImageRepository;

        $imageRepository->create([
            'filename' => 'sunflower.jpg',
            'title' => 'Sunflower',
            'description' => 'It is a sunflower.',
            'original_filename' => 'image001.jpg',
            'alt' => 'A photograph of a sunflower',
            'size' => 200000
        ]);
    }

    private function retrieveTestImage()
    {
        $imageRepository = new ImageRepository;
        return $imageRepository->getById(1);
    }
}