<?php

return [
    'userManagement' => [
        'title'          => 'គ្រប់គ្រងអ្នកប្រើ',
        'title_singular' => 'គ្រប់គ្រងអ្នកប្រើ',
    ],
    'permission' => [
        'title'          => 'សិទ្ធិប្រើប្រាស់',
        'title_singular' => 'សិទ្ធិប្រើប្រាស់',
        'fields'         => [
            'id'                => 'ល.រ',
            'id_helper'         => ' ',
            'group'             => 'ក្រុម',
            'group_helper'      => ' ',
            'title'             => 'ចំណងជើង',
            'title_helper'      => ' ',
            'created_at'        => 'ថ្ងៃបង្កើត',
            'created_at_helper' => ' ',
            'updated_at'        => 'ថ្ងៃប្តូរ',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'ថ្ងៃលុប',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'ច្បាប់ទាំងអស់',
        'title_singular' => 'ច្បាប់',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'ចំណងជើង',
            'title_helper'       => ' ',
            'permissions'        => 'សិទ្ធិ',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'អ្នកប្រើប្រាស់',
        'title_singular' => 'អ្នកប្រើប្រាស់',
        'fields'         => [
            'id'                       => 'ល.រ',
            'id_helper'                => ' ',
            'name'                     => 'ឈ្មោះ',
            'name_helper'              => ' ',
            'username'                 => 'User Name',
            'username_helper'          => ' ',
            'email'                    => 'អ៊ីម៉ែល',
            'email_helper'             => ' ',
            'phone_no'                 => 'ទូរស័ព្ទ',
            'phone_no_helper'          => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'ពាក្យសម្ងាត់',
            'password_helper'          => ' ',
            'password_confirmation'    => 'បញ្ជាក់ពាក្យសម្ងាត់',
            'password_confirmation_helper' => '',
            'roles'                    => 'ច្បាប់',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'ថ្ងៃបង្កើត',
            'created_at_helper'        => ' ',
            'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'ថ្ងៃដែលបានលុប',
            'deleted_at_helper'        => ' ',
            'profile_image' => 'Profile Image',
        ],
    ],
    'customerManagement' => [
      'title'          => 'គ្រប់គ្រងអតិថិជន',
      'title_singular' => 'គ្រប់គ្រងអតិថិជន',
    ],
    'customer' => [
      'title'          => 'អតិថិជន',
      'title_singular' => 'អតិថិជន',
      'fields'         => [
        'id'                       => 'ល.រ',
        'id_helper'                => ' ',
        'customer_code' => 'កូដ អតិថិជន',
        'customer_code_helper' => ' ',
        'name'                     => 'ឈ្មោះភ្ញៀវ',
        'name_helper'              => ' ',
        'sex'                     => 'ភេទ',
        'sex_helper'              => ' ',
        'age'                     => 'អាយុ',
        'age_helper'              => ' ',
        'dob'                     => 'ថ្ងៃខែឆ្នាំកំណើត',
        'dob_helper'              => ' ',
        'province_id'             => 'ខេត្ត',
        'province_id_helper'      => ' ',
        'district_id'             => 'ស្រុក',
        'district_id_helper'      => ' ',
        'commune_id'              => 'ឃុំ',
        'commune_id_helper'       => ' ',
        'village_id'              => 'ភូមិ',
        'village_id_helper'       => ' ',
        'phone_no'                => 'ទូរស័ព្ទ',
        'phone_no_helper'         => ' ',
        'register_date'           => 'ថ្ងៃខែចុះឈ្មោះ',
        'register_date_helper'    => ' ',
        'register_by'             => 'ចុះឈ្មោះដោយ',
        'register_by_helper'      => ' ',
        'photo'                   => 'រូបភាព',
        'photo_helper'            => ' ',
        'address'                 => 'អាសយដ្ឋាន',
        'address_helper'          => ' ',
        'created_at'               => 'ថ្ងៃបង្កើត',
        'created_at_helper'        => ' ',
        'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
        'updated_at_helper'        => ' ',
        'deleted_at'               => 'ថ្ងៃដែលបានលុប',
        'deleted_at_helper'        => ' ',
      ],
    ],
    'document' => [
      'title'          => 'ឯកសារ',
      'title_singular' => 'ឯកសារ',
      'fields'         => [
          'id'                       => 'ល.រ',
          'id_helper'                => ' ',
          'customer_id'              => 'ឈ្មោះភ្ញៀវ',
          'customer_id_helper'       => ' ',
          'user_id'                  => 'អ្នកបង្កើត',
          'user_id_helper'           => ' ',
          'visit_date'               => 'ថ្ងៃមកពិនិត្យ',
          'visit_date_helper'        => ' ',
          'checkout_date'            => 'ថ្ងៃចេញ',
          'checkout_date_helper'     => ' ',
          'add_service'              => 'ប្រើសេវ៉ាកម្ម',
          'add_service_helper'       => '',
          'type_date'                => 'កាលបរិច្ឆេទ',
          'type_date_helper'         => ' ',
          'address'                  => 'អាស័យដ្ឋាន',
          'address_helper'           => ' ',
          'created_at'               => 'ថ្ងៃបង្កើត',
          'created_at_helper'        => ' ',
          'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'ថ្ងៃដែលបានលុប',
          'deleted_at_helper'        => ' ',
          'detail' => 'Detail',
          'view_detail' => 'View Detail'
      ],
    ],
    'documentDetail' => [
      'fields' => [
        'service_name' => 'Service Name',
      ]
    ],
    'document_life' => [
      'title'          => 'ឯកសារ',
      'title_singular' => 'ឯកសារ',
      'fields'         => [
          'id'                       => 'ល.រ',
          'id_helper'                => ' ',
          'customer_id'              => 'អតិថិជន',
          'customer_id_helper'       => ' ',
          'document_id'              => 'ឯកសារភ្ញៀវ',
          'document_id_helper'       => ' ',
          'coltype'                  => 'អ្នកបង្កើត',
          'coltype_helper'           => ' ',
          'colfield'               => 'ថ្ងៃមកពិនិត្យ',
          'colfield_helper'        => ' ',
          'coldesr'            => 'ថ្ងៃចេញ',
          'coldesr_helper'     => ' ',
          'num'            => 'ថ្ងៃចេញ',
          'num_helper'     => ' ',
          'created_at'               => 'ថ្ងៃបង្កើត',
          'created_at_helper'        => ' ',
          'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'ថ្ងៃដែលបានលុប',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'document_life_detail' => [
      'title'          => 'ឯកសារ',
      'title_singular' => 'ឯកសារ',
      'fields'         => [
          'id'                       => 'ល.រ',
          'id_helper'                => ' ',
          'document_lives_id'        => 'ឈ្មោះភ្ញៀវ',
          'document_lives_id_helper' => ' ',
          'colfield'                 => 'ថ្ងៃមកពិនិត្យ',
          'colfield_helper'          => ' ',
          'coldesr'                  => 'ថ្ងៃចេញ',
          'coldesr_helper'           => ' ',
          'coldate'                  => 'អ្នកបង្កើត',
          'coldate_helper'           => ' ',
          'created_at'               => 'ថ្ងៃបង្កើត',
          'created_at_helper'        => ' ',
          'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'ថ្ងៃដែលបានលុប',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'labo_management' => [
      'title'          => 'Labo Managements',
      'title_singular' => 'Labo Management',
    ],
    'item_group' => [
      'title'          => 'Item Groups',
      'title_singular' => 'Item Group',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'name'                   => 'Group Name',
          'name_helper'            => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'item_type' => [
      'title'          => 'Item Types',
      'title_singular' => 'Item Type',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'name'                   => 'Type Name',
          'name_helper'            => ' ',
          'item_group_id'          => 'Item Group',
          'item_group_id_helper'   => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'item' => [
      'title'          => 'Items',
      'title_singular' => 'Item',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'item_group_id'          => 'Item Group',
          'item_group_id_helper'   => ' ',
          'item_type_id'           => 'Item Type',
          'item_type_id_helper'    => ' ',
          'item_name'           => 'Item Name',
          'item_name_helper'    => ' ',
          'normal_value'        => 'តំលៃធម្មតា',
          'normal_value_helper' => ' ',
          'min_value'           => 'តំលៃតូច',
          'min_value_helper'    => ' ',
          'max_value'           => 'តំលៃធំ',
          'max_value_helper'    => ' ',
          'numset'              => 'Numset',
          'numset_helper'       => ' ',
          'uvn'                 => 'UVN',
          'uvn_helper'          => ' ',
          'item_price'               => 'Item Price',
          'item_price_helper'        => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'bio' => [
      'title'          => 'Bios',
      'title_singular' => 'Bio',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'customer_id'            => 'Customer',
          'customer_id_helper'     => ' ',
          'document_id'            => 'Document',
          'document_id_helper'     => ' ',
          'user_id'                => 'User',
          'user_id_helper'         => ' ',
          'item_id'                => 'Item',
          'item_id_helper'         => ' ',
          'date'                => 'Date',
          'date_helper'         => ' ',
          'result'                => 'Result',
          'result_helper'         => ' ',
          'note'                => 'Note',
          'note_helper'         => ' ',
          'normal_value'                => 'Normal Value',
          'normal_value_helper'         => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'labo' => [
      'title' => "Laboratory",
    ],
    'rx' => [
      'title'          => 'Rxs',
      'title_singular' => 'Rx',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'rx_check'            => 'Check',
          'rx_check_helper'     => ' ',
          'rx_date'            => 'Rx Date',
          'rx_date_helper'     => ' ',
          'document_id'            => 'Document',
          'document_id_helper'     => ' ',
          'user_id'                => 'User',
          'user_id_helper'         => ' ',
          'rx_note'                => 'Note',
          'rx_note_helper'         => ' ',
          'doctor_order'           => 'Doctor Order',
          'doctor_order_helper'    => ' ',
          'doctor_description'        => 'Description',
          'doctor_description_helper' => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'rx_detail' => [
      'title'          => 'Rx Details',
      'title_singular' => 'Rx Detail',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'rx_id'            => 'Rx ID',
          'rx_id_helper'     => ' ',
          'result'            => 'Result',
          'result_helper'     => ' ',
          'docfile'            => 'Doc File',
          'docfile_helper'     => ' ',
          'user_id'                => 'User',
          'user_id_helper'         => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'lifesign' => [
      'title'          => 'LifeSigns',
      'title_singular' => 'LifeSign',
      'fields'         => [
          'id'                      => 'ID',
          'id_helper'               => ' ',
          'type'                    => 'ប្រភេទ',
          'type_helper'             => ' ',
          'name'                    => 'ឈ្មោះ',
          'name_helper'             => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'categoryManagement' => [
      'title'          => 'គ្រប់គ្រងប្រភេទទំនិញ',
      'title_singular' => 'គ្រប់គ្រងប្រភេទំនិញ',
    ],
    'category' => [
      'title'          => 'ប្រភេទទំនិញទាំងអស់',
      'title_singular' => 'ប្រភេទំនិញ',
      'fields'         => [
          'id'                       => 'ល.រ',
          'id_helper'                => ' ',
          'name'                     => 'ឈ្មោះប្រភេទទំនិញ',
          'name_helper'              => ' ',
          'photo'                     => 'រូបភាពក្រុម',
          'photo_helper'              => ' ',
          'created_at'               => 'ថ្ងៃបង្កើត',
          'created_at_helper'        => ' ',
          'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'ថ្ងៃដែលបានលុប',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'subcategory' => [
      'title'          => 'ប្រភេទរង',
      'title_singular' => 'ប្រភេទរង',
      'fields'         => [
          'id'                       => 'ID',
          'id_helper'                => ' ',
          'name'                     => 'ឈ្មោះប្រភេទរង',
          'name_helper'              => ' ',
          'created_at'               => 'ថ្ងៃបង្កើត',
          'created_at_helper'        => ' ',
          'updated_at'               => 'ថ្ងៃធ្វើបច្ចុប្បន្នភាព',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'ថ្ងៃដែលបានលុប',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'childcategory' => [
      'title'          => 'Child Categories',
      'title_singular' => 'Child Category',
      'fields'         => [
          'id'                       => 'ID',
          'id_helper'                => ' ',
          'name'                     => 'Name',
          'name_helper'              => ' ',
          'created_at'               => 'Created at',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated at',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted at',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'settingManagement' => [
      'title'          => 'Manage Settings',
      'title_singular' => 'Manage Setting',
    ],
    'setting' => [
      'title'          => 'Settings',
      'title_singular' => 'Setting',
      'fields'         => [
          'id'                       => 'ID',
          'id_helper'                => ' ',
          'key'                     => 'Key',
          'key_helper'              => ' ',
          'value'                    => 'Value',
          'value_helper'             => ' ',
          'usage'                   =>'Usage',
          'created_at'               => 'Created at',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated at',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted at',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'productManagement' =>[
      'title' => 'គ្របគ្រង ផលិតផល',
      'title_singular' => 'គ្របគ្រង ផលិតផល',
    ],
    'product' =>[
      'title' => 'Products',
      'title_singular' => 'Product',
      'fields' =>[
        'id' => 'ID',
        'id_helper' => ' ',
        'p_name' => 'Product Name',
        'p_name_helper' => ' ',
        'p_code' => 'Product Code',
        'p_code_helper' => ' ',
        'p_price' => 'Price',
        'p_price_helper' => ' ',
        'unit' => 'Unit',
        'unit_helper' => ' ',
        'strength' => 'Strength',
        'strength_helper' => ' ',
        'group_id' => 'Group',
        'group_id_helper' => ' ',
        'type_id' => 'Type',
        'type_id_helper' => ' ',
        'description' => 'Description',
        'country' => 'Country',
        'country_helper' => ' ',
        'image' => 'Image',
        'image_helper' => ' ',
        'status' => 'Status',
        'status_helper' => ' ',
        'created_at' => 'Created At',
        'created_at_helper' => ' ',
        'description_helper' => ' ',
        'updated_at' => 'Updated At',
        'updated_at_helper' => ' ',
        'deleted_at' => 'Deleted At',
        'deleted_at_helper' => ' ',
      ],
    ],
    'hospital' =>[
      'title' => 'Hospitals',
      'title_singular' => 'Hospital',
      'fields' =>[
        'id'        => 'ID',
        'id_helper' => ' ',
        'room_no'   => 'Room Number',
        'room_no_helper' => ' ',
        'h_date'    => 'H Date',
        'h_date_helper' => ' ',
        'h_note'    => 'Note',
        'h_note_helper' => ' ',
        'status' => 'Status',
        'status_helper' => ' ',
        'created_at' => 'Created At',
        'created_at_helper' => ' ',
        'description_helper' => ' ',
        'updated_at' => 'Updated At',
        'updated_at_helper' => ' ',
        'deleted_at' => 'Deleted At',
        'deleted_at_helper' => ' ',
      ],
    ],
    'room' => [
      'title'          => 'Rooms',
      'title_singular' => 'Room',
      'fields'         => [
          'id'                     => 'ID',
          'id_helper'              => ' ',
          'room_no'                   => 'Room Number',
          'room_no_helper'            => ' ',
          'created_at'               => 'Created At',
          'created_at_helper'        => ' ',
          'updated_at'               => 'Updated At',
          'updated_at_helper'        => ' ',
          'deleted_at'               => 'Deleted At',
          'deleted_at_helper'        => ' ',
      ],
    ],
    'ht' =>[
      'title' => 'Hospital Treatments',
      'title_singular' => 'Hospital Treatment',
      'fields' =>[
        'id'              => 'ID',
        'id_helper'       => ' ',
        'hospital_id'     => 'Hospital',
        'hospital_id_helper' => ' ',
        'h_date'             => 'Date',
        'dd_helper'      => ' ',
        'h_time'             => 'Time',
        'tt_helper'      => ' ',
        'product_id'         => 'Medicine',
        'product_id_helper'  => ' ',
        'qty'            => 'Qty',
        'qty_helper'     => ' ',
        'duration'         => 'Duration',
        'duration_helper'  => ' ',
        'user_id'         => 'User',
        'user_id_helper'  => ' ',
        'status' => 'Status',
        'status_helper' => ' ',
        'using' => 'Using',
        'how_to_use' => 'How to Use',
        'created_at' => 'Created At',
        'created_at_helper' => ' ',
        'description_helper' => ' ',
        'updated_at' => 'Updated At',
        'updated_at_helper' => ' ',
        'deleted_at' => 'Deleted At',
        'deleted_at_helper' => ' ',
      ],
    ],
    'hnote' =>[
      'title' => 'Hospital Notes',
      'title_singular' => 'Hospital Note',
      'fields' =>[
        'id'              => 'ID',
        'id_helper'       => ' ',
        'hospital_id'     => 'Hospital',
        'hospital_id_helper' => ' ',
        'date'            => 'Date',
        'date_helper'     => ' ',
        'dd'              => 'Description',
        'dd_helper'       => ' ',
        'mob'             => 'Medical Observation',
        'mob_helper'      => ' ',
        'dia'             => 'Diagnosis',
        'dia_helper'      => ' ',
        'todo'            => 'Todo',
        'todo_helper'     => ' ',
        'comment'         => 'Comment',
        'comment_helper'  => ' ',
        'status' => 'Status',
        'status_helper' => ' ',
        'created_at' => 'Created At',
        'created_at_helper' => ' ',
        'description_helper' => ' ',
        'updated_at' => 'Updated At',
        'updated_at_helper' => ' ',
        'deleted_at' => 'Deleted At',
        'deleted_at_helper' => ' ',
      ],
    ],
    'orderManagement' => [
      'title' => 'Manage Orders',
      'title_singular' => 'Manage Order',
    ],
    'order' =>[
      'title' => 'Orders',
      'title_singular' => 'Order',
      'fields' =>[
        'id'              => 'ID',
        'id_helper'       => ' ',
        'order_date'     => 'Order Date',
        'order_date_helper' => ' ',
        'document_id'              => 'Document',
        'document_id_helper'       => ' ',
        'customer_id'             => 'Customer',
        'customer_id_helper'      => ' ',
        'user_id'             => 'User',
        'user_id_helper'      => ' ',
        'chief_complain'             => 'Chief Complain',
        'chief_complain_helper'      => ' ',
        'past_history'             => 'Past History',
        'past_history_helper'      => ' ',
        'blood_test'             => 'Blood Test',
        'blood_test_helper'      => ' ',
        'orl_ent'             => 'Orl/Ent',
        'orl_ent_helper'      => ' ',
        'ultra_sound'             => 'Ultra Sound',
        'ultra_sound_helper'      => ' ',
        'ecg'             => 'ECG',
        'ecg_helper'      => ' ',
        'x_ray'             => 'X-Ray',
        'x_ray_helper'      => ' ',
        'et_at'             => 'ETAT',
        'et_at_helper'      => ' ',
        'diagnosis'             => 'Diagnosis',
        'diagnosis_helper'      => ' ',
        'recommendation'             => 'Recommendation',
        'recommendation_helper'      => ' ',
        'medicine'             => 'Medicine',
        'medicine_helper'      => ' ',
        'injection'             => 'Injection',
        'injection_helper'      => ' ',
        'order_type'             => 'OrderType',
        'order_type_helper'      => ' ',
        'status' => 'Status',
        'status_helper' => ' ',
        'created_at' => 'Created At',
        'created_at_helper' => ' ',
        'description_helper' => ' ',
        'updated_at' => 'Updated At',
        'updated_at_helper' => ' ',
        'deleted_at' => 'Deleted At',
        'deleted_at_helper' => ' ',
      ],
    ],
    'orderDetail' =>[
      'title' => 'Order Details',
      'title_singular' => 'Order Detail',
      'fields' =>[
        'id'              => 'ID',
        'id_helper'       => ' ',
        'order_id'     => 'Order',
        'order_id_helper' => ' ',
        'product_id'              => 'Product',
        'product_id_helper'       => ' ',
        'unit'             => 'Unit',
        'unit_helper'      => ' ',
        'strength'             => 'Strength',
        'strength_helper'      => ' ',
        'qty'             => 'Qty',
        'qty_helper'      => ' ',
        'price'             => 'Price',
        'price_helper'      => ' ',
        'total'             => 'Total',
        'total_helper'      => ' ',
        'how_to_use'             => 'How to use',
        'how_to_use_helper'      => ' ',
        'status' => 'Status',
        'status_helper' => ' ',
        'created_at' => 'Created At',
        'created_at_helper' => ' ',
        'updated_at' => 'Updated At',
        'updated_at_helper' => ' ',
        'deleted_at' => 'Deleted At',
        'deleted_at_helper' => ' ',
      ],
    ],
    'customer_history' =>[
      'title' => 'Customer Histories',
      'title_singular' => 'Customer History',
      'fields' => [
        'customer_code' => 'Customer Code',
        'search_by_customer' => 'Search by Customer',
        'document_id' => 'Document ID',
        'treatment_history' => 'Treatment History Detail'
      ]
    ],
    'operative_protocol' =>[
      'title' => 'Operative Protocols',
      'title_singular' => 'Operative Protocol',
      'fields' => [
        'operater' => 'Operater',
        'aide' => 'Aide',
        'anesth' => 'Anesth',
        'diapre' => 'DiaPre',
        'diaper' => 'DiaPer',
        'indication' => 'Indication',
        'position' => 'Position',
        'note' => 'Note',
        'document_id' => 'Document',
        'customer_id' => 'Customer',
        'user_id' => 'User',
        'date'  => 'Date',
        'time' => 'Time'
      ]
    ],
    'medical_certificate' =>[
      'title' => 'Medical Certificates',
      'title_singular' => 'Medical Certificate',
      'fields' => [
        'operater' => 'Operater',
        'aide' => 'Aide',
        'anesth' => 'Anesth',
        'diapre' => 'DiaPre',
        'dieper' => 'DiaPer',
        'indication' => 'Indication',
        'position' => 'Position',
        'note' => 'Note',
        'document_id' => 'Document',
        'customer_id' => 'Customer',
        'user_id' => 'User',
        'date'  => 'Date',
        'time' => 'Time'
      ]
    ],
    'company_information'=>[
      'title' => 'Company Info',
      'title_singular' => 'Company Info',
      'fields' => [
        'id'              => 'ល.រ',
        'name_en' => 'ឈ្មោះអង់គ្លេស',
        'name_kh' => 'ឈ្មោះខ្មែរ',
        'address' => 'អាស័យដ្ឋាន',
        'phone1' => 'ទូរស័ព្ទខ្សែទី១',
        'phone2' => 'ទូរស័ព្ទខ្សែទី២',
        'phone3' => 'ទូរស័ព្ទខ្សែទី៣',
        'logo' => 'រូបភាព',
        'status' => 'ស្ថានភាព',
        'created_at' => 'ថ្ងៃបង្កើត',
        'updated_at' => 'ថ្ងៃកែប្រែ',
        'deleted_at' => 'ថ្ងៃលុប',
      ]
    ],
    'scheduleManagement' =>[
      'title' => 'Manage Schedules',
      'title_singular' => 'Manage Schedule',
    ],
    'schedule' => [
      'title' => 'Schedules',
      'title_singular' => 'Schedule',
      'fields' => [
        'id' => 'ID',
        'title' => 'Appointment Title',
        'start_time' => 'Start Time',
        'finish_time' => 'Finish Time',
        'customer_id' => 'Customer Name',
        'user_id' => 'Doctor Name',
        'desr'    => 'Description',
        'status'  => 'Status',
        'color'   => 'Color',
      ]
    ],
    'schedule_detail' => [
      'title' => 'Schedule Details',
      'title_singular' => 'Schedule Detail',
      'fields' => [
        'id' => 'ID',
        'schedule_id' => 'Schedule',
        'note' => 'Note',
      ]
    ]
];
