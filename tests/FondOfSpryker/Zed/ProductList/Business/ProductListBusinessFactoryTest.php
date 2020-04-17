<?php

namespace FondOfSpryker\Zed\ProductList\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListWriter;
use FondOfSpryker\Zed\ProductList\ProductListDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductList\Dependency\Service\ProductListToUtilTextServiceBridge;
use Spryker\Zed\ProductList\Persistence\ProductListEntityManager;
use Spryker\Zed\ProductList\Persistence\ProductListRepository;

class ProductListBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductListBusinessFactory
     */
    protected $productListBusinessFactory;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\ProductList\Persistence\ProductListEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Spryker\Zed\ProductList\Persistence\ProductListRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Spryker\Zed\ProductList\Dependency\Service\ProductListToUtilTextServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListToUtilTextServiceBridgeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListBusinessFactory = new ProductListBusinessFactory();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductListEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductListRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListToUtilTextServiceBridgeMock = $this->getMockBuilder(ProductListToUtilTextServiceBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBusinessFactory->setContainer($this->containerMock);
        $this->productListBusinessFactory->setEntityManager($this->entityManagerMock);
        $this->productListBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProductListWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [
                    ProductListDependencyProvider::SERVICE_UTIL_TEXT,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_POST_SAVER,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_CREATE,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_UPDATE,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_DELETE_PRE_CHECK,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_DELETE,
                ]
            )->willReturnOnConsecutiveCalls(true, true, true, true, true, true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [
                    ProductListDependencyProvider::SERVICE_UTIL_TEXT,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_POST_SAVER,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_CREATE,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_UPDATE,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_DELETE_PRE_CHECK,
                ],
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_DELETE,
                ]
            )->willReturnOnConsecutiveCalls($this->productListToUtilTextServiceBridgeMock, [], [], [], [], []);

        $productListWriter = $this->productListBusinessFactory->createProductListWriter();

        $this->assertNotNull($productListWriter);
        $this->assertInstanceOf(ProductListWriter::class, $productListWriter);
    }

    /**
     * @return void
     */
    public function testGetProductListPostSaverCollection(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_POST_SAVER,
                ],
                [
                    ProductListDependencyProvider::SERVICE_UTIL_TEXT,
                ]
            )->willReturnOnConsecutiveCalls(true, true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [
                    ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_POST_SAVER,
                ],
                [
                    ProductListDependencyProvider::SERVICE_UTIL_TEXT,
                ]
            )->willReturnOnConsecutiveCalls([], $this->productListToUtilTextServiceBridgeMock);

        $this->assertCount(2, $this->productListBusinessFactory->getProductListPostSaverCollection());
    }

    /**
     * @return void
     */
    public function testGetProductListPostSaverPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_POST_SAVER)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_POST_SAVER)
            ->willReturn([]);

        $this->assertEquals([], $this->productListBusinessFactory->getProductListPostSaverPlugins());
    }

    /**
     * @return void
     */
    public function testGetProductListPreDeletePlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_DELETE)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_PRE_DELETE)
            ->willReturn([]);

        $this->assertEquals([], $this->productListBusinessFactory->getProductListPreDeletePlugins());
    }

    /**
     * @return void
     */
    public function testGetProductListTransferExpanderPlugins(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_TRANSFER_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ProductListDependencyProvider::PLUGINS_PRODUCT_LIST_TRANSFER_EXPANDER)
            ->willReturn([]);

        $this->assertEquals([], $this->productListBusinessFactory->getProductListTransferExpanderPlugins());
    }
}
