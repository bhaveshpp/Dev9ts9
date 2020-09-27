<?php
namespace Bhaveshpp\Dev9ts9\Observer;

use Bhaveshpp\Dev9ts9\Helper\Data;
use \Psr\Log\LoggerInterface;

class UpdateOrderCbm implements \Magento\Framework\Event\ObserverInterface
{

    protected $_helperData;

    protected $quoteFactory;

    protected $quoteRepository;
    
    protected $loggerInterface;

    public function __construct(
        LoggerInterface $loggerInterface,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        Data $helperData
    ) {
        $this->loggerInterface = $loggerInterface;
        $this->quoteFactory = $quoteFactory;
        $this->quoteRepository = $quoteRepository;
        $this->_helperData = $helperData;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $orderId = $observer->getEvent()->getOrderIds();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('\Magento\Sales\Model\Order')->load($orderId[0]);
        $quoteId = $order->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $order->setTotalCbm($quote->getTotalCbm());
        $order->save();
    }
}