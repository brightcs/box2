<?php

/**
 * @file
 * Commerce Coupon Userpoints Fixed Rules
 */

/**
 * Implements hook_rules_action_info().
 */
function commerce_coupon_userpoints_rules_action_info() {

  $actions = array();

  // If a userpoint coupon was applied add the additional points to the order
  // total of userpoints earned.
  $actions['commerce_coupon_userpoints_calculate'] = array(
    'label' => t('Apply coupon userpoints to order'),
    'parameter' => array(
      'commerce_order' => array(
        'type' => 'commerce_order',
        'label' => t('commerce order'),
      ),
      'coupon' => array(
        'type' => 'commerce_coupon',
        'label' => t('Coupon'),
      ),
    ),
    'base' => 'commerce_coupon_userpoints_calculate',
    'callbacks' => array(
      'execute' => 'commerce_coupon_userpoints_calculate',
    ),
    'group' => t('Commerce Coupon'),
  );

  return $actions;
}

/**
 * Calculates the userpoints for the order.
 */
function commerce_coupon_userpoints_calculate($commerce_order, $coupon) {
  $coupon_wrapper = entity_metadata_wrapper('commerce_coupon', $coupon);
  $coupon_fields = $coupon_wrapper->getPropertyInfo();
  $order_wrapper = entity_metadata_wrapper('commerce_order', $commerce_order);

  // Apply the coupon just if it's active, the type is of pct and it has the
  // field for percentage set.
  if ($coupon->is_active != TRUE ||
      $coupon->type != 'commerce_coupon_userpoints') {
    return;
  }

  // Total points for the line item.
  $total_points = 0;

  // Foreach line item, load the product.
  $line_item_products = array();
  foreach($order_wrapper->commerce_line_items as $delta => $line_item_wrapper) {
    $line_item = $line_item_wrapper->value();
    $pid = $line_item->commerce_product['und'][0]['product_id'];
    $product = commerce_product_load($pid);
    $line_item_products[$pid] = $line_item->quantity;
  }

  // If product bonus.
  $product_bonus = 0;
  if (isset($coupon_fields['userpoints_coupon_product_points']) &&
      $coupon_wrapper->userpoints_coupon_product_points->value() > 0 &&
      isset($coupon_fields['userpoints_coupon_products']) &&
      count($coupon_wrapper->userpoints_coupon_products->value()) > 0) {

    // If the products in the line item products is the same as the eligible
    // products then add the bonus for each one of the products.
    $eligible_products = $coupon_wrapper->userpoints_coupon_products->value();
    foreach ($line_item_products as $id => $quantity) {
      for ($i = 0; $i < count($eligible_products); $i++) {
        if ($eligible_products[$i]->product_id == $id) {
          $total_points += (
              $coupon_wrapper->userpoints_coupon_product_points->value() *
              $line_item_products[$id]);
        }
      }
    }
  }

  // If order bonus.
  $order_bonus = 0;
  if (isset($coupon_fields['userpoints_coupon_order_points']) && $coupon_wrapper->userpoints_coupon_order_points->value() > 0 &&
      isset($coupon_fields['userpoints_coupon_order_min']) && $coupon_wrapper->userpoints_coupon_order_min->value() > 0) {
    $order_total = $order_wrapper->commerce_order_total->amount->value()/ 100;
    if ($order_total >= $coupon_wrapper->userpoints_coupon_order_min->value()) {
      $total_points += $coupon_wrapper->userpoints_coupon_order_points->value();
    }
  }
  
  $order_wrapper->field_userpoints_earned->set($total_points);
  $order_wrapper->field_userpoints_earned_type->set($coupon_wrapper->userpoints_coupon_userpoints->value()->tid);
  commerce_order_save($commerce_order);
}
