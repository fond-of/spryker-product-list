<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Fond\Zed\Store\Persistence\ProductListQueryContainerInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductList\ProductListReader as BaseProductListReader;
use Spryker\Zed\ProductList\Business\ProductListCategoryRelation\ProductListCategoryRelationReaderInterface;
use Spryker\Zed\ProductList\Business\ProductListProductConcreteRelation\ProductListProductConcreteRelationReaderInterface;
use Spryker\Zed\ProductList\Dependency\Facade\ProductListToProductFacadeInterface;
use FondOfSpryker\Zed\ProductList\Persistence\ProductListRepositoryInterface;

class ProductListReader extends BaseProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface
     */
    protected $productListTransferExpander;


    /**
     * ProductListReader constructor.
     *
     * @param \FondOfSpryker\Zed\ProductList\Persistence\ProductListRepositoryInterface $productListRepository
     * @param \Spryker\Zed\ProductList\Business\ProductListCategoryRelation\ProductListCategoryRelationReaderInterface $productListCategoryRelationReader
     * @param \Spryker\Zed\ProductList\Business\ProductListProductConcreteRelation\ProductListProductConcreteRelationReaderInterface $productListProductConcreteRelationReader
     * @param \Spryker\Zed\ProductList\Dependency\Facade\ProductListToProductFacadeInterface $productFacade
     * @param \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface $productListTransferExpander
     */
    public function __construct(
        ProductListRepositoryInterface $productListRepository,
        ProductListCategoryRelationReaderInterface $productListCategoryRelationReader,
        ProductListProductConcreteRelationReaderInterface $productListProductConcreteRelationReader,
        ProductListToProductFacadeInterface $productFacade,
        ProductListTransferExpanderInterface $productListTransferExpander
    ) {
        parent::__construct(
            $productListRepository,
            $productListCategoryRelationReader,
            $productListProductConcreteRelationReader,
            $productFacade
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

    /**
     * @inheritDoc
     */
    public function getAllProductLists(): ProductListCollectionTransfer
    {
        $productListCollectionTransfer = $this->productListRepository->getAllProductLists();

        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            $this->productListTransferExpander->expand($productListTransfer);
        }

        return $productListCollectionTransfer;
    }
}
