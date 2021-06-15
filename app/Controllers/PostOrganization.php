<?php

namespace BankruptOrganizations\Controllers;

use WPMVC\MVC\Controller;
/**
 * RegisterPostType
 * WordPress MVC controller.
 *
 * @author Ivan Zabroda <ivanzabroda62@gmail.com>
 * @package bankrupt-organizations
 * @version 1.0.0
 */
class PostOrganization extends Controller
{
    public static $postType = 'organization_table';
    /**
     * @since 1.0.0
     *
     *
     * @return
     */
    public function init()
    {
        register_post_type( self::$postType , [
            'label'  => null,
            'labels' => [
                'name'               => 'Организации', // основное название для типа записи
                'singular_name'      => 'Организация', // название для одной записи этого типа
                'add_new'            => 'Добавить новую организацию', // для добавления новой записи
                'add_new_item'       => 'Добавление организации', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => 'Редактирование организации', // для редактирования типа записи
                'new_item'           => 'Новая организация', // текст новой записи
                'view_item'          => 'Смотреть организацию', // для просмотра записи этого типа.
                'search_items'       => 'Искать организацию', // для поиска по этим типам записи
                'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => 'Организации', // название меню
            ],
            'description'         => '',
            'public'              => true,
            // 'publicly_queryable'  => null, // зависит от public
            // 'exclude_from_search' => null, // зависит от public
            // 'show_ui'             => null, // зависит от public
            // 'show_in_nav_menus'   => null, // зависит от public
            'show_in_menu'        => null, // показывать ли в меню адмнки
            // 'show_in_admin_bar'   => null, // зависит от show_in_menu
            'show_in_rest'        => null, // добавить в REST API. C WP 4.7
            'rest_base'           => null, // $post_type. C WP 4.7
            'menu_position'       => null,
            'menu_icon'           => null,
            //'capability_type'   => 'post',
            //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
            //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
            'hierarchical'        => false,
            'supports'            => [ 'title', 'editor','custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => [],
            'has_archive'         => false,
            'rewrite'             => true,
            'query_var'           => true,
        ] );
    }

    public $fields = [
        'inn' => 'ИНН',
        'datereg' => 'Дата регистрации',
        'cyty' => 'Город',
        'ifnc' => 'ИФНС',
        'kap' => 'Уставный капитал',
        'nalog' => 'Система налогообложения',
        'bank' => 'Расчетные счета',
        'oborot' => 'Обороты',
        'type' => 'Вид деятельности',
        'kved' => 'Основной ОКВЭД',
        'dopusk' => 'Допуск СРО',
        'linece' => 'Лицензии',
        'contry_contract'=>'Гос. контракты',
        'price' => 'Цена продажи'
    ];

    function addParms(){
       /* ИНН 1551351451
Дата регистрации 21.11.2013
Город Москва
ИФНС Инспекция ФНС России № 14 по г. Москве
Уставный капитал 20 000 ₽
Система налогообложения УСН 6%
        Расчетные счета Сбербанк, ВТБ, Альфа-Банк
Обороты До 100 млн. руб.
        2019г. – 8 млн. руб., 2020г. – 11 млн. руб., 2021г. – 17 млн. руб.
        Вид деятельности Клининговые услуги
Основной ОКВЭД 81.22 Деятельность по чистке и уборке жилых зданий и нежилых помещений прочая
Допуск СРО Нет допуска
Лицензии Без лицензий
Гос. контракты Нет
Цена продажи 26 000 ₽*/
    }

    public function addOrganization()
    {
        $post_data = array(
            'post_title'    => sanitize_text_field( $_POST['post_title'] ),
            'post_content'  => $_POST['post_content'],
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_category' => array( 8,39 )
        );

        // Вставляем запись в базу данных
        $post_id = wp_insert_post( $post_data );

       // add_post_meta( int $post_id, string $meta_key, mixed $meta_value, bool $unique = false )
    }

    function template( )
    {
        global $post;

        /* Checks for single template by post type */
        if ( $post->post_type == 'organization_table' ) {
         //   if ( file_exists( PLUGIN_PATH . '/Custom_File.php' ) ) {
                return  assets_path('views/single-organization.php', __FILE__);
           // }
        }

        return $single;

    }
}