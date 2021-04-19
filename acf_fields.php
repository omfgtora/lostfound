<?php
if( !function_exists('acf_add_local_field_group') ) return;

$acf_fields = [
  'key' => 'lostfound-form-groups',
  'title' => 'Lost and Found Pets Fields',
  'fields' => [
    [
      'key' => 'field_6071010a63a70',
      'label' => 'Lost/Found',
      'name' => 'lost_found',
      'type' => 'radio',
      'instructions' => '',
      'required' => 1,
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
      'choices' => [
        'Lost' => 'Lost',
        'Found' => 'Found',
      ],
      'allow_null' => 0,
      'other_choice' => 0,
      'default_value' => 'Lost',
      'layout' => 'horizontal',
      'return_format' => 'value',
      'save_other_choice' => 0,
    ],
    [
      'key' => 'field_6071013f63a71',
      'label' => 'Location',
      'name' => 'location',
      'type' => 'text',
      'instructions' => 'Location where the pet was found',
      'required' => 1,
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_6071016363a72',
      'label' => 'Date Lost/Found',
      'name' => 'date',
      'type' => 'date_picker',
      'instructions' => '',
      'required' => 1,
      'display_format' => 'F j, Y',
      'return_format' => 'Ymd',
      'first_day' => 0,
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_60710a6663a73',
      'label' => 'Type of Pet',
      'name' => 'pet_type',
      'type' => 'taxonomy',
      'instructions' => '',
      'required' => 1,
      'taxonomy' => 'pet-type',
      'allow_terms' => ['cat', 'dog'],
      'field_type' => 'select',
      'return_format' => 'slug',
      'ui' => 0,
      'multiple' => 0,
      'allow_null' => 0,
      'add_term' => 1,
      'save_terms' => 1,
      'load_terms' => 1,
      'ajax' => 1,
      'placeholder' => '',
      'layout' => '',
      'toggle' => 1,
      'allow_custom' => 1,
      'other_choice' => 1,
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_60710abf63a74',
      'label' => 'Name',
      'name' => 'name',
      'type' => 'text',
      'instructions' => 'Your name',
      'required' => 1,
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_60710ad063a75',
      'label' => 'Phone',
      'name' => 'phone',
      'type' => 'text',
      'instructions' => 'Your Phone Number',
      'required' => 1,
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_60710b0763a76',
      'label' => 'Email',
      'name' => 'email',
      'type' => 'email',
      'instructions' => 'Your Email',
      'required' => 0,
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_60710b1663a77',
      'label' => 'Description',
      'name' => 'description',
      'type' => 'textarea',
      'instructions' => '',
      'required' => 1,
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '',
      'new_lines' => '',
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
    [
      'key' => 'field_60710b2c63a78',
      'label' => 'Photo',
      'name' => 'photo',
      'type' => 'image',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'return_format' => 'object',
      'preview_size' => 'medium',
      'insert' => 'append',
      'library' => 'all',
      'mime_types' => 'jpg,jpeg,png,gif',
      'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
      ],
    ],
  ],
  'location' => [
    [
      [
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'lostfound',
      ],
    ],
  ],
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'left',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
];

acf_add_local_field_group($acf_fields);