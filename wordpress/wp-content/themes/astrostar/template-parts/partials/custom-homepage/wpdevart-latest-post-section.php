<div class="wpdevart-homepage-title-description">
    <?php if (!empty(get_theme_mod( 'wpdevart_astrostar_custom_homepage_latest_post_desctiption' ))) { ?>
        <div class="wpdevart-custom-desctiption"><?php echo esc_html( get_theme_mod( 'wpdevart_astrostar_custom_homepage_latest_post_desctiption' ) ); ?></div>
    <?php }
    if (!empty(get_theme_mod( 'wpdevart_astrostar_custom_homepage_latest_post_title' ))) { ?>
        <div class="wpdevart-custom-title"><h3 class="wpdevart-custom-title-content"><?php echo esc_html( get_theme_mod( 'wpdevart_astrostar_custom_homepage_latest_post_title' ) ); ?></h3></div>
    <?php } ?>
</div>

<div class="wpdevart-homepage-posts-section">
<div class="wpdevart-homepage-post-container">
	<?php 
	$the_query = new WP_Query( array (
	'posts_per_page' => esc_html( get_theme_mod( 'wpdevart_astrostar_custom_homepage_number_of_latest_posts' ) ),
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'post__not_in' => get_option( 'sticky_posts' )
	));
	if ( $the_query->have_posts() ) :
	  while ( $the_query->have_posts() ) : $the_query->the_post();
	?>

	<div class="wpdevart-homepage-posts-content">
			<?php if (has_post_thumbnail() ) { ?> 
				<div class="wpdevart-images-hover-effect"><a href="<?php the_permalink(); ?>"> <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_astrostar_posts_list_images_hover_effect' ) ); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" /></div></a></div>
			<?php } else if ( get_theme_mod( 'wpdevart_astrostar_blog_archive_display_default_featured_image' ) == '1' ) { ?>
				<div class="wpdevart-images-hover-effect"><a href="<?php the_permalink(); ?>"> <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_astrostar_posts_list_images_hover_effect' ) ); ?>"><img src="<?php echo esc_url(get_theme_file_uri('/images/wpdevart-no-image.jpg')); ?>" /></div></a></div>
			<?php } ?>
			<div class="wpdevart-home-latest-posts-list-title"><h5 class="wpdevart-home-latest-post-title"><a href="<?php the_permalink(); ?>">
			<?php if( empty( $post->post_title ) ) { echo esc_html__( 'No Title', 'astrostar'); } else { echo esc_html(wp_trim_words(get_the_title(), 3)); } ?>
			</a></h5></div>
			<span class="wpdevart-home-latest-post-date"><?php echo esc_html(get_the_date('F j, Y')); ?></span>
			<div class="wpdevart-home-latest-post-text"><p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p></div>
			<span class="wpdevart-home-latest-post-read-more"><a href="<?php the_permalink(); ?>"><?php echo esc_html("Read More"); ?><svg width="16" height="19" class="wpdevart-home-arrow-right" x="0px" y="0px" viewBox="0 0 24 10" enable-background="new 0 0 24 10" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z" fill-rule="nonzero"/></svg></a></span>
	</div>

		<?php endwhile; wp_reset_postdata(); ?>
	<?php 
	?>

	<?php else : ?>
	<div class="wpdevart-homepage-posts-content">
		  <div><a href="<?php echo esc_url( home_url( 'wp-admin/post-new.php' ) ); ?>"> <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_astrostar_posts_list_images_hover_effect' ) ); ?>"><img src="<?php echo esc_url(get_theme_file_uri('/images/banner-homepage-image-1.jpg')); ?>" /></div></a></div>
		  <div class="wpdevart-home-latest-posts-list-title"><h5 class="wpdevart-home-latest-post-title"><a href="<?php echo esc_url( home_url( 'wp-admin/post-new.php' ) ); ?>"><?php echo esc_html__('Demo Post', 'astrostar'); ?></a></h5></div>
		  <div class="wpdevart-home-latest-post-text"><p><?php echo esc_html__( 'These are just demo posts. Once you add your first post, this demo content will simply disappear.', 'astrostar'); ?></p></div>
	</div>
	<div class="wpdevart-homepage-posts-content">
		  <div><a href="<?php echo esc_url( home_url( 'wp-admin/post-new.php' ) ); ?>"> <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_astrostar_posts_list_images_hover_effect' ) ); ?>"><img src="<?php echo esc_url(get_theme_file_uri('/images/banner-homepage-image-1.jpg')); ?>" /></div></a></div>
		  <div class="wpdevart-home-latest-posts-list-title"><h5 class="wpdevart-home-latest-post-title"><a href="<?php echo esc_url( home_url( 'wp-admin/post-new.php' ) ); ?>"><?php echo esc_html__('Demo Post', 'astrostar'); ?></a></h5></div>
		  <div class="wpdevart-home-latest-post-text"><p><?php echo esc_html__( 'These are just demo posts. Once you add your first post, this demo content will simply disappear.', 'astrostar'); ?></p></div>
	</div>
	<div class="wpdevart-homepage-posts-content">
		  <div><a href="<?php echo esc_url( home_url( 'wp-admin/post-new.php' ) ); ?>"> <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_astrostar_posts_list_images_hover_effect' ) ); ?>"><img src="<?php echo esc_url(get_theme_file_uri('/images/banner-homepage-image-1.jpg')); ?>" /></div></a></div>
		  <div class="wpdevart-home-latest-posts-list-title"><h5 class="wpdevart-home-latest-post-title"><a href="<?php echo esc_url( home_url( 'wp-admin/post-new.php' ) ); ?>"><?php echo esc_html__('Demo Post', 'astrostar'); ?></a></h5></div>
		  <div class="wpdevart-home-latest-post-text"><p><?php echo esc_html__( 'These are just demo posts. Once you add your first post, this demo content will simply disappear.', 'astrostar'); ?></p></div>
	</div>
	<?php endif; ?>
	</div>
</div>