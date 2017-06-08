<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition End User License Agreement
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magento.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_XmlConnect
 * @copyright Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license http://www.magento.com/license/enterprise-edition
 */

/**
 * Best sellers products xml renderer block
 *
 * @category    Mage
 * @package     Mage_XmlConnect
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_XmlConnect_Block_Adminhtml_Connect_Dashboard_BestSellers
    extends Mage_Adminhtml_Block_Dashboard_Tab_Products_Ordered
{
    /**
     * Best sellers count to display
     */
    const BESTSELLERS_COUNT_LIMIT = 5;

    /**
     * Get rid of unnecessary collection initialization
     *
     * @return Mage_XmlConnect_Block_Adminhtml_Connect_Dashboard_BestSellers
     */
    protected function _prepareCollection()
    {
        return $this;
    }

    /**
     * Init last search terms collection
     *
     * @param int|null $storeId
     * @return Mage_XmlConnect_Block_Adminhtml_Connect_Dashboard_BestSellers
     */
    protected function _initCollection($storeId)
    {
        /** @var $collection Mage_Sales_Model_Resource_Report_Bestsellers_Collection */
        $collection = Mage::getResourceModel('sales/report_bestsellers_collection')->setModel('catalog/product')
            ->addStoreFilter($storeId)->setPageSize(self::BESTSELLERS_COUNT_LIMIT);
        $this->setCollection($collection);
        return $this;
    }

    /**
     * Clear collection
     *
     * @return Mage_XmlConnect_Block_Adminhtml_Connect_Dashboard_BestSellers
     */
    protected function _clearCollection()
    {
        $this->_collection = null;
        return $this;
    }

    /**
     * Add best sellers products to xml object
     *
     * @param Mage_XmlConnect_Model_Simplexml_Element $xmlObj
     * @return Mage_XmlConnect_Block_Adminhtml_Connect_Dashboard_BestSellers
     */
    public function addBestSellersToXmlObj(Mage_XmlConnect_Model_Simplexml_Element $xmlObj)
    {
        foreach (Mage::helper('xmlconnect/adminApplication')->getSwitcherList() as $storeId) {
            $this->_clearCollection()->_initCollection($storeId);
            $valuesXml = $xmlObj->addCustomChild('values', null, array(
                'store_id' => $storeId ? $storeId : Mage_XmlConnect_Helper_AdminApplication::ALL_STORE_VIEWS
            ));

            if(!count($this->getCollection()->getItems()) > 0) {
                continue;
            }

            /** @var $orderHelper Mage_XmlConnect_Helper_Adminhtml_Dashboard_Order */
            $orderHelper = Mage::helper('xmlconnect/adminhtml_dashboard_order');

            foreach ($this->getCollection()->getItems() as $item) {
                $itemListXml = $valuesXml->addCustomChild('item');
                $itemListXml->addCustomChild('name', $item->getName(), array(
                    'label' => Mage::helper('sales')->__('Product Name')
                ));
                $itemListXml->addCustomChild('price', $orderHelper->preparePrice($item->getProductPrice(), $storeId),
                    array('label' => Mage::helper('sales')->__('Price')));
                $itemListXml->addCustomChild('qty_ordered', $item->getQtyOrdered(), array(
                    'label' => Mage::helper('sales')->__('Quantity Ordered')
                ));
            }
        }
        return $this;
    }
}
