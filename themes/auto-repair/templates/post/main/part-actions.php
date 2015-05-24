<?php
/**
 * Post (in loop) actions - inner part
 *
 * @package wpv
 */

if ( ! (
		function_exists( 'wpv_li_love_link' ) ||
		current_user_can( 'edit_post', get_the_ID() ) ||
		(wpv_get_optionb( 'meta_comment_count' ) && comments_open() )
	)
	)
	return;
?>

<div class="post-actions">
	<?php if ( ! post_password_required() ): ?>
		<?php if ( wpv_get_optionb( 'meta_comment_count' ) && comments_open() ): ?>
			<div class="comment-count">
				<?php
					$comment_icon = '<span class="icon">' . wpv_get_icon( 'bubble' ) . '</span>';
					comments_popup_link(
		 $comment_icon . __( '0 <span class="comment-word visuallyhidden">Comments</span>', 'auto-repair' ),
		 $comment_icon . __( '1 <span class="comment-word visuallyhidden">Comment</span>', 'auto-repair' ),
		 $comment_icon . __( '% <span class="comment-word visuallyhidden">Comments</span>', 'auto-repair' )
					); // xss ok
				?>
			</div>
		<?php endif; ?>

		<?php if ( function_exists( 'wpv_li_love_link' ) ): ?>
			<div class="love-count-outer">
				<?php
					echo wpv_li_love_link(
		 '<span class="icon">' . wpv_get_icon( 'heart' ) . '</span><span class="visuallyhidden">'.__( 'Love it', 'auto-repair' ).'</span>',
		 '<span class="icon">' . wpv_get_icon( 'heart' ) . '</span><span class="visuallyhidden">'.__( 'You have loved this.', 'auto-repair' ).'</span>'
					); // xss ok
				?>
			</div>
		<?php endif ?>

		<?php edit_post_link( '<span class="icon">' . wpv_get_icon( 'pencil' ) . '</span><span class="visuallyhidden">'. __( 'Edit', 'auto-repair' ) .'</span>' ) ?>
	<?php endif ?>
</div>