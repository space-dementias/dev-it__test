<?php
/*
Plugin Name: Movie
Description: Declares a plugin that will create a custom post type displaying movies.
Version: 1.0
Author: Victoria Dmytrenko
Author URI: https://t.me/space_dementias
*/
?>

<?php 
function wptp_create_post_type() {
  $labels = array(
    'name' => __( 'Фильмы' ),
    'singular_name' => __( 'Фильмы' ),
    'add_new' => __( 'Новый фильм' ),
    'add_new_item' => __( 'Добавить новый' ),
    'edit_item' => __( 'Изменить фильм' ),
    'new_item' => __( 'Новый фильм' ),
    'view_item' => __( 'Посмотреть' ),
    'search_items' => __( 'Найти' ),
    'not_found' =>  __( 'Фильмы не найдены' ),
    'not_found_in_trash' => __( 'Удаленных фильмов не найдено' ),
    );
  $args = array(
    'labels' => $labels,
    'has_archive' => true,
    'public' => true,
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array(
      'title',
      'editor',
      'excerpt',
      'custom-fields',
      'thumbnail'
      ),
    );
  register_post_type( 'movie', $args );
}
add_action( 'init', 'wptp_create_post_type' );

function wptp_register_taxonomy() {
  register_taxonomy( 'movie_genre', 'movie',
    array(
      'labels' => array(
        'name'              => 'Жанры',
        'singular_name'     => 'Жанр фильма',
        'search_items'      => 'Найти по жанру',
        'all_items'         => 'Все жанры',
        'edit_item'         => 'Редактировать жанр',
        'update_item'       => 'Обновить жанр',
        'add_new_item'      => 'Добавить новый жанр',
        'new_item_name'     => 'Добавить новый жанр',
        'menu_name'         => 'Жанр фильма',
        ),
      'hierarchical' => true,
      'sort' => true,
      'args' => array( 'orderby' => 'term_order' ),
      'show_admin_column' => true
      )
    );
  register_taxonomy( 'country', 'movie',
    array(
      'labels' => array(
        'name'              => 'Страна',
        'singular_name'     => 'Страна',
        'search_items'      => 'Найти по стране',
        'all_items'         => 'Все страны',
        'edit_item'         => 'Редактировать страну',
        'update_item'       => 'Обновить страну',
        'add_new_item'      => 'Добавить новую страну',
        'new_item_name'     => 'Добавить новую страну',
        'menu_name'         => 'Страна',
        ),
      'hierarchical' => true,
      'sort' => true,
      'args' => array( 'orderby' => 'term_order' ),
      'show_admin_column' => true
      )
    );
  register_taxonomy( 'year', 'movie',
    array(
      'labels' => array(
        'name'              => 'Год',
        'singular_name'     => 'Год выпуска',
        'search_items'      => 'Найти по году выпуска',
        'all_items'         => 'Все года',
        'edit_item'         => 'Редактировать год',
        'update_item'       => 'Обновить год',
        'add_new_item'      => 'Добавить год',
        'new_item_name'     => 'Добавить год',
        'menu_name'         => 'Год',
        ),
      'hierarchical' => true,
      'sort' => true,
      'args' => array( 'orderby' => 'term_order' ),
      'show_admin_column' => true
      )
    );
  register_taxonomy( 'actors', 'movie',
    array(
      'labels' => array(
        'name'              => 'Актер',
        'singular_name'     => 'Имя актера',
        'search_items'      => 'Найти по актерам',
        'all_items'         => 'Все актеры',
        'edit_item'         => 'Редактировать актера',
        'update_item'       => 'Обновить актера',
        'add_new_item'      => 'Добавить нового актера',
        'new_item_name'     => 'Добавить нового актера',
        'menu_name'         => 'Актер',
        ),
      'hierarchical' => true,
      'sort' => true,
      'args' => array( 'orderby' => 'term_order' ),
      'show_admin_column' => true
      )
    );
}
add_action( 'init', 'wptp_register_taxonomy' );


add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
    add_meta_box( 'custom_fields', 'Дополнительные поля', 'custom_fields', 'movie', 'normal', 'high'  );
}


function custom_fields( $post ){
    ?>
    <p><input type="number" name="extra[price]" value="<?php echo get_post_meta($post->ID, 'price', 1); ?>" style="width:250px" placeholder="Стоимость сеанса"></p>
    <p><input type="date" name="extra[date]" value="<?php echo get_post_meta($post->ID, 'date', 1); ?>" style="width:250px" placeholder="Дата выхода в прокат"></p>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

add_action( 'save_post', 'my_extra_fields_update', 0 );

function my_extra_fields_update( $post_id ){
    if (
           empty( $_POST['extra'] )
        || ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
        || wp_is_post_autosave( $post_id )
        || wp_is_post_revision( $post_id )
    )
        return false;

    $_POST['extra'] = array_map( 'sanitize_text_field', $_POST['extra'] ); 
    foreach( $_POST['extra'] as $key => $value ){
        if( empty($value) ){
            delete_post_meta( $post_id, $key );
            continue;
        }

        update_post_meta( $post_id, $key, $value );
    }

    return $post_id;
}