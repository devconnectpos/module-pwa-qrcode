<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 18:10
 */

namespace SM\PWAQrCode\Controller\Adminhtml\Qrcode;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SM_PWAQrCode::qrcode');
        $resultPage->addBreadcrumb(__('QR Code'), __('QR Code'));
        $resultPage->addBreadcrumb(__('Manage QR Code'), __('Manage QR Code'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage QR Code'));

        return $resultPage;
    }
}
