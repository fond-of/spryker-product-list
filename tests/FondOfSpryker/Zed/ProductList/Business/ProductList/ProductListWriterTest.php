<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreDeletePluginInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use ReflectionClass;
use ReflectionException;
use Spryker\Zed\ProductList\Business\KeyGenerator\ProductListKeyGenerator;
use Spryker\Zed\ProductList\Persistence\ProductListEntityManager;

class ProductListWriterTest extends Unit
{
    /**
     * @var \Spryker\Zed\ProductList\Persistence\ProductListEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListEntityManagerMock;

    /**
     * @var \Spryker\Zed\ProductList\Business\KeyGenerator\ProductListKeyGenerator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListKeyGeneratorMock;

    /**
     * @var \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreDeletePluginInterface[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $productListPreDeletePluginMocks;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListWriter
     */
    protected $productListWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListEntityManagerMock = $this->getMockBuilder(ProductListEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListKeyGeneratorMock = $this->getMockBuilder(ProductListKeyGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListPreDeletePluginMocks = [
            $this->getMockBuilder(ProductListPreDeletePluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListWriter = new ProductListWriter(
            $this->productListEntityManagerMock,
            $this->productListKeyGeneratorMock,
            [],
            [],
            [],
            [],
            $this->productListPreDeletePluginMocks
        );
    }

    /**
     * @return void
     */
    public function testDeleteProductList(): void
    {
        $this->productListEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteProductListProductRelations')
            ->with($this->productListTransferMock);

        $this->productListEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteProductListCategoryRelations')
            ->with($this->productListTransferMock);

        $this->productListEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteProductList')
            ->with($this->productListTransferMock);

        $this->productListPreDeletePluginMocks[0]->expects($this->atLeastOnce())
            ->method('execute')
            ->with($this->productListTransferMock);

        try {
            $reflection = new ReflectionClass(get_class($this->productListWriter));

            $method = $reflection->getMethod('executeDeleteProductListTransaction');
            $method->setAccessible(true);

            $method->invokeArgs($this->productListWriter, [
                $this->productListTransferMock,
                $this->productListResponseTransferMock,
            ]);
        } catch (ReflectionException $e) {
            $this->fail($e->getMessage());
        }
    }
}
