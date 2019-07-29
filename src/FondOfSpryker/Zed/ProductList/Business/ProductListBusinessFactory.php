<?php

namespace FondOfSpryker\Zed\ProductList\Business;

use FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListReader;
use FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpander;
use FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListWriter;
use FondOfSpryker\Zed\ProductList\ProductListDependencyProvider;
use Spryker\Zed\ProductList\Business\ProductList\ProductListReaderInterface;
use Spryker\Zed\ProductList\Business\ProductList\ProductListWriterInterface;
use Spryker\Zed\ProductList\Business\ProductListBusinessFactory as BaseProductListBusinessFactory;

/**
 * @method \Spryker\Zed\ProductList\ProductListConfig getConfig()
 * @method \Spryker\Zed\ProductList\Persistence\ProductListRepositoryInterface getRepository()
 * @method \Spryker\Zed\ProductList\Persistence\ProductListEntityManagerInterface getEntityManager()
 */
class ProductListBusinessFactory extends BaseProductListBusinessFactory
{
    /**
     * @return \Spryker\Zed\ProductList\Business\ProductList\ProductListWriterInterface
     */
    public function createProductListWriter(): ProductListWriterInterface
    {
        return new ProductListWriter(
            $this->getEntityManager(),
            $this->createProductListKeyGenerator(),
            $this->getProductListPostSaverCollection(),
            $this->getProductListPreDeleterCollection()
        );
    }

    /**
     * @return \Spryker\Zed\ProductList\Business\ProductList\ProductListReaderInterface
     */
    public function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->getRepository(),
            $this->createProductListCategoryRelationReader(),
            $this->createProductListProductConcreteRelationReader(),
            $this->getProductFacade(),
            $this->createProductListExpander()
        );
    }

    /**
     * @return array
     */
    public function getProductListPostSaverCollection(): array
    {
        return array_merge(
            parent::getProductListPostSaverCollection(),
            $this->getProductListPostSaverPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListPostSaverPluginInterface[]
     */
    public function getProductListPostSaverPlugins(): array
    {
        return $this->getProvidedDependency(ProductListDependencyProvider::PRODUCT_LIST_POST_SAVER_PLUGINS);
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListPreDeleterInterface[]
     */
    public function getProductListPreDeleterCollection(): array
    {
        return $this->getProductListPreDeleterPlugins();
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListPreDeleterPluginInterface[]
     */
    public function getProductListPreDeleterPlugins(): array
    {
        return $this->getProvidedDependency(ProductListDependencyProvider::PRODUCT_LIST_PRE_DELETER_PLUGINS);
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Business\ProductList\ProductListTransferExpanderInterface
     */
    public function createProductListExpander(): ProductListTransferExpanderInterface
    {
        return new ProductListTransferExpander(
            $this->getProductListTransferExpanderPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListTransferExpanderPluginInterface[]
     */
    public function getProductListTransferExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ProductListDependencyProvider::PRODUCT_LIST_TRANSFER_EXPANDER_PLUGINS);
    }
}
