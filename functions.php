<?php

function wikiplus_sort_products_by_stock_status($clauses, $query) {
    global $wpdb;
    if (is_admin() || !$query->is_main_query() || !$query->is_post_type_archive('product') && !$query->is_tax(array('product_cat', 'product_tag'))) {
        return $clauses;
    }
    $clauses['join'] .= " LEFT JOIN {$wpdb->postmeta} AS pm ON pm.post_id = {$wpdb->posts}.ID AND pm.meta_key = '_stock_status'";
    $clauses['orderby'] = " pm.meta_value ASC, {$wpdb->posts}.menu_order ASC, {$wpdb->posts}.post_date DESC";
    return $clauses;
}
add_filter('posts_clauses', 'wikiplus_sort_products_by_stock_status', 10, 2);