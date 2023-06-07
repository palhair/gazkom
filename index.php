
<?php get_header( );?>

<article class='main'>

    <?php the_title( "<h1>", "</h1>" ); ?>
    <?php the_content(); ?>

    <div class="product-card-top">
        <div class='product-images'>
            <?php the_post_thumbnail( array(280, 280), "class=main-img" );?>

            <div class="thumbnail-block">
                <?php the_post_thumbnail( 'thumbnail' );?>
                <?php the_field('additional_product_imges'); ?>

            </div>

        </div>

        <div class='product-params'>
            <?php require get_template_directory() . '/custom_functions.php'; 
            
            the_group_fields('param_1', 'product-param'); 
            the_group_fields('param_2', 'product-param'); 
            the_group_fields('param_3', 'product-param'); 
            the_group_fields('param_4', 'product-param'); 
            ?>
            <button class="button reqPrice">Узнать цену</button>
        </div>
    </div>

    <?php $fields = get_field_objects();?>
    
    <?php if( $fields ): ?>
        <div class='nav-tabs'>
            <ul class='tabs-headers'>
                <?php foreach( $fields as $field ): 
                if($field['value'] !== '' and $field['parent'] === 20){
                        ?>
                        <li><?php echo $field['label']; ?></li>
                    <?php 
                        }
                        ?>
                    
                <?php endforeach; ?>
                
            </ul>
           
            <div class='horizontal-line'></div>
            <div class='tabs-contents'>
                <?php foreach( $fields as $field ): 
                if($field['value'] !== '' and $field['parent'] == 20){
                        ?>
                        <div ><?php echo $field['value']; ?></div>
                        <?php
                    }?>                   

                <?php endforeach; ?>    

            
            </div>
        </div>    
    <?php endif; ?>
                    

    
</article>
<?php dynamic_sidebar('sidebar-catalog') ;?>
<?php
    get_footer( );
?>