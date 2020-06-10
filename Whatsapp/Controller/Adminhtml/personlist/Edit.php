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
 * Class Edit
 * @package Cinovic\Whatsapp\Controller\Adminhtml\personlist
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * Edit constructor
     * @param MagentoBackendAppActionContext        $context                   [description]
     * @param CinovicWhatsappModelWhatsappmessage   $whatsappmessageCollection [description]
     * @param MagentoFrameworkRegistry              $registry                  [description]
     * @param MagentoFrameworkViewResultPageFactory $resultPageFactory         [description]
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Cinovic\Whatsapp\Model\Whatsappmessage $whatsappmessageCollection,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->whatsappmessageCollection = $whatsappmessageCollection;
        parent::__construct($context);
    }

    /**
     * @return PageFactory
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('entity_id');

        $model = $this->whatsappmessageCollection;

        if ($id) {
            $model->load($id, 'entity_id');
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('whatsappcustomer', $model);
        $resultPage->getConfig()->getTitle()->prepend(__('Whatsapp Person List'));
        $resultPage->addContent(
            $resultPage->getLayout()->createBlock('Cinovic\Whatsapp\Block\Adminhtml\Personlist\Edit')
        );
        return $resultPage;
    }
}
