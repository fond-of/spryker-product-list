<?php

namespace FondOfSpryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\KeyGenerator\ProductListKeyGeneratorInterface;
use Spryker\Zed\ProductList\Business\ProductList\ProductListWriter as BaseProductListWriter;
use Spryker\Zed\ProductList\Persistence\ProductListEntityManagerInterface;

class ProductListWriter extends BaseProductListWriter
{
    /**
     * @var array|\FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListPreDeleterInterface[]
     */
    protected $productListPreDeleters;

    /**
     * @param \Spryker\Zed\ProductList\Persistence\ProductListEntityManagerInterface $productListEntityManager
     * @param \Spryker\Zed\ProductList\Business\KeyGenerator\ProductListKeyGeneratorInterface $productListKeyGenerator
     * @param \Spryker\Zed\ProductList\Business\ProductList\ProductListPostSaverInterface[] $productListPostSavers
     * @param \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListPreDeleterInterface[] $productListPreDeleters
     */
    public function __construct(
        ProductListEntityManagerInterface $productListEntityManager,
        ProductListKeyGeneratorInterface $productListKeyGenerator,
        array $productListPostSavers = [],
        array $productListPreDeleters = []
    ) {
        parent::__construct(
            $productListEntityManager,
            $productListKeyGenerator,
            $productListPostSavers
        );

        $this->productListPreDeleters = $productListPreDeleters;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return void
     */
    protected function executeDeleteProductListTransaction(
        ProductListTransfer $productListTransfer
    ): void {
        foreach ($this->productListPreDeleters as $productListPreDeleters) {
            $productListPreDeleters->preDelete($productListTransfer);
        }

        parent::executeDeleteProductListTransaction($productListTransfer);
    }
}
