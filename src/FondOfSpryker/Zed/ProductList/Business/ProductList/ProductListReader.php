<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductList\ProductListReader as BaseProductListReader;
use Spryker\Zed\ProductList\Business\ProductListCategoryRelation\ProductListCategoryRelationReaderInterface;
use Spryker\Zed\ProductList\Business\ProductListProductConcreteRelation\ProductListProductConcreteRelationReaderInterface;
use Spryker\Zed\ProductList\Persistence\ProductListRepositoryInterface;

class ProductListReader extends BaseProductListReader
{
    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface
     */
    protected $productListTransferExpander;

    /**
     * @param \Spryker\Zed\ProductList\Persistence\ProductListRepositoryInterface $productListRepository
     * @param \Spryker\Zed\ProductList\Business\ProductListCategoryRelation\ProductListCategoryRelationReaderInterface $productListCategoryRelationReader
     * @param \Spryker\Zed\ProductList\Business\ProductListProductConcreteRelation\ProductListProductConcreteRelationReaderInterface $productListProductConcreteRelationReader
     * @param \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface $productListTransferExpander
     */
    public function __construct(
        ProductListRepositoryInterface $productListRepository,
        ProductListCategoryRelationReaderInterface $productListCategoryRelationReader,
        ProductListProductConcreteRelationReaderInterface $productListProductConcreteRelationReader,
        ProductListTransferExpanderInterface $productListTransferExpander
    ) {
        parent::__construct(
            $productListRepository,
            $productListCategoryRelationReader,
            $productListProductConcreteRelationReader
        );

        $this->productListTransferExpander = $productListTransferExpander;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function getProductListById(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        $productListTransfer = parent::getProductListById($productListTransfer);

        $productListTransfer = $this->productListTransferExpander->expand($productListTransfer);

        return $productListTransfer;
    }
}
