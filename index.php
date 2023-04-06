<?php
    get_header( );
?>
<div class='main'></div>

<?php 
the_title( "<h1>", "</h1>" );
the_content(  );
   
   ?>

<div class='container'>

    <?php
    $fields = get_field_objects();

    if( $fields ): ?>
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
                  

</div>

  

<?php
    get_footer( );
?>