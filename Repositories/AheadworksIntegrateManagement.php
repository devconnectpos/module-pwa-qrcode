<?php
/**
 * Created by PhpStorm.
 * User: kid
 * Date: 07/12/2018
 * Time: 17:11
 */

namespace SM\PWAQrCode\Repositories;

class AheadworksIntegrateManagement
{

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\RequestInterface $requestInterface,
                                \Magento\Framework\Controller\ResultFactory $resultFactory,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->request = $requestInterface;
        $this->resultFactory = $resultFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfigGCRP()
    {
        $data = array();
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        if (is_null($this->request->getParam('store_id')))
            throw new \Exception('Not found field: storeId');
        else
            $storeId = $this->request->getParam('store_id');

        $data['isIntegrateGC'] = $this->scopeConfig->getValue('pwa/integrate/pwa_integrate_gift_card', 'stores', $storeId);
        $data['isIntegrateRP'] = $this->scopeConfig->getValue('pwa/integrate/pwa_integrate_reward_points', 'stores', $storeId);

        return $data;
    }
}
