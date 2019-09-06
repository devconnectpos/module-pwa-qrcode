<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 17:06
 */

namespace SM\PWAQrCode\Block\Adminhtml;


class Qrcode extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'SM_PWAQrCode';
        $this->_headerText = __('Manage QR Code');
        $this->_addButtonLabel = __('Add New QR Code');
        parent::_construct();
    }
}
