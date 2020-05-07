<?php

namespace Tests\Unit;

use App\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;
    /** @test
     */
    public function has_admin_path()
    {
        $media = factory(Media::class)->create();
        $this->assertEquals('/admin/media/' . $media->slug, $media->adminPath() ); //adminPath - model
    }
}
