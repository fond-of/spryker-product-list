<?php

namespace FondOfSpryker\Zed\ProductList\Persistence;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\ProductList\Persistence\ProductListRepositoryInterface as SprykerProductListRepositoryInterface;

interface ProductListRepositoryInterface extends SprykerProductListRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getAllProductLists(): ProductListCollectionTransfer;
}
