<?php
/**
 * Cinovic Technologies LLP.
 *
 * @category  Cinovic
 * @package   Cinovic_Whatsapp
 * @author    Cinovic
 * @copyright Copyright (c) Cinovic Technologies LLP (https://cinovic.com)
 * @license   https://store.cinovic.com/license.html
 */
namespace Cinovic\Whatsapp\Controller\Adminhtml\personlist;

/**
 * Class Index
 * @package Cinovic\Whatsapp\Controller\Adminhtml\personlist
 */
class Index extends \Magento\Backend\App\Action
{
	/**
	 * @var PageFactory
	 */
	protected $resultPageFactory = false;

	/**
	 * Index constructor
	 * @param MagentoBackendAppActionContext        $context           [description]
	 * @param MagentoFrameworkViewResultPageFactory $resultPageFactory [description]
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	/**
	 * @return PageFactory
	 */
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Whatsapp Person List')));
          $resultPage->addContent(
               $resultPage->getLayout()->createBlock('Cinovic\Whatsapp\Block\Adminhtml\Whatsapp')
           );
		return $resultPage;
	}
}
