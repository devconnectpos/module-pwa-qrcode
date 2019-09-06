<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 17:06
 */

namespace SM\PWAQrCode\Block\Adminhtml\Qrcode;


class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize qrcode edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'qrcode_id';
        $this->_blockGroup = 'SM_PWAQrCode';
        $this->_controller = 'adminhtml_qrcode';

        parent::_construct();

        $this->buttonList->remove('add'); //to remove add button
        $this->buttonList->remove('save'); //to remove save button
        $this->buttonList->remove('reset'); //to remove reset button
        $this->buttonList->remove('delete');
        $this->buttonList->remove('back');
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('current_qrcode')->getId()) {
            return __("Edit QR Code '%1'", $this->escapeHtml($this->_coreRegistry->registry('current_qrcode')->getTitle()));
        } else {
            return __('New QR Code');
        }
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '{{tab_id}}']);
    }

    /**
     * Prepare layout
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'content');
                }
            };
        ";
        return parent::_prepareLayout();
    }

}
