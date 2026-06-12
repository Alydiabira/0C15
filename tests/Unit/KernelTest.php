<?php

namespace App\Tests\Unit;

use App\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function testKernelBoots(): void
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();

        $this->assertInstanceOf(Kernel::class, $kernel);
        $this->assertNotEmpty($kernel->getBundles());
    }

    public function testProjectDirIsValid(): void
    {
        $kernel = new Kernel('test', true);

        $dir = $kernel->getProjectDir();

        $this->assertDirectoryExists($dir);
        $this->assertFileExists($dir . '/composer.json');
    }

    public function testCacheAndLogDirs(): void
    {
        $kernel = new Kernel('test', true);

        $cacheDir = $kernel->getCacheDir();
        $logDir = $kernel->getLogDir();

        $this->assertStringContainsString('var/cache/test', $cacheDir);
        $this->assertStringContainsString('var/log', $logDir);
    }
}
