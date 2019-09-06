<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 18:10
 */

namespace SM\PWAQrCode\Controller\Adminhtml\Qrcode;

use Magento\Backend\App\Action;

class Edit extends Action
{
    const ADMIN_RESOURCE = "PWAQrCode::save";
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }


    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SM_PWAQrCode::qrcode')
            ->addBreadcrumb(__('QR Code'), __('QR Code'))
            ->addBreadcrumb(__('Manage QR Code'), __('Manage QR Code'));
        return $resultPage;
    }

    /**
     * Edit Keyword
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('qrcode_id');
        $model = $this->_objectManager->create('SM\PWAQrCode\Model\Qrcode');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This QR Code no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('current_qrcode', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit QR Code') : __('New QR Code'),
            $id ? __('Edit QR Code') : __('New QR Code')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('QR Code'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New QR Code'));

        return $resultPage;
    }
}
