<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use Codeception\Test\Unit;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerStoreConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new GoogleTagManagerStoreConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->dependencyProvider->provideDependencies(
                $this->containerMock
            )
        );
    }
}
