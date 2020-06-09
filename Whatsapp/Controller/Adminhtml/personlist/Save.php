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

class Save  extends \Magento\Backend\App\Action
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Cinovic\Whatsapp\Model\Whatsappmessage $whatsappmessageCollection
    ) {
        $this->whatsappmessageCollection = $whatsappmessageCollection;
        parent::__construct($context);
    }

    public function execute()
    {
        $image = null;
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $image = $this->getRequest()->getFiles('image_url');
        $formPostValues['imagedata'] = $data;

        if (isset($formPostValues['imagedata'])) {

            $imageData = $formPostValues['imagedata'];
            $imageId = isset($imageData['image_id']) ? $imageData['image_id'] : null;

            if (isset($image) && isset($image['name']) && $image['name'] != null) {

                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);

                $file = $this->_objectManager->create('\Magento\Framework\Filesystem\Driver\File');

                if (isset($imageData['image_url']['delete']) && $imageData['image_url']['delete'] == 1) {
                    $deleteurl = $mediaDirectory->getAbsolutePath() . $imageData['image_url']['value'];
                    if ($file->isExists($deleteurl)) {
                        $file->deleteFile($deleteurl);
                        $imageData['image_url'] = null;
                    }
                }


                try {

                    $uploader = $this->_objectManager->create('\Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'image_url']);

                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                    $uploader->addValidateCallback('image_url', $imageAdapter, 'validateUploadFile');
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);

                    $result = $uploader->save($mediaDirectory->getAbsolutePath('whatsapp/personlist/images'));
                    $imageData['image_url'] = 'whatsapp/personlist/images' . $result['file'];
                } catch (\Exception $e) {

                    if ($e->getCode() == 0) {
                        $this->messageManager->addError($e->getMessage());
                        return $resultRedirect->setPath('*/*/');
                    }
                }
            } else {

                if (isset($imageData['image_url']) && isset($imageData['image_url']['value'])) {
                    if (isset($imageData['image_url']['delete'])) {
                        $imageData['image_url'] = null;
                        $imageData['delete_image'] = true;
                    } elseif (isset($imageData['image_url']['value'])) {
                        $imageData['image_url'] = $imageData['image_url']['value'];
                    } else {

                        $imageData['image_url'] = null;
                    }
                }
            }
        }


        try {
            $model = $this->whatsappmessageCollection;
            if (isset($data['entity_id'])) {
                $model->load($data['entity_id'], 'entity_id');
                $model->setName($data['name']);
                $model->setDepartmentName($data['department_name']);
                $model->setCustomMessage($data['custom_message']);
                $model->setNumber($data['number']);
                $model->setImageUrl($imageData['image_url']);
                $model->setDisableEnable($data['disable_enable']);
            } else {
                $model->setName($data['name']);
                $model->setDepartmentName($data['department_name']);
                $model->setCustomMessage($data['custom_message']);
                $model->setNumber($data['number']);
                $model->setImageUrl($imageData['image_url']);
                $model->setDisableEnable($data['disable_enable']);
            }
            $model->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
    }
}
