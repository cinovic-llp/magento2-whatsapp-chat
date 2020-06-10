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
 * Class MassDelete
 * @package Cinovic\Whatsapp\Controller\Adminhtml\personlist
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * MassDelete constructor.
     * @param MagentoBackendAppActionContext             $context
     * @param CinovicWhatsappModelWhatsappmessageFactory $whatsappmessageCollection
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Cinovic\Whatsapp\Model\WhatsappmessageFactory $whatsappmessageCollection
    ) {
        $this->_whatsappmessageCollection = $whatsappmessageCollection;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {

        $params = $this->getRequest()->getParam('whatsappcustomer');
        foreach ($params as $id) {
            $collection = $this->_whatsappmessageCollection->create()->getCollection()->addFieldToFilter('entity_id', $id)->getFirstItem();
            $collection->delete();
        }

        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
