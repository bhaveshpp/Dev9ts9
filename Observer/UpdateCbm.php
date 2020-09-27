<?php

namespace Bhaveshpp\Dev9ts9\Observer;

use Bhaveshpp\Dev9ts9\Helper\Data;
use \Psr\Log\LoggerInterface;

class UpdateCbm implements \Magento\Framework\Event\ObserverInterface
{
    protected $_helperData;
    
    protected $loggerInterface;

    public function __construct(
        LoggerInterface $loggerInterface,
        Data $helperData
    ) {
        $this->loggerInterface = $loggerInterface;
        $this->_helperData = $helperData;
    }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        $this->_helperData->updateCbm();
        return $this;
	}
}
