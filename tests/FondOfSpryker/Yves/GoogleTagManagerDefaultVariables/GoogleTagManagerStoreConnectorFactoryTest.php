<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\GoogleTagManagerStoreConnectorModelInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerStoreConnectorFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Store
     */
    protected $storeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Dependency\GoogleTagManagerStoreConnectorToCartClientInterface;
     */
    protected $googleTagManagerStoreConnectorToCartClientBridgeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeMock = $this->getMockBuilder(Store::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->googleTagManagerStoreConnectorToCartClientBridgeMock = $this
            ->getMockBuilder(GoogleTagManagerStoreConnectorToCartClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GoogleTagManagerStoreConnectorFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateGoogleTagManagerStoreConnectorModel(): void
    {
        $this->assertInstanceOf(
            GoogleTagManagerStoreConnectorModelInterface::class,
            $this->factory->createGoogleTagManagerStoreConnectorModel()
        );
    }

    /**
     * @return void
     */
    public function testGetStore(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(GoogleTagManagerStoreConnectorDependencyProvider::STORE)
            ->willReturn($this->storeMock);

        $this->assertInstanceOf(
            Store::class,
            $this->factory->getStore()
        );
    }

    /**
     * @return void
     */
    public function testGetCartClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(GoogleTagManagerStoreConnectorDependencyProvider::CART_CLIENT)
            ->willReturn($this->googleTagManagerStoreConnectorToCartClientBridgeMock);

        $this->assertInstanceOf(
            GoogleTagManagerStoreConnectorToCartClientInterface::class,
            $this->factory->getCartClient()
        );
    }
}
