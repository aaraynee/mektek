<?php
/**
 * Site sub-header. Includes a slider, page title, etc.
 *
 * @package  wpv
 */

global $wpv_title;
if ( !is_404() ) {
	if ( wpv_has_woocommerce() ) {
		if ( is_woocommerce() && ! is_single() ) {
			if ( is_product_category() ) {
				$wpv_title = single_cat_title( '', false );
			} elseif ( is_product_tag() ) {
				$wpv_title = single_tag_title( '', false );
			} else {
				$wpv_title = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';
			}
		} elseif ( is_cart() || is_checkout() ) {
			$cart_title     = get_the_title( wc_get_page_id( 'cart' ) );
			$checkout_title = get_the_title( wc_get_page_id( 'checkout' ) );
			$complete_title = __( 'Order Complete', 'auto-repair' );

			$cart_state     = is_cart() ? 'active' : 'inactive';
			$checkout_state = is_checkout() ? 'active' : 'inactive';

			$wpv_title = "
				<span class='checkout-breadcrumb'>
					<span class='title-part-{$cart_state}'>$cart_title</span>" .
					wpv_shortcode_icon( array( 'name' => 'arrow-right1' ) ) .
					"<span class='title-part-{$checkout_state}'>$checkout_title</span>" .
					wpv_shortcode_icon( array( 'name' => 'arrow-right1' ) ) .
					"<span class='title-part-inactive'>$complete_title</span>
				</span>
			";
		}
	}
}

$page_header_bg = WpvTemplates::page_header_background();
$global_page_header_bg = wpv_get_option( 'page-title-background-image' ) . wpv_get_option( 'page-title-background-color' );

if ( ( ! WpvTemplates::has_breadcrumbs() && ! WpvTemplates::has_page_header() && ! WpvTemplates::has_post_siblings_buttons() ) || is_404() ) return;
if ( is_page_template( 'page-blank.php' ) ) return;


?>
<div id="sub-header" class="layout-<?php echo esc_attr( WpvTemplates::get_layout() ) ?> <?php if ( ! empty( $page_header_bg ) || ! empty( $global_page_header_bg ) ) echo 'has-background' // xss ok ?>">
	<div class="meta-header" style="<?php echo esc_attr( $page_header_bg ) ?>">
		<div class="limit-wrapper">
			<div class="meta-header-inside">
				<?php
					WpvTemplates::breadcrumbs();
					WpvTemplates::page_header( false, $wpv_title );
				?>
			</div>
		</div>
	</div>
</div>