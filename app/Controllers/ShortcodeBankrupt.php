<?php

namespace BankruptOrganizations\Controllers;

use WPMVC\MVC\Controller;

/**
 * controller:ShortcodeBankrupt
 * WordPress MVC controller.
 *
 * @author Ivan Zabroda <ivanzabroda62@gmail.com>
 * @package bankrupt-organizations
 * @version 1.0.0
 */
class ShortcodeBankrupt extends Controller
{
    /**
     * Prepocesing shotcode
     * @return mixed
     */
    public function init(){

        $parms = [];

        if(isset($_GET['city'])) {
            if($_GET['city'] != '0') {
                $parms['city'] = $_GET['city'];
            }
        }

        if(isset($_GET['ifns'])) {
            if($_GET['ifns'] != '0') {
                $parms['ifns'] = $_GET['ifns'];
            }
        }

        if(isset($_GET['okwed'])) {
            if($_GET['okwed'] != '0') {
                $parms['okwed'] = $_GET['okwed'];
            }
        }

        if(isset($_GET['vid'])) {
            if($_GET['vid'] != '0') {
                $parms['vid'] = $_GET['vid'];
            }
        }

        if(isset($_GET['nalog'])) {
            if($_GET['nalog'] != '0' || is_array($_GET['nalog'])) {
                $parms['nalog'] = $_GET['nalog'];

            }
        }

        if(isset($_GET['oboroti'])) {
            if($_GET['oboroti'] != '0' || is_array($_GET['oboroti'])) {
                $parms['oboroti'] = $_GET['oboroti'];

            }
        }

        $organizationsIDs = $this->getOrnizationsIDByParms($parms);
        $countOrganizationsIDs = 0;
        $organizations = [];

        if($organizationsIDs) {
            $countOrganizationsIDs = count($organizationsIDs->posts);

            for($i = 0; $i < $countOrganizationsIDs; $i++)
            {
                $organizations[$i]['post'] = $organizationsIDs->posts[$i];
                $organizations[$i]['meta'] = get_post_meta($organizationsIDs->posts[$i]->ID);
                $organizations[$i]['link'] = get_post_permalink( $organizationsIDs->posts[$i]->ID);
            }

        }


        return $this->view->get( 'shortcodes.bankrupt-organizations-list' , [
            'citys' => $this->getMetaValues('city'),
            'ifns' => $this->getMetaValues('ifns'),
            'okweds'=> $this->getMetaValues('okwed'),
            'vids' =>  $this->getMetaValues('vid'),

            /**/
            'selectedCity' =>  isset($parms['city']) ? $parms['city'] : '',
            'selectedIfn' =>   isset($parms['ifns']) ? $parms['ifns'] : '',
            'selectedOkwed' => isset($parms['okwed']) ? $parms['okwed'] : '',
            'selectedVid' =>   isset($parms['vid']) ? $parms['vid'] : '',
            /**/
            'countOrganizations' => $countOrganizationsIDs,
            'organizations' => $organizations
        ] );

        //  $this->add_shortcode( 'bankrupt-organisations-list', 'view@shortcodes.bankrupt-organizations-list' );
    }


    /**
     * Get organi values
     * @param $key
     * @return array|void
     */
    private function getMetaValues($key){

        if( empty( $key ) )
            return;

        global $wpdb;

        $type = PostOrganization::$postType;
        $status = 'publish';

      $result = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT  pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = %s
        AND p.post_status = %s
        AND p.post_type = %s
    ", $key, $status, $type ) );

        return $result;
    }

    private function getOrnizationsIDByParms($parms){
//https://wordpress.stackexchange.com/questions/144078/get-posts-by-meta-value
        //https://rudrastyh.com/wordpress/meta_query.html
     //   SELECT * FROM `wp_posts` p LEFT JOIN `wp_postmeta` pm ON pm.post_id = p.ID WHERE p.post_type = 'organization_table' AND p.post_status = 'publish' AND pm.meta_value = 'Москва' GROUP BY p.ID
        $meta_query = [];

        if(isset($parms['city'])){
            $meta_query[] = [
                'key' => 'city',
                'value' => $parms['city']
            ];
        }


        if(isset($parms['ifns'])){
            $meta_query[] = [
                'key' => 'ifns',
                'value' => $parms['ifns']
            ];
        }

        if(isset($parms['vid'])){
            $meta_query[] = [
                'key' => 'vid',
                'value' => $parms['vid']
            ];
        }

        //okwed

         if(isset($parms['okwed'])){
             $meta_query[] = [
                 'key' => 'okwed',
                 'value' => $parms['okwed']
             ];
         }

        if(isset($parms['nalog'])){
            $meta_query[] = [
                'key' => 'nalog',
                'value' => $parms['nalog']
            ];
        }

        if(isset($parms['oboroti'])){
            $meta_query[] = [
                'key' => 'oboroti',
                'value' => $parms['oboroti']
            ];
        }

        $rd_args = array(
            'post_type' => 'organization_table',
            'post_status' => 'publish',
            'meta_query' => [
                $meta_query
            ]
        );

        $rd_query = new \WP_Query( $rd_args );

        return $rd_query;

    }

    public function getIfns_($city){

        global $wpdb; //$wpdb->postmeta

        $result = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT meta_value FROM {$wpdb->postmeta}
        WHERE meta_key = 'ifns' AND post_id = 
        (SELECT post_id FROM `wp_postmeta` WHERE meta_value = '%s')
        ", $city ) );

        return $result;
    }

    public function getIfns(){
        $city = $_GET['city'];

        echo json_encode($this->getIfns_($city));

        wp_die();
    }
}