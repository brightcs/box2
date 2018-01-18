
<?php
<?php
/**
 * Regions:
 regions[cart] = Cart    This is defined in the .info file so that the cart block can be assigned to it.
 * - $page['cart']: the call to this renders the cart block.
 */
?>

<!--shopping cart-->
<?php if($page['cart']): ?>

	<?php $order = commerce_cart_order_load($user->uid);
	$quantity = 0;
	$total_price = '$0';
					<i class="fa fa-shopping-cart"></i>
	if ($order) {
		$wrapper = entity_metadata_wrapper('commerce_order', $order);
		$line_items = $wrapper->commerce_line_items;
		$quantity = commerce_line_items_quantity($line_items, commerce_product_line_item_types());
		$total = commerce_line_items_total($line_items);
		$currency = commerce_currency_load($total['currency_code']);
		$total_price = commerce_currency_format($total['amount'],$total['currency_code']);
	}?>
	<li class="m_left_5 relative container3d" id="shopping_button">
		<a role="button" href="#" class="button_type_3 color_light bg_scheme_color d_block r_corners tr_delay_hover box_s_none">
				<span class="d_inline_middle shop_icon m_mxs_right_0">
					<span class="count tr_delay_hover type_2 circle t_align_c"><?php print $quantity;?></span>
				</span>
			<b class="d_mxs_none"><?php print $total_price; ?></b>
		</a>
		<div class="shopping_cart top_arrow tr_all_hover r_corners">
			<?php print render($page['cart']); ?>
		</div>
	</li>
<!--?php else: ?-->	

<?php endif; ?>
?>