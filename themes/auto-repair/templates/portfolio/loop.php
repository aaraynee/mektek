<?php

/**
 * Portfolio loop template
 *
 * @package wpv
 * @subpackage auto-repair
 */

global $wp_query;

$li_style = '';

$main_id = uniqid();

if($scrollable)
	echo '<div class="scrollable-wrapper">';
?>

<section class="portfolios <?php if(!empty($sortable)) echo esc_attr( $engine ) ?> <?php echo $scrollable ? 'scroll-x' : 'normal row' // xss ok ?> title-<?php echo esc_attr( $title ) ?> <?php echo $desc ? 'has-description' : 'no-description' // xss ok ?> <?php if(!empty($class)) echo esc_attr( $class ) ?>" id="<?php echo esc_attr( $main_id ) ?>">
	<?php
		if(!empty($sortable)) include locate_template( 'templates/portfolio/loop/sortable-header.php' );
	?>
	<ul class="clearfix <?php echo esc_attr( $sortable ) ?> portfolio-items" data-columns="<?php echo intval( $column ) ?>">
		<?php
			while(have_posts()): the_post();
				include locate_template( 'templates/portfolio/loop/item.php' );
			endwhile;
		?>
	</ul>
	<?php if ($nopaging == 'false')	WpvTemplates::pagination( $paging_preference ); ?>
</section>
<?php if($scrollable) echo '</div>' ?>
