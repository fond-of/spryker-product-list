<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListTransferExpanderPluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListTransferExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListTransferExpanderPluginInterface[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $productListTransferExpanderPluginsMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface
     */
    protected $productListTransferExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListTransferExpanderPluginsMock = [
            $this->getMockForAbstractClass(ProductListTransferExpanderPluginInterface::class),
        ];

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferExpander = new ProductListTransferExpander(
            $this->productListTransferExpanderPluginsMock
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->productListTransferExpanderPluginsMock[0]->expects($this->atLeastOnce())
            ->method('expandTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListTransferMock);

        $actualProductList = $this->productListTransferExpander->expand($this->productListTransferMock);

        $this->assertEquals($actualProductList, $this->productListTransferMock);
    }
}
