<?php

namespace Tests\Feature;

use App\Media;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    /***@test **/
    public function user_can_view_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class,2)->create();

        $this->get('/admin/media')
             ->assertSee($media[0]['title'])
             ->assertSee($media[1]['title']);

    }

    /*** @test **/
    public function user_can_view_a_single_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->create();

       $this->get($media->adminPath())
            ->assertSee($media->title);

    }

    /***@test **/
    public function user_can_view_create_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

         $this->get('/admin/media/create')
            ->assertStatus(200);
    }

    /***@test **/
    public function user_can_view_edit_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->create();

        $this->get($media->adminPath() . '/edit')  //$this->get('/admin/media/' . $media->slug . '/edit')
              ->assertSee($media->title);

    }

    /***@test **/
    public function user_can_create_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->raw(); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHas('success', 'Media Created')
            ->assertRedirect('/admin/media/' . $media['slug']);

        $this->assertDatabaseHas('media', $media);
    }

    /***@test **/
    public function user_can_update_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

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
    public function user_can_delete_media()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

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

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->raw(['title' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('title');
    }

    /***@test **/

    public  function  media_requires_a_header_img()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->raw(['header_img' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('header_img');

    }

    /***@test **/

    public  function  media_requires_a_description()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->raw(['description' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('description');
    }

    /***@test **/

    public  function  media_requires_a_status()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->raw(['status' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('status');
    }

    /***@test **/

    public  function  media_requires_a_link()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $media = factory(Media::class)->raw(['link' => '']); //casr into array

        $this->post('/admin/media/create', $media)
            ->assertSessionHasErrors('link');
    }

    /***@test **/

    public  function  visitor_cannot_crud_media()
    {
        $this->withExceptionHandling();

        $media = factory(Media::class)->create();

        //Read all media
        $this->get('/admin/media')->assertStatus(301)
            ->assertRedirect('/admin');

        //Read Single media
        $this->get($media->adminPath())
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //View media create media
        $this->get('/admin/media/create')
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //View media edit media
        $this->patch($media->adminPath() .'/edit')
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Create Media
        $this->post('/admin/media/create', $media->toArray())
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Update Media
        $updateMedia = factory(Media::class)->raw(['slug' => $media['slug']]);
        unset($updateMedia ['slug']);

        $this->patch($media->adminPath() .'/edit', $updateMedia)
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Delete Media
          $this->delete($media->adminPath() )
              ->assertStatus(302)
              ->assertRedirect('/admin');
    }



}

