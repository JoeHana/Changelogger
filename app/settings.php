<?php

/**
 *	**************************************************
 *
 *	File Name:			settings.php
 *	Description:		app settings
 *
 *	@since 1.0.0
 *
 *	**************************************************
 */

##################################################
# GENERAL SETTINGS ###############################
##################################################

// the baseurl where this script is installed
if( !defined( 'APP_BASE_URL' ) )
	define('APP_BASE_URL', 'http://dev.anex.at/changelogger' );

// title of the app	
if( !defined( 'APP_TITLE' ) )
	define( 'APP_TITLE', 'Changelogger' );

// title of the app	
if( !defined( 'APP_VERSION' ) )
	define( 'APP_VERSION', '1.0.0' );

// path where changelogs get generated
if( !defined( 'CHANGELOG_PATH' ) )
	define( 'CHANGELOG_PATH', './content/' );



##################################################
# ADMIN SETTINGS #################################
##################################################

// mode
if( !defined( 'MODE' ) )
	define('MODE', 'private' ); // private or public

// title of the app	
if( !defined( 'PASSWORD' ) )
	define( 'PASSWORD', '1234' ); // set a password

// path where changelogs get generated
if( !defined( 'SALT' ) )
	define( 'SALT', '' ); // change this to whatever you want



##################################################
# APPEARANCE & BRANDING ##########################
##################################################

// path to the logo
if( !defined( 'LOGO_PATH' ) )
	define( 'LOGO_PATH', 'http://dev.anex.at/changelogger/content/logo.png' );

// the link where the user should be redirected by clicking on the logo
if( !defined( 'LOGO_LINK' ) )
	define( 'LOGO_LINK', APP_BASE_URL );

// title of the link
if( !defined( 'LOGO_TITLE' ) )
	define('LOGO_TITLE', APP_TITLE );

// path to the icon (used for favicon)
if( !defined( 'ICON_PATH' ) )
	define( 'ICON_PATH', 'application/assets/img/icon.jpg' );



##################################################
# DEFINE PROJECTS & CATEGORIES ###################
##################################################

function changelogger_projects() {
	
	$projects = array(
		'kolarik'	=> 'Kolarik',
		'rekit'		=> 'Re:Kit',
		'wpcasa'	=> 'wpCasa'
	);
	
	return $projects;
	
}

function changelogger_project_version() {
	
	$projects = array(
		'100'	=> '1.0.0',
		'200'	=> '2.0.0',
		'300'	=> '3.0.0'
	);
	
	return $projects;
	
}

function changelogger_types() {
	
	$types = array(
		'bug'		=> 'Bug',
		'fix'		=> 'Fix',
		'update'	=> 'Update',
		'note'		=> 'Note',
		'todo'		=> 'Todo',
		'doc'		=> 'Doc',
	);
	
	asort( $types );
	
	return $types;
	
}