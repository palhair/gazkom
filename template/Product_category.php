<?php
/*
Template Name: Product_category_page

*/

?>

<?php get_header(); ?>

<div class='main'>

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
                <div class='subcategory_item'>
                    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                            
                            <div class='product_items'>
                                <a href="<?php the_permalink() ?>">

                                <?php the_post_thumbnail('product-thumb');
                                if(! get_the_post_thumbnail_url()): ?>
                                    <img src=<?php echo get_template_directory_uri() . "/images/undefined.jpg" ?>>
                                <?php endif ?>
                                
                                <span class='item-title'><?php the_title_attribute(); ?></span>
                                
                                    <?php $fields = get_field_objects(); ?>

                                    <?php foreach( $fields as $field ):?> 
                                        <?php if($field['name'] === 'product_card_description'): ?>
                                                <div class='product_card_description'>
                                                    <?php foreach ($field['value'] as $line): ?>
                                                        <span><?php echo $line ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                        <?php endif ?>
                                    <?php endforeach; ?> 

                                </a>   
                            </div>
                    <?php endwhile; ?>
                </div>   

                <?php endif; wp_reset_query(); ?>
                

    <?php the_content(); ?>
</div>
<?php  get_footer(); ?>
