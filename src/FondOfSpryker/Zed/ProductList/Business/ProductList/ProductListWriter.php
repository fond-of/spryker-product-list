<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\KeyGenerator\ProductListKeyGeneratorInterface;
use Spryker\Zed\ProductList\Business\ProductList\ProductListWriter as BaseProductListWriter;
use Spryker\Zed\ProductList\Persistence\ProductListEntityManagerInterface;

class ProductListWriter extends BaseProductListWriter
{
    /**
     * @var \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreDeletePluginInterface[]
     */
    protected $productListPreDeletePlugins;

    /**
     * @param \Spryker\Zed\ProductList\Persistence\ProductListEntityManagerInterface $productListEntityManager
     * @param \Spryker\Zed\ProductList\Business\KeyGenerator\ProductListKeyGeneratorInterface $productListKeyGenerator
     * @param \Spryker\Zed\ProductList\Business\ProductList\ProductListPostSaverInterface[] $productListPostSavers
     * @param \Spryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreCreatePluginInterface[] $productListPreCreatePlugins
     * @param \Spryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreUpdatePluginInterface[] $productListPreUpdatePlugins
     * @param \Spryker\Zed\ProductListExtension\Dependency\Plugin\ProductListDeletePreCheckPluginInterface[] $productListDeletePreCheckPlugins
     * @param \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreDeletePluginInterface[] $productListPreDeletePlugins
     */
    public function __construct(
        ProductListEntityManagerInterface $productListEntityManager,
        ProductListKeyGeneratorInterface $productListKeyGenerator,
        array $productListPostSavers = [],
        array $productListPreCreatePlugins = [],
        array $productListPreUpdatePlugins = [],
        array $productListDeletePreCheckPlugins = [],
        array $productListPreDeletePlugins = []
    ) {
        parent::__construct(
            $productListEntityManager,
            $productListKeyGenerator,
            $productListPostSavers,
            $productListPreCreatePlugins,
            $productListPreUpdatePlugins,
            $productListDeletePreCheckPlugins
        );

        $this->productListPreDeletePlugins = $productListPreDeletePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @param \Generated\Shared\Transfer\ProductListResponseTransfer $productListResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    protected function executeDeleteProductListTransaction(
        ProductListTransfer $productListTransfer,
        ProductListResponseTransfer $productListResponseTransfer
    ): ProductListResponseTransfer {
        foreach ($this->productListPreDeletePlugins as $productListPreDeletePlugin) {
            $productListPreDeletePlugin->execute($productListTransfer);
        }

        return parent::executeDeleteProductListTransaction($productListTransfer, $productListResponseTransfer);
    }
}
