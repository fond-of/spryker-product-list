<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Codeception\Test\Unit;
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
     * @var array
     */
    protected $productListPostSaveCollectionMock;

    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListPreDeleterInterface[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $productListPreDeleterCollectionMock;

    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListWriter
     */
    protected $productListWriter;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

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

        $this->productListPostSaveCollectionMock = [];

        $this->productListPreDeleterCollectionMock = [
            $this->getMockForAbstractClass(ProductListPreDeleterInterface::class),
        ];

        $this->productListTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ProductListTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListWriter = new ProductListWriter(
            $this->productListEntityManagerMock,
            $this->productListKeyGeneratorMock,
            $this->productListPostSaveCollectionMock,
            $this->productListPreDeleterCollectionMock
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

        $this->productListPreDeleterCollectionMock[0]->expects($this->atLeastOnce())
            ->method('preDelete')
            ->with($this->productListTransferMock);

        try {
            $reflection = new ReflectionClass(\get_class($this->productListWriter));

            $method = $reflection->getMethod('executeDeleteProductListTransaction');
            $method->setAccessible(true);

            $method->invokeArgs($this->productListWriter, [$this->productListTransferMock]);
        } catch (ReflectionException $e) {
            $this->fail($e->getMessage());
        }
    }
}
