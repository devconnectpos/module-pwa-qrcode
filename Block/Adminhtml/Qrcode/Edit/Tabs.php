<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 17:06
 */

namespace SM\PWAQrCode\Block\Adminhtml\Qrcode\Edit;


class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('qrcode_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('QR Code Information'));
    }
}
