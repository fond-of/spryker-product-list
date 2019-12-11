<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\ProductList\Business\ProductList\ProductListReaderInterface as SprykerProductListReaderInterface;

interface ProductListReaderInterface extends SprykerProductListReaderInterface
{
    /**
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getAllProductLists(): ProductListCollectionTransfer;
}
