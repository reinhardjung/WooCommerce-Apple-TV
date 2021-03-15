<?php


// info rju 2021-03-14: wp-json/numerics/users
function numerics_get_users() {
	return rest_ensure_response(
		[
			'postfix' => 'users',
			'data'    => [
				'value' => count(get_users())
				]
		]
	 );
}


// info rju 2021-03-14: wp-json/numerics/roles
function numerics_get_roles() {
	return rest_ensure_response(
		[
			'postfix' => 'roles',
			'data'    => [
				'value' => count(wp_roles()->role_names)
				]
		]
	 );
}


// info rju 2021-03-14: wp-json/numerics/rolelist
function numerics_get_rolelist() {
	foreach (wp_roles()->role_names as $key => $value) {
		// fixme rju 2021-03-13: $theList = str_replace(implode(",", wp_roles()->role_names),' ', '_');
		$theList = implode(',', wp_roles()->role_names);
	}
	return $theList;
}


// fixme rju 2021-03-13: Anzahl User finden, welche keiner Rolle zugeordnet seid.
// info rju 2021-03-14: wp-json/numerics/orders/?subscriber
function numerics_get_role() {
	$getUserRole = parse_url((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",PHP_URL_QUERY);
	if( !$getUserRole) !$getUserRole = 'administrator';

	foreach (wp_roles()->role_names as $key => $value) {
		if($key == strtolower($getUserRole)) {
			return rest_ensure_response(
				[
					'postfix' => $getUserRole,
					'data'    => [
						'value' => count(get_users(['role__in' => [$getUserRole]]))
						]
				]
			);
		}
	}
}


function numerics_get_products() {
	return rest_ensure_response(
		[
			'postfix' => 'products',
			'data'    => [
				'value' => count(wc_get_products([
					'limit' => -1
				]))
			]
		]
	 );
}


// info rju 2021-03-13: die 5 meistverkauften Produkte
function numerics_get_top_products() {
	$products = wc_get_products( [
		'limit'    => -1,
		'orderby'  => 'name',
	] );

	return rest_ensure_response(
		[
			'valueNameHeader' => 'Pakete',
			'valueHeader' => 'Anzahl',
			'data' => [
				[
					'name'  => 'ProduktName 5',
					'value' => '500'
				],
				[
					'name'  => 'ProduktName 4',
					'value' => '400'
				],
				[
					'name'  => 'ProduktName 3',
					'value' => '300'
				],
				[
					'name'  => 'ProduktName 2',
					'value' => '200'
				],
				[
					'name'  => 'ProduktName 1',
					'value' => '100'
				]
			]
		]
	 );
}


// info rju 2021-03-14: wp-json/numerics/orders/?wc-pending
function numerics_get_orders() {
	$getStatus = parse_url((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",PHP_URL_QUERY);
	$myColor  = 'black';

	if ( !$getStatus) !$getStatus = 'wc-completed';
	if ( $getStatus == 'wc-completed') $myColor  = 'green';
	if ( $getStatus == 'wc-pending') $myColor  = 'red';


	$query = new WC_Order_Query( [
		'limit'  => -1,
		'status' => [$getStatus]
	] );
	$orders = count($query->get_orders());

	return rest_ensure_response(
		[
			'postfix' => $getStatus,
			'color'   => $myColor,
			'data'    => [
				'value' => $orders
				]
		]
	 );
}


// https://stackoverflow.com/questions/45701599/get-all-woocommerce-subscriptions
function numerics_get_subscriptions() {
	return rest_ensure_response(
		[
			'postfix' => 'subscriptions',
			'data'    => [
				'value' => count(wcs_get_subscriptions([
					'subscriptions_per_page' => -1
				]))
			]
		]
	 );
}


// docu rju 2021-03-14: Nur zu Testzwecken
function numerics_test() {
	$getStatus = parse_url((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",PHP_URL_QUERY);

	$query = new WC_Order_Query( [
		'limit'  => -1,
		'status' => [$getStatus]
	] );
	$orders = count($query->get_orders());

	return print_r($getStatus);
}
