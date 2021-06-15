<?php

namespace BankruptOrganizations;

use WPMVC\Bridge;
/**
 * Main class.
 * Bridge between WordPress and App.
 * Class contains declaration of hooks and filters.
 *
 * @author Ivan Zabroda <ivanzabroda62@gmail.com>
 * @package bankrupt-organizations
 * @version 1.0.0
 */
class Main extends Bridge
{
    /**
     * Declaration of public WordPress hooks.
     */
    public function init()
    {
        $this->add_action( 'init', 'PostOrganization@init' );
        $this->add_shortcode( 'bankrupt-organisations-list', 'ShortcodeBankrupt@init' );
        $this->add_filter('single_template', 'PostOrganization@template');

        add_action('wp_head', [$this, 'enqueue_ajax']);

        $this->add_action('wp_ajax_get_ifns', 'ShortcodeBankrupt@getIfns');
        $this->add_action('wp_ajax_nopriv_get_ifns', 'ShortcodeBankrupt@getIfns');

    }
    /**
     * Declaration of admin only WordPress hooks.
     * For WordPress admin dashboard.
     */
    public function on_admin()
    {
    }

    /*
     * Enqueue ajax script
     */
    public function enqueue_ajax()
    {
        $variables = array (
            'ajax_url' => admin_url('admin-ajax.php'),
            'is_mobile' => wp_is_mobile()
            // Тут обычно какие-то другие переменные
        );
        echo'<script type="text/javascript">window.wp_data = ',
        json_encode($variables),
        ';</script>';
    }

}

function js_variables(){

}
