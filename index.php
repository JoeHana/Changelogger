<?php

/**
 *	Name:			Changelogger
 *	Description: 	Create easily changelog files for your projects
 *
 *	Author:			ANEX
 *	Author URL:		http://anex.at
 *
 *	Version:		1.2.0
 */

if( file_exists('app/settings.php' ) )
	require_once( 'app/settings.php' );
	
if( file_exists('app/functions.php' ) )
	require_once( 'app/functions.php' );
	
if( file_exists('app/debug.php' ) )
	require_once( 'app/debug.php' );
	
?>

<!DOCTYPE html>
<html>

    <head>
    
        <title><?php echo changelogger_info( 'name' ); ?></title>
        
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="noindex, nofollow" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <link rel="stylesheet" id="uikit-css"  href="<?php echo changelogger_info( 'url' ); ?>/app/assets/css/uikit/uikit.min.css" type="text/css" media="all" />
        <link rel="stylesheet" id="uikit-addons-css"  href="<?php echo changelogger_info( 'url' ); ?>/app/assets/css/uikit/addons/uikit.addons.min.css" type="text/css" media="all" />
        
        <link rel="stylesheet" id="changelogger-css"  href="<?php echo changelogger_info( 'url' ); ?>/app/assets/css/base.css?<?php echo changelogger_info( 'version' ); ?>" type="text/css" media="all" />
        
	</head>
    
	<?php if( isset( $_COOKIE[changelogger_info( 'name' ) . '_login'] ) ) $login = $_COOKIE[changelogger_info( 'name' ) . '_login']; else $login = 'no'; ?>

    
	<?php 
    if( MODE == 'private' ) {
        
        if( $login != sha256( PASSWORD . $_SERVER['REMOTE_ADDR'] ) ) {
            
            include('app/views/login.php');
            
            exit;
            
        }
    }
    ?>
    
    <?php include('app/views/interface.php'); ?>

</html>
