<?php

namespace Bhaveshpp\Dev9ts9\Helper;
use Magento\Company\Api\CompanyManagementInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $loggerInterface;

    protected $checkoutSession;

    protected $productRepository;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Model\ProductRepository $productRepository
    ) {
        parent::__construct($context);
        $this->loggerInterface = $loggerInterface;
        $this->checkoutSession = $checkoutSession;
        $this->productRepository = $productRepository;
    }

    /**
     * after product add to cart add item cbm in quote and update quote total
     */

    public function updateCbm()
    {
        $quote = $this->checkoutSession->getQuote();
        $allItems = $this->checkoutSession->getQuote()->getAllItems();
        $totalCbm = 0;
        foreach ($allItems as $item) {
            
            $item = $quote->getItemById($item->getId());
            if (!$item) {
                continue;
            }
            $cbm = $this->getCbm($item->getSku()) * $item->getQty();
            $item->setCbm($cbm);
            // $item->save();
            $totalCbm += $cbm;
            $this->loggerInterface->info($cbm);
        }
        $quote->setTotalCbm($totalCbm);
        $quote->save();
    }

    public function getCbm($sku)
    {
        $product = $this->getProductBySku($sku);
        return ($product->getHeight()*$product->getWidth()*$product->getLength());
    }

    public function getProductBySku($sku)
	{
		return $this->productRepository->get($sku);
	}
            
}
