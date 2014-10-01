<?php get_header(); ?> 

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		
			<article class="unit span-8">
				<?php // check if the post has a Post Thumbnail assigned to it.
				if ( has_post_thumbnail() ) {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'page-banner' );
					$smallthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'page-banner-small' );
					$url = $thumb[0];
					$smallurl = $smallthumb[0];
					$alt_text = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
					
					// picturefill responsive images
					echo '<img srcset="'.$smallurl.' 500w, '.$url.' 800w" alt="'.$alt_text.'" />';
				} ?>
				
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="entry-meta">
					<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_date(); ?></time>
					<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
				</div><!-- .entry-meta -->
				<?php the_content(); ?>
				
				<?php wp_link_pages(); ?>
				<?php the_tags( '<p class="entry-tags">Tags: ', ', ', '</p>' ); ?>
				
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<footer class="author">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
						<h3>About <?php echo get_the_author() ; ?></h3>
						<p><?php the_author_meta( 'description' ); ?></p>
					</footer>
				<?php endif; ?>
				
				<div class="pagination">
					<span class="next-posts"><?php next_post_link('%link', '&laquo; Newer post'); ?></span>
					<span class="prev-posts"><?php previous_post_link('%link', 'Older post &raquo;'); ?></span>
				</div>
				
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>
			</article>
			
		<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?> 