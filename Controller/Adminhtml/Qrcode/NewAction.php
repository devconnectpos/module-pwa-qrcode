<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 18:10
 */

namespace SM\PWAQrCode\Controller\Adminhtml\Qrcode;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class NewAction extends Action
{
    const ADMIN_RESOURCE = 'SM_PWAQrCode::save';

    protected $resultForwardFactory;

    /**
     * NewAction constructor.
     * @param Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory)
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
