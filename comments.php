<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if(!empty($post->post_password)) : ?>  
    <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>  
    <?php endif; ?>  
<?php endif; ?>  
 
<div class="comments-area"> 

	<?php // Display current comments ?>
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'twentythirteen' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>
		<ol class="comments-list">
			<?php wp_list_comments(); ?>
		</ol>
	<?php endif; // have_comments() ?>

	<?php paginate_comments_links(); ?>

	<?php // Display comment form ?>
	<?php comment_form(
		array(
			'fields' => apply_filters( 'comment_form_default_fields', array(
				
					'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Your name *' ) . '" /></p>',
					
					'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Your email *' ) . '" /></p>',
					
					'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Your website' ) . '" /></p>'
				
				) ),	
			'comment_field' => '<p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Let me know what you have to say..."></textarea></p>',
			'comment_notes_after' => ''
		)
	); ?>

</div>