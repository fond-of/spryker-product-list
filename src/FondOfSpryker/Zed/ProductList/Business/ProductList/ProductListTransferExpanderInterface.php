<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListTransferExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expand(ProductListTransfer $productListTransfer): ProductListTransfer;
}
