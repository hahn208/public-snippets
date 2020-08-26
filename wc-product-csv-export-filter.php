<?php

/**
 * When WooCommerce exports data it includes all meta (if meta export enabled), which contains settings for The7 sidebar, Revolution Slider, oEmbed, etc. This is confusing for clients using it as a bulk update feature. Leveraging this filter will exclude all meta fields whose keys begin with an underscore.
 */

/**
 * Automatically omit private meta data from the WooCommerce CSV export
 * @see: https://github.com/woocommerce/woocommerce/blob/master/includes/export/class-wc-product-csv-exporter.php#L706
 *
 * @param array $meta_keys_to_skip Meta keys to omit.
 * @param WC_Product $product Product being exported.
 * @return array Array of meta keys
 */
add_filter(
    'woocommerce_product_export_skip_meta_keys',
    function($meta_keys_to_skip, $product)
    {
        $product_meta_data = $product->get_meta_data();
    
        if(count($product_meta_data))
        {
            // Loop each meta item
            foreach($product_meta_data as $meta_item)
            {
                // Get protected data.
                $meta_data = $meta_item->get_data();
    
                // TRUE if the first character is an underscore.
                if(substr($meta_data['key'], 0, 1) === '_')
                {
                    // Add meta key to omission array
                    $meta_keys_to_skip[] = $meta_data['key'];
                }
            }
        }
        
        error_log(print_r($meta_keys_to_skip, true));
        
        return $meta_keys_to_skip;
    },
    10,
    2
);

?>
