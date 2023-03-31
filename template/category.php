<?php
/*
Template Name: Category_page

*/

?>

<?php
    get_header( );
?>
<div class='main'></div>

<?php 
the_title( "<h1>", "</h1>" );



the_content();
   ?>
    <p>
        <?php
            $category = get_page_children();
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