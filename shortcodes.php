//price rang and product cat theke product filter korte eyta likhte hbe... shortcodes.php te.....////////////////
add_shortcode('custom-price-range-shortcode',    array($this, 'custom_price_range_shortcode_function'));

/**
     * CustomProductPriceRangeSearch
     * Shortcode: [custom-price-range-shortcode]
     */
    public function custom_price_range_shortcode_function() { ?>
    

    <?php
$params = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        'relation' => 'AND',

        'meta_query' => array(
            'relation' => 'OR',
        array  (
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array('child'),
            'operator' => 'IN'
        ),

        array  (
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array('electronics'),
            'operator' => 'IN'
        ),
    ),
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => '_price',
            'value' => array(0,400),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        ),
        array(
            'key' => '_price',
            'value' => array(0,400),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        )
    ), 
);
$wc_query = new WP_Query($params); // (2)
?>
<?php if ($wc_query->have_posts()) : // (3) ?>
<?php while ($wc_query->have_posts()) : // (4)
                $wc_query->the_post(); // (4.1) ?>
<?php endwhile; ?>

<?php
foreach($wc_query->posts as $p):
	$pid = $p->ID;
$product = wc_get_product( $pid );
?>
<div class="product">
	<h2><a href="<?php echo get_permalink($pid); ?>"><?php echo $p->post_title; ?></a></h2>
	<span class="price"><?php echo $product->get_price_html(); ?></span>
    <span class="thumbnail"><?php echo get_the_post_thumbnail($pid);?></span>


</div><!-- /item -->
<?php endforeach; ?>

<?php wp_reset_postdata(); // (5) ?>
<?php else:  ?>
<p>
     <?php _e( 'No Products' ); // (6) ?>
</p>
<?php endif; ?>

        <?php
        }

} 
new Webalive_Elementor_Shortcodes();


///////////////price rang and product cat theke product filter korte eyta likhte hbe... shortcodes.php te...../////////////////////////
