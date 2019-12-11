<?php

namespace FondOfSpryker\Zed\ProductList\Business;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacade as SprykerProductListFacade;

/**
 * @method \FondOfSpryker\Zed\ProductList\Business\ProductListBusinessFactory getFactory()
 */
class ProductListFacade extends SprykerProductListFacade implements ProductListFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function getAllProductLists(): ProductListCollectionTransfer
    {
        return $this->getFactory()
            ->createProductListReader()
            ->getAllProductLists();
    }
}
