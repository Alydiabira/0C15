<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Album;
use PHPUnit\Framework\TestCase;

class AlbumEntityTest extends TestCase
{
    public function testAlbumEntity(): void
    {
        $album = new Album();

        $album->setName('My Album');

        $this->assertSame('My Album', $album->getName());
        $this->assertNull($album->getId());
    }
}
