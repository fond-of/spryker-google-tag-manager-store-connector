<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\StoreDataLayerExpanderInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerStoreConnectorFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorConfig
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Store
     */
    protected $storeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GoogleTagManagerStoreConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeMock = $this->getMockBuilder(Store::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GoogleTagManagerStoreConnectorFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateStoreDataLayerExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturn($this->storeMock);

        $this->assertInstanceOf(
            StoreDataLayerExpanderInterface::class,
            $this->factory->createStoreDataLayerExpander()
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
            ->willReturn($this->storeMock);

        $this->assertInstanceOf(
            Store::class,
            $this->factory->getStore()
        );
    }
}
