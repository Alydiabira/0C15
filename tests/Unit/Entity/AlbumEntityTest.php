<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Album;
use App\Entity\Media;
use PHPUnit\Framework\TestCase;

class AlbumEntityTest extends TestCase
{
    public function testAlbumEntity(): void
    {
        $album = new Album();

        $album->setName('My Album');

        $this->assertSame('My Album', $album->getName());
        $this->assertSame('My Album', (string) $album);
        $this->assertNull($album->getId());

        // Relations
        $this->assertCount(0, $album->getMedia());

        $media = new Media();
        $album->addMedia($media);

        $this->assertCount(1, $album->getMedia());
        $this->assertSame($album, $media->getAlbum());

        $album->removeMedia($media);

        $this->assertCount(0, $album->getMedia());
        $this->assertNull($media->getAlbum());
    }
}
