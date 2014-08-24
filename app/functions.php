<?php

/**
 *	**************************************************
 *
 *	File Name:			functions.php
 *	Description:		general functions for the application
 *
 *	@since 1.0.0
 *
 *	**************************************************
 */

$errorstack = array();

$x = isset( $_GET['x'] ) ? $_GET['x'] : FALSE;

if( isset( $_POST['password'] ) ) {
	
	if( $_POST['password'] == PASSWORD ) { 
		setcookie( APP_TITLE . '_login', sha256( PASSWORD . $_SERVER['REMOTE_ADDR'] ), NULL, '/', '.' . str_ireplace( 'www.', '', $_SERVER['SERVER_NAME'] ) ); 
		header( "Location: " . $_SERVER['PHP_SELF'] ); 
		exit;
	} else { 
		header( "Location: " . $_SERVER['PHP_SELF'] . "?x=wp" ); 
		exit; 
	}
	
}

function changelogger_info( $data = '' ) {
	
	if( $data == 'name' ) {
		$data = APP_TITLE;
	} elseif( $data == 'version' ) {
		$data = APP_VERSION;
	} elseif( $data == 'url' ) {
		$data = APP_BASE_URL;
	} else {
		$data = '';
	}
	
	return $data;
	
}

function changelogger_error( $message ) {
	global $errorstack;
	array_push( $errorstack, $message );
	return;
}

function changelogger_errored() {
	global $errorstack;
	return ( count( $errorstack ) > 0 );
}

function sha256( $str ) {
	//global $salt;
	return hash( 'SHA256', $str . SALT );
}

function changelogger_output_errors( $retvar = false ) {
	
	global $errorstack;
	
	$retval = null;
	
	if( $retvar )
		$retval = '';
	
	if( changelogger_errored() ) {
		$retval .= '<div class="uk-alert uk-alert-warning" data-uk-alert><a href="" class="uk-alert-close uk-close"></a><p>' . implode( ', ', $errorstack ) . '</p></div>';
	}
	
	if( $retvar )
		return $retval;
	
	print $retval;
}
