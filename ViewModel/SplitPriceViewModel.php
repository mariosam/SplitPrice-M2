<?php
/**
 * Class SplitPriceViewModel
 * 
 * @author      MarioSAM <eu@mariosam.com.br>
 * @version     1.0.0
 * @date        2020/11
 * @copyright   Blog do Mario SAM
 * 
 * This class collect the data to show them in frontend.
 */
namespace MarioSAM\SplitPrice\ViewModel;

class SplitPriceViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $_scopeConfig;
    protected $_registry;
    
    /**
     * SplitPriceViewModel constructor.
     *
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_registry = $registry;

        //parent::__construct($context);
    }

    /**
     * Check if this module is active or not.
     * 
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_config/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get the price value of Product page detail
     *   
     * @return double
     */
    public function getProductPrice()
    {
        $currentProduct = $this->_registry->registry('current_product');
        
        //qual preco retornar? o base ou o special???
        //o ideal seria usar constante nativa, mas nao encontrei.
        if ('configurable' == $currentProduct->getTypeId()) {
            return $currentProduct->getPriceInfo()->getPrice('regular_price')->getMinRegularAmount()->getValue();
        }

        if ('bundle' == $currentProduct->getTypeId()) {
            return $currentProduct->getPriceInfo()->getPrice('regular_price')->getMinimalPrice()->getValue();
        }

        if ('grouped' == $currentProduct->getTypeId()) {
            $regularPrice = 0;
            $usedProds = $currentProduct->getTypeInstance(true)->getAssociatedProducts($currentProduct);            
            foreach ($usedProds as $child) {
                if ($child->getId() != $currentProduct->getId()) {
                    $regularPrice += $child->getPrice();
                }
            }
            return $regularPrice;
        }

        return $currentProduct->getFinalPrice();
    }
    
    //nao ta sendo usado, foi lido a pagina usando jquery
    public function getCartPrice()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        return $cart->getQuote()->getGrandTotal();
    }
    
    //nao ta sendo usado, foi lido a pagina usando jquery
    public function getListPrice()
    {
        return 0;
    }

    /**
     * Get the maximum numbers of splits
     * 
     * @return int
     */
    public function getProductPriceX()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_config/maximum_splits', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * If to show all splits values
     * 
     * @return boolean
     */
    public function getProductPriceAll()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_config/show_all', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get the tax value if exist
     * 
     * @return int
     */
    public function getProductPriceTax()
    {
        $_tax = $this->_scopeConfig->getValue('splitprice/split_price_config/add_tax', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
        if (!ctype_digit($_tax))
        {
            $_tax = 0;
        }
        
        return $_tax;
    }
    
    /**
     * What kind of price need to be calculate
     * 
     * @return text
     */
    public function getProductPriceType()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_config/base_price', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Show the split prices in catalog list pages
     * 
     * @return boolean
     */
    public function getShowInCatalog()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/show_catalog', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * CSS place to insert the message in catalog list pages 
     * 
     * @return text
     */
    public function getCatalogPosition()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/show_catalog_position', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Show the split prices in product detail page
     * 
     * @return boolean
     */
    public function getShowInProduct()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/show_product', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * CSS place to insert the message in product detail page
     * 
     * @return text
     */
    public function getProductPosition()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/show_product_position', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Show the split prices in shopping cart page
     * 
     * @return boolean
     */
    public function getShowInCart()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/show_cart', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * CSS place to insert the message in shopping cart page
     * 
     * @return text
     */
    public function getCartPosition()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/show_cart_position', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get custom css code to improve frontend catalog list.
     * 
     * @return textarea
     */
    public function getCssCustomCatalog()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/css_catalog', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get custom javascript code to improve frontend catalog list.
     * 
     * @return textarea
     */
    public function getJsCustomCatalog()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/js_catalog', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get custom css code to improve frontend product page.
     * 
     * @return textarea
     */
    public function getCssCustomProduct()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/css_product', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get custom javascript code to improve frontend product page.
     * 
     * @return textarea
     */
    public function getJsCustomProduct()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/js_product', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get custom css code to improve frontend shopping cart.
     * 
     * @return textarea
     */
    public function getCssCustomCart()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/css_cart', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    /**
     * Get custom javascript code to improve frontend shopping cart.
     * 
     * @return textarea
     */
    public function getJsCustomCart()
    {
        return $this->_scopeConfig->getValue('splitprice/split_price_presentation/js_cart', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
