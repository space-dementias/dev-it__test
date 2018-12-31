<?php
/**
 * @package unite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">

		<?php 
                    if ( of_get_option( 'single_post_image', 1 ) == 1 ) :
                        the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' )); 
                    endif;
                  ?>

		<h1 class="entry-title "><?php the_title(); ?></h1>
		<!-- country -->
            <?php
            $country = get_the_terms( $post->ID, 'country' );
            ?>
            <strong><span class="glyphicon glyphicon-map-marker"> </span> Страна: </strong><?php
            if( is_array( $country ) ){
                foreach( $country as $cur_term ){
                    
                    echo '<a href="'. get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a> ';
                }
            }?>

            <!-- genre -->
            <?php
            $genre = get_the_terms( $post->ID, 'movie_genre' );
             ?>
            <br><strong><span class="glyphicon glyphicon-facetime-video"> </span> Жанр: </strong><?php
            if( is_array( $genre ) ){
                foreach( $genre as $cur_term ){
                    echo '<a href="'. get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a> ';
                }
            }?>

            <!-- actors -->
            <?php
            $actors = get_the_terms( $post->ID, 'actors' );
             ?>
            <br><strong><span class="glyphicon glyphicon-user"> </span> Актеры: </strong><?php
            if( is_array( $actors ) ){
                foreach( $actors as $cur_term ){
                    echo '<a href="'. get_term_link( (int)$cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a> ';
                }
            }?>

            <!-- price -->
            <br><label><span class="glyphicon glyphicon-euro"> </span> Стоимость: <?php echo get_post_meta($post->ID, 'price', 1); ?></label>

            <!-- date -->
            <br><label><span class="glyphicon glyphicon-calendar"> </span> Дата выхода в прокат: <?php echo get_post_meta($post->ID, 'date', 1); ?></label>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'unite' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'unite' ) );

			if ( ! unite_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'unite' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
		<?php unite_setPostViews(get_the_ID()); ?>
		<hr class="section-divider">
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
