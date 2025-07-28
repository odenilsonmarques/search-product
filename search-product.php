<?php
/**
 * Plugin Name: Buscar Produtos para WooCommerce
 * Description: Adiciona busca e spinner no WooCommerce.
 * Version: 1.0
 * Author: Odenilson M Araújo
 * Author URI: https://www.linkedin.com/in/odenilsonmaraujo/
 */

if (!defined('ABSPATH')) exit;

class Meu_Busca_AJAX {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('rest_api_init', [$this, 'register_search_route']);
    }

    public function enqueue_scripts() {
        // Enfileira JS + CSS
        wp_enqueue_script('busca-ajax', plugin_dir_url(__FILE__) . 'js/busca.js', ['jquery'], '1.0', true);
        wp_enqueue_style('busca-ajax-css', plugin_dir_url(__FILE__) . 'css/busca.css');
        
        // Passa dados pro JS (URL do endpoint e do spinner)
        wp_localize_script('busca-ajax', 'buscaAjax', [
            'restUrl' => esc_url(rest_url('custom-search/v1/products')),
        ]);
    }

    public function register_search_route() {
        register_rest_route('custom-search/v1', '/products', [
            'methods' => 'GET',
            'callback' => [$this, 'handle_search'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function handle_search($request) {
        $term = sanitize_text_field($request['s']);

        $args = [
            'post_type'      => 'product',
            'posts_per_page' => 5,
            's'              => $term,
        ];

        $query = new WP_Query($args);
        $results = [];

        while ($query->have_posts()) {
            $query->the_post();
            $results[] = [
                'title' => get_the_title(),
                'link'  => get_permalink(),
                'img'   => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
            ];
        }

        wp_reset_postdata();
        return $results;
    }
}

new Meu_Busca_AJAX();
