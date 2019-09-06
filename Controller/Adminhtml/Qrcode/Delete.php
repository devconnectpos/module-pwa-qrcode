<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 18:10
 */

namespace SM\PWAQrCode\Controller\Adminhtml\Qrcode;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('qrcode_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('SM\PWAQrCode\Model\Qrcode');
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccess(__('The QR Code has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['qrcode_id' => $id]);
            }
        } else {
            $this->messageManager->addError(__('We can\'t find the QR Code to delete.'));
            return $resultRedirect->setPath('*/*/');
        }
    }
}
