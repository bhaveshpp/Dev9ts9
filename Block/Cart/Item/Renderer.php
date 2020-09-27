<?php
namespace Bhaveshpp\Dev9ts9\Block\Cart\Item;

class Renderer extends \Magento\Checkout\Block\Cart\Item\Renderer
{

    protected $_productRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Helper\Product\Configuration $productConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Framework\View\Element\Message\InterpretationStrategyInterface $messageInterpretationStrategy,
        \Magento\Catalog\Model\ProductRepository $productRepository
    ) {
        parent::__construct(
            $context,
            $productConfig,
            $checkoutSession,
            $imageBuilder,
            $urlHelper,
            $messageManager,
            $priceCurrency,
            $moduleManager,
            $messageInterpretationStrategy
        );
        $this->_productRepository = $productRepository;
    }

    public function getCbm($sku)
    {
        $product = $this->getProductBySku($sku);
        return $this->getQty()*($product->getHeight()*$product->getWidth()*$product->getLength());
    }

    public function getProductBySku($sku)
	{
		return $this->_productRepository->get($sku);
	}
}
