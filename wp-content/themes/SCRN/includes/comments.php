<?php if ( ! function_exists( 'vp_comment' ) ) :
function vp_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="comment comment-body clearfix">
		<div class="left_comment">
			<?php echo get_avatar($comment, 93); ?>
		</div>
				
		<div class="right_comment">
	        <p class="user-name"><?php comment_author_link();?></p>
	        <p class="user-date"><?php echo(get_comment_date('F jS, Y G:i')) ?></p>
          	<p class="user-text">
	          	<?php echo get_comment_text() . '<br />';
	          	$reply_link = get_comment_reply_link( array_merge( $args, array('reply_text' => esc_attr__('Reply','SCRN'),'depth' => $depth, 'max_depth' => $args['max_depth'])) ); 
	          	if ( $reply_link ) echo $reply_link;
	          	edit_comment_link( __( '(Edit)', 'SCRN' ), ' ' );?>
         	</p>
         	<?php if ($comment->comment_approved == '0') : ?>
				<p>
					<em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','SCRN') ?></em>
				</p>
				<br />
			<?php endif; ?>
        </div>
			
	</div> <!-- end comment-body-->
<?php }
endif; ?>