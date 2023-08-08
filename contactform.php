<?php



if ( ! class_exists( 'Contact_Form' ) ):

    class Contact_Form {

        public $settings = [
            'field_wrap_start'  => '<div class="contact-form__field">', // Обёртка поля начало
            'field_wrap_end'    => '</div>',                            // Обёртка поля конец
            'success_text'      => '<p>Мы скоро с вами свяжемся по тем контактным данным, которые вы указали.</p>',     // Сообщение об успешной отправке
            'submit_btn_text'   => 'Отправить',               // Надпись на кнопке "отправить"
        ];

        public $fields;

        public $admin_email;

        protected $nonce_action = 'wpgid_nonce_action';
        protected $nonce_name = 'wpgid_contactform_nonce';

        protected $errors;

        protected $success = false;
        

        public function __construct() {
            add_shortcode( 'contactform', [ $this, 'display_contact_form' ] );  // Регистрация шорткода
            add_action( 'init', array( $this, 'send_contact_form' ) );          // Подключение обработчика формы

            $this->admin_email = get_option( 'admin_email' );                   // Email администратора сайта (на него будут отправляться письма)
        }

        // Отображение формы
        public function display_contact_form() {

            $out = '';
            $out .= '<div class="contact-form"> ';

            if ( $this->success ) {
                $out .= '<div class="contact-form__success">';
                $out .= $this->settings['success_text'];
                $out .= '</div>';
            }
    
            if ( ! empty( $this->errors ) ) {
                $out .= '<ul class="contact-form__errors">';
                foreach ( $this->errors as $error ) {
                    $out .= '<li>' . $error . '</li>';
                }
                $out .= '</ul>';
            }
    
            if ( ! $this->success ) {
                $out .= '<form action="" method="post">';
                $out .= '<input type="email" name="email" style="display:none;">';
                $out .= $this->render_fields();
                $out .= '<input type="hidden" name="fields" value="' . base64_encode( json_encode($this->get_fields()) ) . '">';
                $out .= wp_nonce_field( $this->nonce_action, $this->nonce_name, true, false );
                $out .= '<input type="hidden" name="redirect_url" value="' . get_the_permalink() . '">';
                $out .= '<input type="hidden" name="submitted" value="submitted">';
                $out .= '<div ><p>Пункты отмеченные * обязательные для заполнения</p></div>';
                $out .= '<div class="contact-form__field">';
                $out .= '<button type="submit" class="contact-form__submit reqPrice">'. $this->settings['submit_btn_text'] .'</button>';
                $out .= '</div>';
                $out .= '</form>';
            }

            $out .= '</div>';

            return $out;

        }

        // Обработка формы
        public function send_contact_form() {
               
            // Check spam
            if ( ! empty( $_POST['email'] ) ) {
                return;
            }
            
            $body = '';
            
            if ( ! empty( $_POST['submitted'] ) && $_POST['submitted'] == 'submitted' ) {
    
                $valid = wp_verify_nonce( $_POST[ $this->nonce_name ], $this->nonce_action );
                
                if ( $valid ) {
    
                    $fields = json_decode( base64_decode( $_POST['fields'] ), true );
                    
                    if( empty($fields) ) {
                        $this->errors[] = 'Извините, невозможно отправить форму.';
                    } else {
                        foreach ( $fields as $name => $field ) {
    
                            $field_name = $name;
                            if ( ! empty( $field['placeholder'] ) ) $field_name = $field['placeholder'];
                            if ( ! empty( $field['label'] ) ) $field_name = $field['label'];
        
                            if ( isset( $field['required'] ) && $field['required'] == 'required' && empty( $_POST[ $name ] ) ) {
                                $this->errors[] = 'Заполните поле ' . $field_name;
                            }
        
                            if ( ! empty( $name ) ) {
        
                                $body .= $field_name . ': ' . PHP_EOL . sanitize_text_field( $_POST[ $name ] ) . PHP_EOL . PHP_EOL;
        
                            }
                        }
        
                        $name = ( ! empty( $_POST['callback_name'] ) ) ? sanitize_text_field( $_POST['callback_name'] ) : '' ;
                        $from_email = ( ! empty( $_POST['callback_email'] ) ) ? sanitize_email( $_POST['callback_email'] ) : '' ;
                        
                        $subject = 'Сообщение с сайта ' . get_site_url();

                        if ( ! is_email( $from_email ) ) {
                            $this->errors[] = 'Неверный e-mail формат';
                        }
        
                        $body .= 'Сообщение от ' . get_site_url();
        
                        if ( empty( $this->errors ) ) {
        
                            $mail_from = $from_email;
                            $headers = 'From: '.$name.' <'.$mail_from.'>' . "\r\n" . 'Reply-To: ' . $from_email;
        
                            wp_mail( $this->admin_email, $subject, $body, $headers );
        
                            $this->success = true;
        
                        }
                    }    
                }
            }
            


        }

        // Преобразование полей в HTML формат
        public function render_fields(){
            $out = '';
            $fields = $this->get_fields();
            foreach ( $fields as $name => $field) {

                $attributes = 'name='. $name;

                $required = ($field['required'] === 'required') ? '<span class="required-field"> *</span>' : '';

                
                $label = ( ! empty($field['label']) ) ? '<label for="' . $field['id'] . '" >' . $field['label'] . $required . ' </label>' : '';

                
                

                foreach ( $field as $attr => $value ) {
                    if( $attr == 'type' && $value == 'textarea' ) {
                        unset($value);
                    }
                    if ( ! empty( $value ) ) {
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }

                if($field['type'] == 'textarea'){
                    $out .= $this->settings['field_wrap_start'] . $label .'<textarea '. $attributes .'></textarea>'. $this->settings['field_wrap_end'];
                }else {
                    $out .= $this->settings['field_wrap_start'] . $label .'<input '. $attributes .' value=""/>'. $this->settings['field_wrap_end'];
                }
                

            }
            return $out;
        }

        // Массив полей
        public function get_fields() {
            $fields = apply_filters( 'contactform_fields', [
                'callback_name' => [
                    'type'          => 'name',
                    'label'         => 'Ваше Имя',
                    'required'      => 'required',
                    'id'            => 'callback-name',
                    'class'         => 'contact-form__name',
                    'placeholder'   => '',
                ],
                'callback_email' => [
                    'type'          => 'email',
                    'label'         => 'E-mail',
                    'required'      => 'required',
                    'id'            => 'callback-emai',
                    'class'         => 'contact-form__email',
                    'placeholder'   => '',
                ],
                'callback_telephone' => [
                    'type'          => 'tel',
                    'label'         => 'Телефон',
                    'required'      => '',
                    'id'            => 'callback-telephone',
                    'class'         => 'contact-form__subject',
                    'placeholder'   => '',
                ],
                'callback_message' => [
                    'type'          => 'textarea',
                    'label'         => 'Оборудование',
                    'required'      => 'required',
                    'id'            => 'callback-message',
                    'class'         => 'contact-form__message',
                    'placeholder'   => '',
                    'rows'          => '3',
                    'cols'          => '30',
                ],
            ]);
            return $fields;
        }

    } // end class Contact_Form    

endif;
new Contact_Form;