<?php

namespace App\Tests\Unit\Security;

use App\Security\AccessDeniedHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccessDeniedHandlerTest extends TestCase
{
    public function testHandleReturns403(): void
    {
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);

        $handler = new AccessDeniedHandler($urlGenerator);

        $request = new Request();
        $exception = new AccessDeniedException('Access denied');

        $response = $handler->handle($request, $exception);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(403, $response->getStatusCode());
    }
}
