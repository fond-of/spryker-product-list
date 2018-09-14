<?php

namespace FondOfSpryker\Zed\ProductList;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class ProductListDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container
     */
    protected $container;

    /**
     * @var \FondOfSpryker\Zed\ProductList\ProductListDependencyProvider
     */
    protected $productListDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListDependencyProvider = new ProductListDependencyProvider();
        $this->container = new Container();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->productListDependencyProvider->provideBusinessLayerDependencies($this->container);

        $this->assertEquals(
            [],
            $this->container->offsetGet(ProductListDependencyProvider::PRODUCT_LIST_POST_SAVER_PLUGINS)
        );

        $this->assertEquals(
            [],
            $this->container->offsetGet(ProductListDependencyProvider::PRODUCT_LIST_PRE_DELETER_PLUGINS)
        );

        $this->assertEquals(
            [],
            $this->container->offsetGet(ProductListDependencyProvider::PRODUCT_LIST_TRANSFER_EXPANDER_PLUGINS)
        );
    }
}
