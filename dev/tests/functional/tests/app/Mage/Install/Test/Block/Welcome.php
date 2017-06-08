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
 * @category    Tests
 * @package     Tests_Functional
 * @copyright Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license http://www.magento.com/license/enterprise-edition
 */

namespace Mage\Install\Test\Block;

use Magento\Mtf\Client\Locator;
use Magento\Mtf\Block\Block;

/**
 * License block.
 */
class Welcome extends Block
{
    /**
     * Title of wizard.
     *
     * @var string
     */
    protected $wizardTitle = '.page-head>h3';

//    /**
//     * License agreements checkbox selector.
//     *
//     * @var string
//     */
//    protected $agree = '#agree';

    /**
     * Get wizard text.
     *
     * @return string
     */
    public function getWizardTitle()
    {
        return $this->_rootElement->find($this->wizardTitle)->getText();
    }

//    /**
//     * Accept license agreements.
//     *
//     * @return void
//     */
//    public function acceptLicenseAgreement()
//    {
//        $this->_rootElement->find($this->agree, Locator::SELECTOR_CSS, 'checkbox')->setValue('Yes');
//    }
}
