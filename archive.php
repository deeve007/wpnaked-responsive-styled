<?php get_header(); ?> 

<section class="unit span-8">

	<?php if ( have_posts() ) : ?>
		
		<?php if ( !is_category() ) { ?>
			<?php if ( is_day() ) : ?>
			<h1>Archive: <?php echo  get_the_date( 'D M Y' ); ?></h1>							
			<?php elseif ( is_month() ) : ?>
			<h1>Archive: <?php echo  get_the_date( 'M Y' ); ?></h1>	
			<?php elseif ( is_year() ) : ?>
			<h1>Archive: <?php echo  get_the_date( 'Y' ); ?></h1>	
			<?php elseif ( is_tag() ) : ?>
			<h1>Tag archive: <?php single_tag_title(); ?></h1>	
			<?php else : ?>
			<h1>Archive</h2>	
			<?php endif; ?>
		<?php } ?>
		
		<?php if ( is_category() ) { ?>
			<h1>Category: <?php echo single_cat_title( '', false ); ?></h1>
			<?php echo category_description(); ?>
		<?php } ?>
		
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