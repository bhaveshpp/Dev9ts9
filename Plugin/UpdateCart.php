<?php

namespace Bhaveshpp\Dev9ts9\Plugin;

use \Psr\Log\LoggerInterface;
use Bhaveshpp\Dev9ts9\Helper\Data;

class UpdateCart
{
    /**
     * @var Data|Data
     */
    protected $_helperData;

    /**
     * LoggerInterface
     *
     * @var Psr\Log\LoggerInterface
     */
    protected $loggerInterface;

    public function __construct(
        Data $helperData,
        LoggerInterface $loggerInterface
    ) {
        $this->_helperData = $helperData;
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * @param \Magento\Checkout\Model\Cart $subject
     * @param $data
     * @return array
     */
    public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []
    ) {
        /** @var $orderItem Item */
        $orderItem = $proceed($item, $additional);
        $orderItem->setCbm($item->getCbm());
        return $orderItem;
    }

}
