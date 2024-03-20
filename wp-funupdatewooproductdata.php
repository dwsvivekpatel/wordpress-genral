<?php
// Function to check and update product descriptions
function update_product_descriptions_on_init()
{
    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        // Get all products
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
        );

        $products = new WP_Query($args);

        if ($products->have_posts()) {
            while ($products->have_posts()) {
                $products->the_post();

                $product_id = get_the_ID();
                $product = wc_get_product($product_id);

                // Check if the product does not have a long description
                if (empty($product->get_description())) {
                    // Output product ID if description is empty
                    echo "Product ID with empty description: " . $product_id . "<br>";
                }
            }
            wp_reset_postdata();
        }
    }
}
add_shortcode("data_updationn_wp", 'update_product_descriptions_on_init');
