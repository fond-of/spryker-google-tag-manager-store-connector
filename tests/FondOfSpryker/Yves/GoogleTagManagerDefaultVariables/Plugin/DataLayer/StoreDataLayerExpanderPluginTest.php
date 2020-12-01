<?php

namespace FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\DataLayer;

use Codeception\Test\Unit;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Expander\StoreDataLayerExpanderInterface;
use FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory;

class StoreDataLayerExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\GoogleTagManagerStoreConnectorFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Model\StoreDataLayerExpanderInterface
     */
    protected $storeDataLayerExpanderMock;

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManagerStoreConnector\Plugin\DataLayer\StoreDataLayerExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(GoogleTagManagerStoreConnectorFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeDataLayerExpanderMock = $this->getMockBuilder(StoreDataLayerExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new StoreDataLayerExpanderPlugin();
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->assertIsBool($this->plugin->isApplicable('pageType', []));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createStoreDataLayerExpander')
            ->willReturn($this->storeDataLayerExpanderMock);

        $this->storeDataLayerExpanderMock->expects($this->once())
            ->method('expand');

        $this->assertIsArray($this->plugin->expand('pageType', [], []));
    }
}
