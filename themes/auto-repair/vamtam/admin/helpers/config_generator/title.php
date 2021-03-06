<?php
	/**
	 * config page title
	 */

	$tabs = array();

	foreach ( $this->options as $option ) {
		if ( 'start' === $option['type'] ) {
			$href = isset( $option['slug'] ) ? $option['slug'] : $option['name'];

			if ( isset( $option['sub'] ) ) {
				$href = $option['sub'] . " $href";
			}

			$href = preg_replace( '/[^\w]+/', '-', strtolower( $href ) );

			$tabs[] = array(
				'href'   => $href,
				'name'   => $option['name'],
				'nosave' => isset( $option['nosave'] ) && $option['nosave'],
			);
		}
	}
?>

<div id="wpv-ajax-overlay"></div><div id="wpv-ajax-content"><?php _e( 'Loading', 'auto-repair' )?></div>

<div id="wpv-config" class="clearfix ui-tabs">
	<div id="wpv-config-tabs-wrapper" class="clearfix">
		<div id="icon-index" class="icon32"><br></div>
		<?php if ( count( $tabs ) === 1 ) :?>
			<h2 class="wpv-config-no-tabs"><?php echo $tabs[0]['name'] ?></h2>
		<?php endif ?>
		<h2 id="wpv-config-tabs" class="nav-tab-wrapper <?php if ( count( $tabs ) === 1 ) echo esc_attr( 'hidden' ) ?>">
			<ul>
				<?php foreach ( $tabs as $i=>$tab ) : ?>
					<li class="<?php if ( $tab['nosave'] ) echo 'nosave'; // xss ok ?>"><a href="#<?php echo esc_attr( $tab['href'] ) ?>-tab-<?php echo esc_attr( $i ) ?>" title="<?php echo esc_attr( $tab['name'] ) ?>" class="nav-tab"><?php echo $tab['name'] // xss ok ?></a></li>
				<?php endforeach ?>
			</ul>

		</h2>
	</div>

	<?php global $wpv_config_messages; echo $wpv_config_messages; // xss ok ?>

<?php
	global $wpv_loaded_config_groups;
	$wpv_loaded_config_groups = 0;
?>