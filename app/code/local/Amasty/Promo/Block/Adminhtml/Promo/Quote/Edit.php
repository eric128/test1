<?php

/**
 * @author Amasty Team
 * @copyright Copyright (c) 2017 Amasty (https://www.amasty.com)
 * @package Amasty_Promo
 */
class Amasty_Promo_Block_Adminhtml_Promo_Quote_Edit extends Mage_Adminhtml_Block_Promo_Quote_Edit
{
    public function __construct()
    {
        parent::__construct();

        $this->_formScripts[] = "
        	function ampromo_note() {
                var selectNote = $('rule_simple_action_note');
                var select = $('rule_simple_action');
                if (!selectNote) {
                    select.insert({
                        after: new Element('p', {class: 'note', id: 'rule_simple_action_note'})
                    });

                    selectNote = $('rule_simple_action_note');
                }

                var noteTemplate = new Template('" . $this->__('Please see <a target="_blank" href="https://amasty.com/knowledge-base/special-promotions-#{value}.html">usage example</a>') . ".');
                selectNote.update( noteTemplate.evaluate({value: select.value.split('_').join('-')}) );
			}
            function ampromo_hide() {
                $('rule_discount_qty').up().up().show();
                $('rule_discount_step').up().up().show();

                var s = $('rule_apply_to_shipping');
                if (s) s.up().up().show();

                $('rule_actions_fieldset').up().show();
                $('rule_promo_sku').up().up().hide();
                $('rule_ampromo_type').up().up().hide();
                $('rule_simple_free_shipping').up().up().show();

                if ('ampromo_cart' == $('rule_simple_action').value) {
                    $('rule_simple_free_shipping').up().up().hide();

                    $('rule_actions_fieldset').up().hide();
                    $('rule_discount_qty').up().up().hide();
                    $('rule_discount_step').up().up().hide();

                    if (s) s.up().up().hide();
                    $('rule_promo_sku').up().up().show();
                    $('rule_ampromo_type').up().up().show();
                }
                if ('ampromo_items' == $('rule_simple_action').value){
                    $('rule_simple_free_shipping').up().up().hide();

                    if (s) s.up().up().hide();
                    $('rule_promo_sku').up().up().show();
                    $('rule_ampromo_type').up().up().show();
                }
                if ('ampromo_product' == $('rule_simple_action').value){
                    $('rule_simple_free_shipping').up().up().hide();

                    if (s) s.up().up().hide();
                }
                if ('ampromo_spent' == $('rule_simple_action').value){
                    $('rule_simple_free_shipping').up().up().hide();

                    if (s) s.up().up().hide();

                    $('rule_promo_sku').up().up().show();
                    $('rule_ampromo_type').up().up().show();
                }
                ampromo_note();
            }
            ampromo_hide();
        ";
    }
}