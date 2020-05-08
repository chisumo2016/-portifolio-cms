<?php

namespace Tests\Unit;

use App\Media;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_admin_path()
    {
        $post = factory(Post::class)->create();
        $this->assertEquals('/admin/posts/' . $post->slug, $post->adminPath() ); //adminPath - model
    }
}
