<?php
    get_header( );
    
    // the_content(  );
    
    
    ?>
    <p>
        <?php
            $category = get_queried_object();
            $current_cat_id = $category->term_id;
            $current_cat_name = $category->name;
            echo '<pre>'; 
            
            print_r($category); 
            echo '</pre>';
        
        ?>
    </p>
   

<?php
    get_footer( );
?>