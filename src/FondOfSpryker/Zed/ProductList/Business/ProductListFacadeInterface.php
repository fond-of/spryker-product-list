<?php

namespace FondOfSpryker\Zed\ProductList\Business;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface as SprykerProductListFacadeInterface;

interface ProductListFacadeInterface extends SprykerProductListFacadeInterface
{
    /**
     * Specification:
     * - Retrieve all the product lists
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getAllProductLists(): ProductListCollectionTransfer;
}
