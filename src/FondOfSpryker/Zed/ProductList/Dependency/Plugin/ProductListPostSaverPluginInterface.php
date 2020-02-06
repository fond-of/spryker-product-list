<?php

namespace FondOfSpryker\Zed\ProductList\Dependency\Plugin;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListPostSaverPluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after product list object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function postSave(ProductListTransfer $productListTransfer): ProductListTransfer;
}
