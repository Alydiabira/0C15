<?php

namespace App\Tests\Entity;

use App\Entity\Media;
use App\Entity\User;
use App\Entity\Album;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaTest extends TestCase
{
    public function testMediaEntity(): void
    {
        $media = new Media();

        $user = new User();
        $album = new Album();

        $media->setUser($user);
        $media->setAlbum($album);
        $media->setPath('/uploads/test.jpg');
        $media->setTitle('Test image');

        $file = $this->createMock(UploadedFile::class);
        $media->setFile($file);

        $this->assertSame($user, $media->getUser());
        $this->assertSame($album, $media->getAlbum());
        $this->assertSame('/uploads/test.jpg', $media->getPath());
        $this->assertSame('Test image', $media->getTitle());
        $this->assertSame($file, $media->getFile());
    }
}
