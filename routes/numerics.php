<?php


function numerics_register_routes() {
	register_rest_route( 'numerics', '/users', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_users',
	) );


	register_rest_route( 'numerics', '/roles', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_roles',
	) );


	register_rest_route( 'numerics', '/role', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_role',
	) );


	register_rest_route( 'numerics', '/rolelist', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_rolelist',
	) );


	// register_rest_route( 'numerics', '/role/(?P<id>[\d]+)', array(
	// 	'methods'  => WP_REST_Server::READABLE,
	// 	'callback' => 'numerics_get_role',
	// ) );


	register_rest_route( 'numerics', '/products', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_products',
	) );


	register_rest_route( 'numerics', '/top_products', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_top_products',
	) );


	register_rest_route( 'numerics', '/orders', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_orders',
	) );


	register_rest_route( 'numerics', '/subscriptions', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_subscriptions',
	) );


	register_rest_route( 'numerics', '/test', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'numerics_get_subscriptions',
	) );

}
add_action( 'rest_api_init', 'numerics_register_routes' );
