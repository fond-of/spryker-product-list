<?php

namespace FondOfSpryker\Zed\ProductList;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductList\ProductListDependencyProvider as BaseProductListDependencyProvider;

class ProductListDependencyProvider extends BaseProductListDependencyProvider
{
    public const PLUGINS_PRODUCT_LIST_TRANSFER_EXPANDER = 'PLUGINS_PRODUCT_LIST_TRANSFER_EXPANDER';
    public const PLUGINS_PRODUCT_LIST_POST_SAVER = 'PLUGINS_PRODUCT_LIST_POST_SAVER';
    public const PLUGINS_PRODUCT_LIST_PRE_DELETE = 'PLUGINS_PRODUCT_LIST_PRE_DELETE';

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
        $self = $this;

        $container[static::PLUGINS_PRODUCT_LIST_POST_SAVER] = static function () use ($self) {
            return $self->getProductListPostSaverPlugins();
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
        $self = $this;

        $container[static::PLUGINS_PRODUCT_LIST_PRE_DELETE] = static function () use ($self) {
            return $self->getProductListPreDeletePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreDeletePluginInterface[]
     */
    protected function getProductListPreDeletePlugins(): array
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
        $self = $this;

        $container[static::PLUGINS_PRODUCT_LIST_TRANSFER_EXPANDER] = static function () use ($self) {
            return $self->getProductListTransferExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListTransferExpanderPluginInterface[]
     */
    protected function getProductListTransferExpanderPlugins(): array
    {
        return [];
    }
}
