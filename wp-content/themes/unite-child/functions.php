<?php  

add_shortcode( 'last_movies', 'five_movies' );

function five_movies( $atts ) {
    global $post;
    $args = array('post_type' => 'movie', 'posts_per_page' => 5,'orderby' => 'date');
    $query = get_posts($args);

    foreach( $query as $post ){ setup_postdata($post);
        ?>
        <div class="col-md-6">
            <!-- title -->
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <!-- description -->
            <div class="item-description"><?php the_excerpt(); ?></div>
            
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

            <!-- price -->
            <br><label><span class="glyphicon glyphicon-euro"> </span> Стоимость: <?php echo get_post_meta($post->ID, 'price', 1); ?></label>
            
            <!-- date -->
            <br><label><span class="glyphicon glyphicon-calendar"> </span> Дата выхода в прокат: <?php echo get_post_meta($post->ID, 'date', 1); ?></label>

        </div>
        <?php
    }
}