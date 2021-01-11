<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Http\Tests\Logout;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler;

/**
 * @group legacy
 */
class DefaultLogoutSuccessHandlerTest extends TestCase
{
    public function testLogout()
    {
        $request = $this->getMockBuilder(\Symfony\Component\HttpFoundation\Request::class)->getMock();
        $response = new RedirectResponse('/dashboard');

        $httpUtils = $this->getMockBuilder(\Symfony\Component\Security\Http\HttpUtils::class)->getMock();
        $httpUtils->expects($this->once())
            ->method('createRedirectResponse')
            ->with($request, '/dashboard')
            ->willReturn($response);

        $handler = new DefaultLogoutSuccessHandler($httpUtils, '/dashboard');
        $result = $handler->onLogoutSuccess($request);

        $this->assertSame($response, $result);
    }
}
