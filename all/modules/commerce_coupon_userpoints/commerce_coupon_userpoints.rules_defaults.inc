<?php

/**
 * @file
 * Commerce Coupon Userpoints Fixed Default Rules
 */

/**
 * Implements hook_default_rules_configuration().
 */
function commerce_coupon_userpoints_default_rules_configuration() {
  $rules = array();

  // Redeem the coupon.
  $rule = rules_reaction_rule();
  $rule->label = t('Redeem Userpoints Coupon');
  $rule->active = TRUE;
  $rule
      ->event('commerce_coupon_redeem')
      ->condition('data_is', array(
        'data:select' => 'coupon:type',
        'op' => '=',
        'value' => 'commerce_coupon_userpoints',
          )
      )
      ->condition('entity_has_field', array(
        'entity:select' => 'commerce_order',
        'field' => 'commerce_coupon_order_reference',
          )
      )
      ->condition('data_is', array(
        'data:select' => 'coupon:is-active',
        'op' => '=',
        'value' => TRUE))
      ->action('list_add', array(
        'list:select' => 'commerce-order:commerce-coupon-order-reference',
        'item:select' => 'coupon',
        'unique' => 1,
      ));
  $rules['commerce_redeem_coupon_userpoints'] = $rule;

  // Calculate new point balance.
  $rule = rules_reaction_rule();
  $rule->label = t('Apply coupon userpoints to order');
  $rule->active = TRUE;
  $rule
      ->event('commerce_product_calculate_sell_price')
      ->condition(rules_condition('data_is_empty', array(
            'data:select' => 'commerce-line-item:line-item-id',
          ))->negate())
      ->condition('entity_has_field', array(
        'entity:select' => 'commerce-line-item:order',
        'field' => 'commerce_coupon_order_reference',
      ))
      ->condition(rules_condition('data_is_empty', array(
            'data:select' =>
            'commerce-line-item:order:commerce-coupon-order-reference',
          ))->negate())
      ->action('commerce_coupon_userpoints_calculate', array(
        'coupon:select' =>
        'commerce-line-item:order:commerce-coupon-order-reference:0',
        'commerce_order:select' => 'commerce-line-item:order',
      ));

  $rules['commerce_coupon_userpoints_calculate'] = $rule;

  // Award points to the user upon checking out.
  $rule = rules_reaction_rule();
  $rule->label = t('Grant user earned points upon checkout');
  $rule->active = TRUE;
  $rule
      ->event('commerce_checkout_complete')
      ->condition('entity_has_field', array(
        'entity:select' => 'commerce-order',
        'field' => 'field_userpoints_earned',
      ))
      ->condition(rules_condition('data_is_empty', array(
            'data:select' => 'commerce-order:field_userpoints_earned',
          ))->negate())
      ->condition('entity_has_field', array(
        'entity:select' => 'commerce-order',
        'field' => 'field_userpoints_earned_type',
      ))
      ->action('userpoints_action_grant_points', array(
        'user:select' => 'commerce-order:owner',
        'points:select' => 'commerce-order:field_userpoints_earned',
        'tid:select' => 'commerce-order:field-userpoints-earned-type:tid',
        'entity:select' => 'commerce-order',
        'operation' => 'Add',
        'display' => '1',
        'moderate' => 'default',
          )
  );

  $rules['commerce_grant_userpoints'] = $rule;

  return $rules;
}
