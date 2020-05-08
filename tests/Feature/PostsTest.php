<?php

namespace Tests\Feature;

use App\Media;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use  RefreshDatabase;


    /**@test */
    public function user_can_view_posts()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $post = factory(Post::class,2)->create();

        $this->get('/admin/media')
            ->assertSee($post[0]['title'])
            ->assertSee($post[1]['title']);
    }

    /**@test */
    public function user_can_view_single_post()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $post = factory(Post::class)->create();

        $this->get($post->adminPath())
            ->assertSee($post->title);
    }

    /**@test */
    public function user_can_view_create_post()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $this->get('/admin/posts/create')
            ->assertStatus(200);
    }

    /**@test */
    public function user_can_view_edit_post()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $post = factory(Post::class)->create();

        $this->get($post->adminPath() . '/edit')  //$this->get('/admin/media/' . $media->slug . '/edit')
            ->assertSee($post->title);

    }

    /**@test */
    public function user_can_create_a_post()
    {
        $this->withExceptionHandling();

        //$this->actingAs(factory(User::class)->create());

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null
        ]);

        $this->post('/admin/posts', $post)
            ->assertSessionHas('success', 'Post Created')
            ->assertRedirect('/admin/posts/' . $post['slug']);

        $this->assertDatabaseHas('posts', $post);
    }

    /**@test */
    public function user_can_update_a_post()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null
        ]); //casr into array

        $updatePost = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null
        ]); //cast into array

            unset($updatePost ['slug']);

            $this->patch($post->adminPath(), $updatePost)
                ->assertSessionHas('success', 'Post  Updated')
                ->assertRedirect($post->adminPath());

        $this->assertDatabaseHas('posts',   $updatePost);
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /**@test */
    public function user_can_delete_a_post()
    {
        $this->withExceptionHandling();

        $this->$this->actingAs(factory(User::class)->create());

        $post = factory(Media::class)->create();

        $this->delete($post->adminPath() )
            ->assertSessionHas('success', 'Post  Deleted')
            ->assertRedirect('/admin/posts');

        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /**@test */
    public function visitor_cannot_crud_post()
    {
        $this->withExceptionHandling();

        $post = factory(Media::class)->create();

        //Read all media
        $this->get('/admin/posts')->assertStatus(301)
            ->assertRedirect('/admin');

        //Read Single post
        $this->get($post->adminPath())
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //View media create post
        $this->get('/admin/posts/create')
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //View media edit post
        $this->patch($post->adminPath() .'/edit')
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Create post
        $this->post('/admin/posts', $post->toArray())
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Update post
        $updatePost = factory(Post::class)->raw();
        unset($updatePost ['slug']);

        $this->patch($post->adminPath(), $updatePost)
            ->assertStatus(302)
            ->assertRedirect('/admin');

        //Delete post
        $this->delete($post->adminPath() )
            ->assertStatus(302)
            ->assertRedirect('/admin');

    }

    /**@test */
    public function post_requires_a_title()
    {
        $this->withExceptionHandling();

        //$this->$this->actingAs(factory(User::class)->create());
        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null,
            'title'           =>   null
        ]);

        //$post = factory(Post::class)->raw(['title' => '']); //casr into array

        $this->post('/admin/posts', $post)
            ->assertSessionHasErrors('title');
    }

    /**@test */
    public function post_requires_a_header_img()
    {
        $this->withExceptionHandling();

        //$this->$this->actingAs(factory(User::class)->create());

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null,
            'content'         =>   null
        ]);


        $this->post('/admin/posts', $post)
            ->assertSessionHasErrors('content');
    }

    /**@test */
    public function post_requires_a_content()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null,
            'content'         =>   null
        ]);

        //$post = factory(Post::class)->raw(['content' => '']); //casr into array

        $this->post('/admin/posts', $post)
            ->assertSessionHasErrors('content');
    }

    /**@test */
    public function post_requires_a_description()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'          =>  $user->id,
            'published_on'       =>   null,
            'description'         =>   null
        ]);

        $post = factory(Post::class)->raw(['description' => '']); //casr into array

        $this->post('/admin/posts', $post)
            ->assertSessionHasErrors('description');
    }

    /**@test */
    public function post_requires_a_publish_at()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null,
            'status'           =>   null
        ]);

        $this->post('/admin/posts', $post)
            ->assertSessionHasErrors('status');
    }

    /**@test */
    public function post_requires_a_status()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->$this->actingAs($user);

        $post = factory(Post::class)->raw([
            'author_id'       =>  $user->id,
            'published_on'    =>   null,
            'status'           =>   null
        ]);

        $post = factory(Post::class)->raw(['status' => '']); //casr into array

        $this->post('/admin/posts', $post)
            ->assertSessionHasErrors('status');
    }













    }
