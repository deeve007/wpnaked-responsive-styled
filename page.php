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
					echo '<img srcset="'.$smallurl.' 900w, '.$url.' 1000w" alt="'.$alt_text.'" class="banner-image" />';
				} ?>

				
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			
		<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?> 