<?php
/*
Template Name: Category_page

*/

?>

<?php get_header(); ?>
<?php dynamic_sidebar('sidebar-catalog') ;?>

<article class='main'>

    <?php the_title( "<h1>", "</h1>" ); ?>
    
    <?php
    $args = array(
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'post_parent'    => $post->ID,
            'order'          => 'ASC',
            'orderby'        => 'menu_order'
            );

    $parent = new WP_Query( $args );

    if ( $parent->have_posts() ) : ?>
        <div class='items-container'>
            <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                <div class='subcategory'>
                <a href="<?php the_permalink() ?>">
                    <?php the_post_thumbnail('product-thumb'); ?>
                    <?php if(! get_the_post_thumbnail_url()): ?>
                            <img src=<?php echo get_template_directory_uri() . "/images/undefined.jpg" ?>>
                    <?php endif ?>
                    <span><?php the_title(); ?></span>
                    
                    </a>    
                    
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; wp_reset_query(); ?>

    <div class="category-desc"><?php the_content(); ?></div>           
</article>

<?php get_footer( ); ?>