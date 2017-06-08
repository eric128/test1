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

namespace Enterprise\TargetRule\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Enterprise\TargetRule\Test\Page\Adminhtml\TargetRuleIndex;

/**
 * Assert that success message is displayed after target rule save.
 */
class AssertTargetRuleSuccessSaveMessage extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Target rule success save message.
     */
    const SUCCESS_MESSAGE = 'The rule has been saved.';

    /**
     * Assert that success message is displayed after target rule save.
     *
     * @param TargetRuleIndex $targetRuleIndex
     * @return void
     */
    public function processAssert(TargetRuleIndex $targetRuleIndex)
    {
        \PHPUnit_Framework_Assert::assertEquals(
            self::SUCCESS_MESSAGE,
            $targetRuleIndex->getMessagesBlock()->getSuccessMessages()
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Target rule success save message is present.';
    }
}
