<?php

namespace Tests\Unit;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_admin_path()
    {
        $tag = factory(Tag::class)->create();
        $this->assertEquals('/admin/tags/' . $tag->slug, $tag->adminPath()); //adminPath - model
    }

}
