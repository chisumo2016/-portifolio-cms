<?php

namespace Tests\Feature;

use App\Media;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use  RefreshDatabase;


    /**@test */
    public function user_can_view_tags()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $tag = factory(Tag::class,2)->create();

        $this->get('/admin/tags')
            ->assertSee($tag[0]['title'])
            ->assertSee($tag[1]['title']);
    }

    /**@test */
    public function user_can_view_single_tag()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $tag = factory(Tag::class)->create();

        $this->get($tag->adminPath())
            ->assertSee($tag->title);
    }

    /**@test */
    public function user_can_view_create_tag()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $this->get('/admin/tags/create')
            ->assertStatus(200)
            ->assertViewIs('tags.create');
    }

    /**@test */
    public function user_can_view_edit_tag()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $tag = factory(Tag::class)->create();

        $this->get($tag->adminPath() . '/edit')  //$this->get('/admin/media/' . $media->slug . '/edit')
        ->assertSee($tag->title);

    }

    /**@test */
    public function user_can_create_a_tag()
    {
        //$user = factory(User::class)->create(); $this->$this->actingAs($user);
        $this->withExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $tag = factory(Tag::class)->raw();

        $this->post('/admin/tags', $tag)
                ->assertSessionHas('success', 'Tag Created')
                ->assertRedirect('/admin/tags/' . $tag['slug']);

                $this->assertDatabaseHas('tags', $tag);
    }

    /**@test */
    public function user_can_update_a_tag()
    {
        $this->withExceptionHandling();


        $this->$this->actingAs( $user = factory(User::class)->create());

        $tag = factory(Tag::class)->raw(); //casr into array

        $updateTag = factory(Tag::class)->raw(); //cast into array

        unset($updateTag ['slug']);

        $this->patch($tag->adminPath(), $updateTag)
            ->assertSessionHas('success', 'Tag  Updated')
            ->assertRedirect($tag->adminPath());

        $this->assertDatabaseHas('tags',   $updateTag);
        $this->assertDatabaseMissing('tags', $tag->toArray());
    }

    /**@test */
    public function user_can_delete_a_tag()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $tag = factory(Media::class)->create();

        $this->delete($tag->adminPath() )
            ->assertSessionHas('success', 'Tag  Deleted')
            ->assertRedirect('/admin/tags');

        $this->assertDatabaseMissing('tags', $tag->toArray());
    }

    /**@test */
    public function visitor_cannot_crud_tag()
    {
        $this->withExceptionHandling();

        $tag = factory(Media::class)->create();

        //Read all media
        $this->get('/admin/tags')->assertStatus(302)
            ->assertRedirect('/admin');

        //Read Single tag
        $this->get($tag->adminPath())
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //View media create tag
        $this->get('/admin/tags/create')
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //View media edit tag
        $this->patch($tag->adminPath() .'/edit')
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Create tag
        $this->post('/admin/tags', $tag->toArray())
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Update tag
        $updateTag = factory(Tag::class)->raw();
        unset($updateTag ['slug']);

        $this->patch($tag->adminPath(), $updateTag)
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Delete tag
        $this->delete($tag->adminPath() )
            ->assertStatus(302)
            ->assertRedirect('/admin');

    }

    /**@test */
    public function tag_requires_a_title()
    {
        $this->withExceptionHandling();

        //$this->$this->actingAs(factory(User::class)->create());
        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $tag = factory(Tag::class)->raw([   //casr into array
            'title'           =>   null
        ]);

        $this->post('/admin/tags', $tag)
            ->assertSessionHasErrors('title');
    }

    /**@test */
    public function tag_requires_a_status()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $tag = factory(Tag::class)->raw([   //casr into array
            'status'           =>   null
        ]);

        $this->post('/admin/tags', $tag)
            ->assertSessionHasErrors('status');
    }














}
