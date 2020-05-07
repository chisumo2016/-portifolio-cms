<?php

namespace Tests\Feature;

use App\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    /***@test **/
    public function can_view_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class,2)->create();

        $this->get('/admin/media')
             ->assertSee($media[0]['title'])
             ->assertSee($media[1]['title']);

    }

    /*** @test **/
    public function can_view_a_single_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->create();

       $this->get($media->adminPath())
            ->assertSee($media->title);

    }

    /***@test **/
    public function can_view_create_media()
    {
        $this->withExceptionHandling();

         $this->get('/admin/media/create')
            ->assertStatus(200);
    }

    /***@test **/
    public function can_view_edit_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->create();

        $this->get($media->adminPath() . '/edit')  //$this->get('/admin/media/' . $media->slug . '/edit')
            ->assertSee($media->title);

    }

    /***@test **/
    public function can_create_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->raw(); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHas('success', 'Media Created')
            ->assertRedirect('/admin/media/' . $media['slug']);

        $this->assertDatabaseHas('media', $media);
    }

    /***@test **/
    public function can_update_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->create(); //casr into array

        $updateMedia = factory(Media::class)->raw(['slug' => $media['slug']]);
        unset($updateMedia ['slug']);

        $this->patch($media->adminPath() .'/edit', $updateMedia)
            ->assertSessionHas('success', 'Media  Updated')
            ->assertRedirect($media->adminPath());

        $this->assertDatabaseHas('media', $updateMedia);
        $this->assertDatabaseMissing('media', $media->toArray());
    }

    /***@test **/
    public function can_delete_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->create();

        $this->delete($media->adminPath() )
            ->assertSessionHas('success', 'Media  Deleted')
            ->assertRedirect('/admin/media');

        $this->assertDatabaseMissing('media', $media->toArray());

    }

    /***@test **/

    public  function  media_requires_a_title() //validation
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->raw(['title' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('title');
    }

    /***@test **/

    public  function  media_requires_a_header_img()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->raw(['header_img' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('header_img');


    }

    /***@test **/

    public  function  media_requires_a_description()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->raw(['description' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('description');
    }

    /***@test **/

    public  function  media_requires_a_status()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->raw(['status' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('status');
    }

    /***@test **/

    public  function  media_requires_a_link()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->raw(['link' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('link');
    }


}

