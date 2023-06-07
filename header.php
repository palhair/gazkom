
<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body>
        <div class='box-shadow'></div>
        <div class='container'>
            <header>

                <div class='company-info'>
                    <?php the_custom_logo(  ); ?>
                    <div class='contacts-search-container'>
                        <div class="contacts">
                            <div class='phone'>
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#077DC2" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.4401 13C19.2201 13 18.9901 12.93 18.7701 12.88C18.3246 12.7818 17.8868 12.6515 17.4601 12.49C16.9962 12.3212 16.4862 12.33 16.0284 12.5146C15.5706 12.6992 15.1972 13.0466 14.9801 13.49L14.7601 13.94C13.7861 13.3982 12.8911 12.7252 12.1001 11.94C11.3149 11.149 10.6419 10.254 10.1001 9.28L10.5201 9.00001C10.9635 8.78292 11.3109 8.40954 11.4955 7.9517C11.6801 7.49386 11.6889 6.98392 11.5201 6.52001C11.3613 6.09243 11.231 5.6548 11.1301 5.21001C11.0801 4.99001 11.0401 4.76001 11.0101 4.53001C10.8887 3.82563 10.5197 3.18775 9.96972 2.73124C9.41972 2.27474 8.7248 2.02961 8.0101 2.04001H5.0101C4.57913 2.03596 4.15235 2.12482 3.75881 2.30054C3.36527 2.47625 3.01421 2.7347 2.72953 3.05829C2.44485 3.38187 2.23324 3.763 2.10909 4.17572C1.98494 4.58844 1.95118 5.02306 2.0101 5.45001C2.54284 9.63939 4.45613 13.5319 7.44775 16.5126C10.4394 19.4934 14.3388 21.3925 18.5301 21.91H18.9101C19.6475 21.9111 20.3595 21.6405 20.9101 21.15C21.2265 20.867 21.4792 20.5202 21.6516 20.1323C21.8239 19.7445 21.9121 19.3244 21.9101 18.9V15.9C21.8979 15.2054 21.6449 14.5366 21.1944 14.0077C20.744 13.4788 20.1239 13.1226 19.4401 13ZM19.9401 19C19.9399 19.142 19.9095 19.2823 19.8509 19.4116C19.7923 19.5409 19.7068 19.6563 19.6001 19.75C19.4887 19.847 19.3581 19.9194 19.2168 19.9625C19.0755 20.0056 18.9267 20.0184 18.7801 20C15.035 19.5198 11.5563 17.8065 8.89282 15.1303C6.2293 12.4541 4.53251 8.96734 4.0701 5.22001C4.05419 5.07352 4.06813 4.92534 4.1111 4.7844C4.15407 4.64346 4.22517 4.51269 4.3201 4.40001C4.41381 4.29334 4.52916 4.20785 4.65848 4.14922C4.7878 4.0906 4.92812 4.06019 5.0701 4.06001H8.0701C8.30265 4.05483 8.52972 4.13088 8.71224 4.27508C8.89476 4.41927 9.02131 4.62258 9.0701 4.85001C9.1101 5.12334 9.1601 5.39334 9.2201 5.66001C9.33562 6.18715 9.48936 6.70518 9.6801 7.21001L8.2801 7.86001C8.1604 7.91493 8.05272 7.99295 7.96326 8.0896C7.87379 8.18625 7.8043 8.29962 7.75877 8.4232C7.71324 8.54678 7.69257 8.67814 7.69795 8.80973C7.70332 8.94132 7.73464 9.07055 7.7901 9.19C9.2293 12.2728 11.7073 14.7508 14.7901 16.19C15.0336 16.29 15.3066 16.29 15.5501 16.19C15.6748 16.1454 15.7894 16.0765 15.8873 15.9872C15.9851 15.8979 16.0643 15.7901 16.1201 15.67L16.7401 14.27C17.2571 14.4549 17.7847 14.6085 18.3201 14.73C18.5868 14.79 18.8568 14.84 19.1301 14.88C19.3575 14.9288 19.5608 15.0553 19.705 15.2379C19.8492 15.4204 19.9253 15.6475 19.9201 15.88L19.9401 19Z" />
                                </svg>
                                <a href="tel:8(800)775-98-23">8(800)775-98-23</a>
                            </div>
                            
                            <div class="email">       
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#077DC2" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5C3.45228 5 3 5.45228 3 6V18C3 18.5477 3.45228 19 4 19H20C20.5477 19 21 18.5477 21 18V6C21 5.45228 20.5477 5 20 5H4ZM1 6C1 4.34772 2.34772 3 4 3H20C21.6523 3 23 4.34772 23 6V18C23 19.6523 21.6523 21 20 21H4C2.34772 21 1 19.6523 1 18V6Z" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.18085 5.42653C1.49757 4.97408 2.1211 4.86405 2.57355 5.18076L12.0001 11.7793L21.4266 5.18076C21.8791 4.86405 22.5026 4.97408 22.8193 5.42653C23.136 5.87898 23.026 6.50251 22.5735 6.81923L12.5735 13.8192C12.2292 14.0603 11.7709 14.0603 11.4266 13.8192L1.42662 6.81923C0.974174 6.50251 0.864139 5.87898 1.18085 5.42653Z" />
                                </svg>
                                <a href="mailto:gaz@gazkom.su">gaz@gazkom.su</a>
                            </div>
                            
                        </div>
                        <?php get_search_form(); ?>
                    </div>
                    <div class="company-name">
                        <span>Промышленное газовое оборудование</span>
                        <span>ООО «Газовая комплектация»</span>
                    </div>
                </div>

                <div class='navbar'>
                    <?php wp_nav_menu( [                    
                    'menu'            => 'main',
                    'container'       => 'nav',
                    'menu_class'      => 'header-nav',
                    'items_wrap'      => '<ul  class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    ] );?>

                    <button class="button order">Оставить заявку</button>
                </div>


                
            </header>
            <?php 
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<div class="yoast-breadcrumbs">', '</div>' );
                    }; 
                ?>
           