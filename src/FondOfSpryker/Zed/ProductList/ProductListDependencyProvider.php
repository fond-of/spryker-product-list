<?php

namespace FondOfSpryker\Zed\ProductList;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductList\ProductListDependencyProvider as BaseProductListDependencyProvider;

class ProductListDependencyProvider extends BaseProductListDependencyProvider
{
    const PRODUCT_LIST_TRANSFER_EXPANDER_PLUGINS = 'PRODUCT_LIST_TRANSFER_EXPANDER_PLUGINS';
    const PRODUCT_LIST_POST_SAVER_PLUGINS = 'PRODUCT_LIST_POST_SAVER_PLUGINS';
    const PRODUCT_LIST_PRE_DELETER_PLUGINS = 'PRODUCT_LIST_PRE_DELETER_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductListPostSaverPlugins($container);
        $container = $this->addProductListPreDeleterPlugins($container);
        $container = $this->addProductListTransferExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductListPostSaverPlugins(Container $container): Container
    {
        $container[static::PRODUCT_LIST_POST_SAVER_PLUGINS] = function (Container $container) {
            return $this->getProductListPostSaverPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListPostSaverPluginInterface[]
     */
    protected function getProductListPostSaverPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductListPreDeleterPlugins(Container $container): Container
    {
        $container[static::PRODUCT_LIST_PRE_DELETER_PLUGINS] = function (Container $container) {
            return $this->getProductListPreDeleterPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListPreDeleterPluginInterface[]
     */
    protected function getProductListPreDeleterPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addProductListTransferExpanderPlugins(Container $container): Container
    {
        $container[static::PRODUCT_LIST_TRANSFER_EXPANDER_PLUGINS] = function (Container $container) {
            return $this->getProductListTransferExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListTransferExpanderPluginInterface[]
     */
    protected function getProductListTransferExpanderPlugins(): array
    {
        return [];
    }
}
