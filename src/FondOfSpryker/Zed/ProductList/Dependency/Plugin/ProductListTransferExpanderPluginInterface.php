<?php

namespace FondOfSpryker\Zed\ProductList\Dependency\Plugin;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListTransferExpanderPluginInterface
{
    /**
     * Specification
     * - Expands the provided product list transfer object's data and returns the modified object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expandTransfer(ProductListTransfer $productListTransfer): ProductListTransfer;
}
