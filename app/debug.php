<?php

/**
 *	**************************************************
 *
 *	File Name:			debug.php
 *	Description:		contains functions to debug the app
 *
 *	@since 1.0.0
 *
 *	**************************************************
 */

if( !defined( 'DEV_MODE' ) )
	define( 'DEV_MODE', true ); // can be true or false

if( DEV_MODE == true ) {
	error_reporting( E_ALL );
	ini_set( 'html_errors','Off' );
	ini_set( 'display_errors','On' );
}
