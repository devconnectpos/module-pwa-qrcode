<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 18:12
 */

namespace SM\PWAQrCode\Model\ResourceModel;


class Qrcode extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sm_pwa_qrcode','qrcode_id');
    }
}
