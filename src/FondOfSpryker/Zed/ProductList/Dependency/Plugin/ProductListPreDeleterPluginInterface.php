<?php

namespace FondOfSpryker\Zed\ProductList\Dependency\Plugin;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListPreDeleterPluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before product list object is deleted.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return void
     */
    public function preDelete(ProductListTransfer $productListTransfer): void;
}
