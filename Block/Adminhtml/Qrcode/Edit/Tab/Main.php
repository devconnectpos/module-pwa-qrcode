<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 17:07
 */

namespace SM\PWAQrCode\Block\Adminhtml\Qrcode\Edit\Tab;

class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->scopeConfig =  $context->getScopeConfig();
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm() {
        /* @var $model \SM\PWAQrCode\Model\Qrcode */
        $model = $this->_coreRegistry->registry('current_qrcode');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('QR Code Information')]);

        if ($model->getId()) {
            $fieldset->addField('qrcode_id', 'hidden', ['name' => 'qrcode_id']);
        }

        if (!$this->_storeManager->isSingleStoreMode()) {
            $field    = $fieldset->addField(
                'store_id',
                'select',
                [
                    'name'     => 'store_id',
                    'label'    => __('Store'),
                    'title'    => __('Store'),
                    'values'   => $this->_systemStore->getStoreValuesForForm(true, false),
                    'required' => true
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element::class
            );
            $field->setRenderer($renderer);
        }
        else {
            $fieldset->addField('store_id', 'hidden', ['name' => 'store_id']);
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }

        $fieldDiv = $fieldset->addField(
            'qrcode',
            'text',
            [
                'label'    => __(''),
                'title'    => __(''),
                'name'     => 'text',
                'disabled' => $isElementDisabled
            ]
        );
        $renderer = $this->getLayout()->createBlock(
            \SM\PWAQrCode\Block\Adminhtml\Qrcode\Renderer\Form::class
        );
        $fieldDiv->setRenderer($renderer);

        $baseUrl = $fieldset->addField(
            'baseUrl',
            'hidden',
            [
                'label'    => __(''),
                'title'    => __(''),
                'name'     => 'baseUrl',
                'id'       => 'baseUrl',
                'value'    => $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB , true),
                'disabled' => $isElementDisabled
            ]
        );

        $isIntegrateGC = $fieldset->addField(
            'isIntegrateGC',
            'hidden',
            [
                'label'    => __(''),
                'title'    => __(''),
                'name'     => 'isIntegrateGC',
                'id'       => 'isIntegrateGC',
                'value'    => $this->scopeConfig->getValue("pwa/integrate/pwa_integrate_gift_card"),
                'disabled' => $isElementDisabled
            ]
        );

        $isIntegrateRP = $fieldset->addField(
            'isIntegrateRP',
            'hidden',
            [
                'label'    => __(''),
                'title'    => __(''),
                'name'     => 'isIntegrateRP',
                'id'       => 'isIntegrateRP',
                'value'    => $this->scopeConfig->getValue("pwa/integrate/pwa_integrate_reward_points"),
                'disabled' => $isElementDisabled
            ]
        );
        $modelData = $model->getData();
        $modelData['baseUrl'] = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB , true);
        $modelData['isIntegrateGC'] = $this->scopeConfig->getValue("pwa/integrate/pwa_integrate_gift_card");
        $modelData['isIntegrateRP'] = $this->scopeConfig->getValue("pwa/integrate/pwa_integrate_reward_points");

        $form->setValues($modelData);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel() {
        return __('QR Code Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle() {
        return __('QR Code Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden() {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     *
     * @return bool
     */
    protected function _isAllowedAction($resourceId) {
        return $this->_authorization->isAllowed($resourceId);
    }
}
