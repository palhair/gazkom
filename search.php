<?php get_header(); ?>
<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );
    // The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        _e("<h2 >Результаты запроса: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                 <?php
        }
    }else{
?>
        <h2>По данному запросу ничего не найдено</h2>
        <div class="alert alert-info">
          <p>Извините, но ничего не соответствует вашим критериям поиска. Пожалуйста, попытайтесь снова с другими ключевыми словами.</p>
          
        </div>
<?php } ?>


<?php get_footer(); ?>