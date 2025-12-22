<?php
/**
 * Template part for displaying the document head.
 *
 * This template is used by all header*.php templates and displays everything from <!DOCTYPE html> to <div id="page">
 *
 * @package uri-modern
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
	
<!-- Favicons -->
<link rel="mask-icon" href="<?php echo get_template_directory_uri() . '/images/safari-pinned-tab.svg'; ?>" color="#005eff">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() . '/images/favicon.png'; ?>">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() . '/images/apple-touch-icon.png'; ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() . '/images/apple-touch-icon-180x180.png'; ?>">


</head>
	
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
	
<div id="page" class="site">
	

