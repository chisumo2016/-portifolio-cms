<?php

namespace Tests\Unit;

use App\Media;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class MediaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_admin_path()
    {
        $media = factory(Media::class)->create();
        $this->assertEquals('/admin/media/' . $media->slug, $media->adminPath() ); //adminPath - model
    }
}
