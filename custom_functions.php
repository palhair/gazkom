<?php function the_group_fields($name_group_fields, $class_group_fields) {

$custom_fields = get_field_objects();

if(is_array($custom_fields)){
    foreach( $custom_fields as $field ): 
        if($field['name'] === $name_group_fields): ?>
            <div class = <?php echo $class_group_fields?>>
                 <?php foreach ($field['value'] as $line): ?>
                    <span><?php echo $line ?></span>
                    <?php endforeach;?> 
                </div><?php
     endif;
    endforeach; 
    
}

}
?>