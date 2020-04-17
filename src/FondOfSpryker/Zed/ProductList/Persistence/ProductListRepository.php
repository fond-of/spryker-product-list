<?php

namespace FondOfSpryker\Zed\ProductList\Persistence;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Persistence\ProductListRepository as SprykerProductListRepository;

/**
 * @method \Spryker\Zed\ProductList\Persistence\ProductListPersistenceFactory getFactory()
 */
class ProductListRepository extends SprykerProductListRepository implements ProductListRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getAllProductLists(): ProductListCollectionTransfer
    {
        $productListCollectionTransfer = new ProductListCollectionTransfer();
        $query = $this->getFactory()
            ->createProductListQuery();

        $spyProductListEntities = $this->buildQueryFromCriteria($query)->find();

        foreach ($spyProductListEntities as $spyProductListEntityTransfer) {
            $productListTransfer = $this->getFactory()
                ->createProductListMapper()
                ->mapEntityTransferToProductListTransfer($spyProductListEntityTransfer, new ProductListTransfer());

            $productListCollectionTransfer->addProductList($productListTransfer);
        }

        return $productListCollectionTransfer;
    }
}
