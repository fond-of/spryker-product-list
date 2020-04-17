<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListTransfer;

class ProductListTransferExpander implements ProductListTransferExpanderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListTransferExpanderPluginInterface[]
     */
    protected $productListTransferExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListTransferExpanderPluginInterface[] $productListTransferExpanderPlugins
     */
    public function __construct(array $productListTransferExpanderPlugins)
    {
        $this->productListTransferExpanderPlugins = $productListTransferExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expand(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        foreach ($this->productListTransferExpanderPlugins as $productListTransferExpanderPlugin) {
            $productListTransfer = $productListTransferExpanderPlugin->expandTransfer($productListTransfer);
        }

        return $productListTransfer;
    }
}
