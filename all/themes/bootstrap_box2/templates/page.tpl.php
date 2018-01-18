<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
?>
<?php
global $theme_root;
global $base_url;
global $user;
$curr_uri = request_uri();
$array_curr_uri = explode('/', $curr_uri);
$data = arg(0);
?>
    <!--header top part-->
	
	<div class="container">
        <div class="row clearfix">
			<div class="h_top_part col-lg-4 col-md-4 col-sm-4">
				
				<div class="f_size_small">
					<?php if ($user->uid) : ?>
						Welcome <a href="<?php echo $base_url; ?>/users"><?php echo $user->name; ?></a> / <a href="<?php echo $base_url; ?>/user/logout">Logout</a>
					<?php else :?>
						Welcome visitor can you	
						<a href="#" data-popup="#login_popup">Log In</a> or <a href="<?php echo $base_url; ?>/user/register">Create an Account</a> 
					<?php endif; ?>
	</div>
				
			</div>
			
	
			<?php if ($page['topbar']) : ?>
				<div class="h_top_part col-lg-4 col-md-4 col-sm-4">

							<?php print render($page['topbar']); ?>

				</div>
			<?php endif; ?>
			
			<div class="h_top_part col-lg-4 col-md-4 col-sm-4">		
				<!--?php print t('Top 2'); ?-->
				
				<ul class="d_inline_b horizontal_list clearfix f_size_small users_nav flex_r">
						<li><a href="<?php echo $base_url; ?>/user" class="default_t_color">My Account</a></li>
					<?php if ($user->uid) : ?>
						<li><a href="<?php echo $base_url; ?>/user/<?php echo $user->uid ?>/orders" class="default_t_color">List Orders</a></li>
					<?php else: ?>
						<li><a href="<?php echo $base_url; ?>/user" class="default_t_color">Orders List</a></li>
					<?php endif; ?>
						<!--li--><!--a href=" --><!--?php echo $base_url; ?--> <!--/wishlist" class="default_t_color"--><!--Wishlist--><!--/a--><!--/li-->
						<li><a href="<?php echo $base_url; ?>/checkout" class="default_t_color">Checkout</a></li>
				</ul>
								
			</div>			
        </div>
    </div>

<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
  <div class="<?php print $container_class; ?>">
    <div class="navbar-header col-lg-2 col-md-2 col-sm-3 col-xs-9 t_md_align_c m_md_bottom_15">
      <?php if ($logo): ?>
        <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <!--?php if (!empty($site_name)): ?-->
      <!--  <a class="name navbar-brand" href=" --><!--?php print $front_page; ?--><!--" title="--><!--?php print t('Home'); ?>"--><!--?php print $site_name; ?></a-->
      <!-- ?php endif; ?-->

      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
          <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <?php endif; ?>
    </div>

    <!--?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?-->
	<!-- start nav bar -->
	<?php if (!empty($primary_nav) ): ?>
      <div class="navbar-collapse collapse" id="navbar-collapse">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php print render($primary_nav); ?>
          <?php endif; ?>
		  
		  
          <!--?php if (!empty($secondary_nav)): ?-->
            <!--?php print render($secondary_nav); ?-->
          <!--?php endif; ?-->
		  
		  <!-- insert whish list & shopping cart -->
	  
						<ul class="f_right horizontal_list d_sm_inline_b f_sm_none clearfix t_align_l site_settings">
							<!-- Search -->
							<li class="m_left_5 relative container3d" id="search_button">
								<button class="f_right search_button tr_all_hover f_xs_none d_xs_none">
									<i class="fa fa-search"></i>
								</button>
								<!--search form-->
								<div class="searchform_wrap type_2 bg_tr tf_xs_none tr_all_hover w_inherit">
									<div class="container vc_child h_inherit relative w_inherit">
										<?php
										$block = module_invoke('search', 'block_view', 'form');
										print render($block['content']);
										?>
										<button class="close_search_form tr_all_hover d_xs_none color_dark">
											<i class="fa fa-times"></i>
										</button>
									</div>
								</div>
							</li>
                            <!--Reward Multiplier-->	
							
                                <li class="m_left_5 relative container3d" id="rewards_button">
                                    <a role="button" href="#" class="button_type_3 color_light bg_scheme_color d_block r_corners tr_delay_hover box_s_none">
                                            <span class="d_inline_middle shop_icon m_mxs_right_0">
                                                <i class="fa fa-money"></i>
                                                <span class="count tr_delay_hover type_2 circle t_align_c"><?php print "X2";?></span>
                                            </span>
                                        <b class="d_mxs_none"><?php print "< $600" ?></b>
                                    </a>
									<?php if($page['rewards']): ?>
										<div class="shopping_cart top_arrow tr_all_hover r_corners">
											<?php print render($page['rewards']); ?>
										</div>
									<?php endif;?>
                                </li>

							
						
                            <!--wish list-->						
                            <!--?php if(module_exists('flag')): -->
							<?php if(1==2):
                            $wishlist = flag_get_user_flags('node');
                            $count_wishlist = 0;
                            if(isset($wishlist['shop'])){
                                $count_wishlist = count($wishlist['shop']);
                            }
                            ?>
                            <li class="relative">
                                <a role="button" href="<?php print $base_url.'/'.drupal_get_path_alias('wishlist');?>" class="button_type_1 color_dark d_block bg_light_color_1 r_corners tr_delay_hover box_s_none"><i class="fa fa-heart-o f_size_ex_large"></i><span class="count circle t_align_c"><?php print $count_wishlist;?></span></a>
                            </li>
                            <?php endif;?>
							
							
                            <!--shopping cart-->
							<!--?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'\cart_button.inc'); 

?--> 
<!--?php require_once 'includes/vars.php';
echo "I have a $color $car.";
?-->
							<!--?php
							     require_once ("/includes/cart_button.inc");
							?-->
                            <?php if($page['cart']): ?>
							
                                <?php $order = commerce_cart_order_load($user->uid);
                                $quantity = 0;
                                $total_price = '$0';
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
                                                <i class="fa fa-shopping-cart"></i>
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
                        </ul>		  
		  
		  
		  
		  
		  <!--  end inset shopping cart-->
		  
		  
          <!--?php if (!empty($page['navigation'])): ?-->
            <!--?php print render($page['navigation']); ?-->
          <!--?php endif; ?-->
        </nav>
      </div>
    <?php endif; ?>
	<!-- end nav bar -->	
	
  </div>
</header>

<div class="main-container <?php print $container_class; ?>">

  <header role="banner" id="page-header">
  
    <?php if (!empty($site_slogan)): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#page-header -->

  <div class="row">
  
  
      <!--breadcrumbs-->

        <?php if ($breadcrumb): ?>
            <div class="breadcrumbs">
                <div class="container">
                    <?php print $breadcrumb; ?>
                </div>
            </div>
        <?php endif; ?>

    
    <!-- Message -->
    <div class="message">
        <div class="container">
            <?php print $messages;  ?>
        </div>
    </div>
  
  
	<!--content-->
    <div class="page_content_offset">
        <div class="container wrapper">
		
		
            <?php if ($page['right_sidebar']): ?>
                <div class="row clearfix">
                    <section class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
                        <?php if(isset($title)): ?>
                            <h2 class="tt_uppercase color_dark m_bottom_20"><?php print $title; ?></h2>
                        <?php endif; ?>
                        <?php if ($tabs = render($tabs)): ?>
                            <div class="main-tabs">
                                <?php print render($tabs); ?>
                            </div>
                        <?php endif; ?>
						
						<?php if ($page['before_content']): ?>
							<?php print render($page['before_content']); ?>
						<?php endif; ?>

                        <?php print render($title_prefix); ?>
                        <?php if ($page['content']): ?>
                            <?php print render($page['content']); ?>
                        <?php endif; ?>
                        <?php print render($title_suffix); ?>
					<!--
						<?php if ($page['after_content']): ?>
							<?php print render($page['after_content']); ?>
						<?php endif; ?>	
					-->	
                    </section>
                    <aside class="col-lg-3 col-md-3 col-sm-3">
                        <?php if ($page['right_sidebar']): ?>
                            <?php print render($page['right_sidebar']); ?>
                        <?php endif; ?>
                    </aside>
                </div>
            <?php else: ?>
                <?php if(isset($title)): ?>
                    <h2 class="tt_uppercase color_dark m_bottom_20"><?php print $title; ?></h2>
                <?php endif; ?>
                <?php if ($tabs = render($tabs)): ?>
                    <div class="main-tabs">
                        <?php print render($tabs); ?>
                    </div>
                <?php endif; ?>
				<?php if ($page['before_content']): ?>
					<?php print render($page['before_content']); ?>
				<?php endif; ?>
                <?php print render($title_prefix); ?>
				<?php if ($page['content']): ?>
					<?php print render($page['content']); ?>
				<?php endif; ?>
                <?php print render($title_suffix); ?>
				
				<?php if ($page['after_content']): ?>
					<?php print render($page['after_content']); ?>
				<?php endif; ?>
            <?php endif; ?>
			
				<!-- Help -->
			      <?php if (!empty($page['help'])): ?>
					<?php print render($page['help']); ?>
				  <?php endif; ?>

        </div>	
    </div>

  
  
  


	
	
  </div>
</div>


<footer id="footer" class="type_2">
    <div class="footer_top_part p_vr_0">
        <div class="container">
            <div class="row clearfix">
                <?php if($page['footer_top_1']):?>
                    <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_20 m_xs_bottom_10 f-style-1 f-style-social">
                        <?php print render($page['footer_top_1']);?>
                    </div>
                <?php endif;?>
                <?php if($page['footer_top_2']):?>
                    <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_20 m_xs_bottom_30 f-style-3">
                        <?php print render($page['footer_top_2']);?>
                    </div>
                <?php endif;?>
            </div>
        </div>
       <!-- <hr class="divider_type_4 m_bottom_20"> -->
        <div class="container">
            <div class="row clearfix">
                <?php if ($page['footer_1']) :?>
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 m_bottom_30">
                    <?php print render($page['footer_1']);?>

                </div>
                <?php endif; ?>
                <?php if ($page['footer_2']) :?>
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 m_bottom_30">
                    <?php  print render($page['footer_2']);?>
                </div>
                <?php endif; ?>
                <?php if ($page['footer_3']) :?>
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 m_bottom_30">
                    <?php print render($page['footer_3']);?>
                </div>
                <?php endif; ?>
                <?php if ($page['footer_4']) :?>
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30 m_bottom_30">
                    <?php print render($page['footer_4']);?>
                </div>
                <?php endif; ?>
            </div>
        </div></div>
    <!--copyright part-->
    <div class="footer_bottom_part">
        <div class="container clearfix t_mxs_align_c">
            <?php
            if ($page['footer_bottom']) :
                print render($page['footer_bottom']);
            endif;
            ?>
        </div>
    </div>
</footer>
