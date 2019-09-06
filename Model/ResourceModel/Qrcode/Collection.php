<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 17:03
 */

namespace SM\PWAQrCode\Model\ResourceModel\Qrcode;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'qrcode_id';

    public function _construct()
    {
        $this->_init('SM\PWAQrCode\Model\Qrcode','SM\PWAQrCode\Model\ResourceModel\Qrcode');
    }
}
