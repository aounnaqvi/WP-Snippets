add_filter( 'woocommerce_package_rates', 'hide_local_pickup_for_specific_products', 10, 2 );
function hide_local_pickup_for_specific_products( $rates, $package ) {

	$product_ids = [17];

	$term_found = false;

	// Loop through cart items
    foreach( $package['contents'] as $cart_item ){
        if( in_array( $cart_item['product_id'], $product_ids ) ) {
            $term_found = true;
            break;
        }
    }

    if($term_found){
		foreach( $rates as $rate_key => $rate ) {
			// Hide Local Pickup shipping method(s)
			if ( $rate->method_id === 'local_pickup' ) {
				unset($rates[$rate_key]);
			}
		}
	}
    return $rates;
}
