<?php get_header(); ?> 

<section class="unit span-8">

	<?php if ( have_posts() ) : ?>
		
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		
			<article <?php post_class(); ?>>
				<h2 class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-meta">
					<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_date(); ?></time>
					<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
				</div><!-- .entry-meta -->
				<?php the_excerpt(); ?>
			</article>
			
		<?php endwhile; ?>
		
		<?php if (show_posts_nav()) : ?>
		<div class="pagination">
			<?php if ( get_previous_posts_link() ) { ?>
				<span class="next-posts"><?php previous_posts_link('&laquo; Newer posts') ?></span>
			<?php } ?>
			<?php if ( get_next_posts_link() ) { ?>
				<span class="prev-posts"><?php next_posts_link('Older posts &raquo;') ?></span>
			<?php } ?>
		</div>
		<?php endif; ?>
		
	<?php else : ?>
		<h2>Sorry, nothing to display</h2>
	<?php endif; ?>
	
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?> 