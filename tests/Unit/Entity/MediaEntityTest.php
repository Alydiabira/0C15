<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Media;
use App\Entity\User;
use App\Entity\Album;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaEntityTest extends TestCase
{
    public function testMediaEntity(): void
    {
        $media = new Media();

        $media->setTitle('My Photo');
        $media->setPath('uploads/photo.jpg');

        $this->assertSame('My Photo', $media->getTitle());
        $this->assertSame('My Photo', (string) $media);
        $this->assertSame('uploads/photo.jpg', $media->getPath());
        $this->assertNull($media->getId());
    }

    public function testMediaUserRelation(): void
    {
        $media = new Media();
        $user = new User();

        $media->setUser($user);

        $this->assertSame($user, $media->getUser());
    }

    public function testMediaAlbumRelation(): void
    {
        $media = new Media();
        $album = new Album();

        $media->setAlbum($album);

        $this->assertSame($album, $media->getAlbum());
    }

    public function testMediaFile(): void
    {
        $media = new Media();
        $file = $this->createMock(UploadedFile::class);

        $media->setFile($file);

        $this->assertSame($file, $media->getFile());
    }
}
