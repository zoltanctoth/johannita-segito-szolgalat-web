<?php
global $segiton;

$segiton = ($post->post_name == 'segito-szolgalat' || 
	get_post($post->post_parent)->post_name == 'segito-szolgalat' || 
    get_post(get_post($post->post_parent)->post_parent)->post_name == 'segito-szolgalat' ||
    get_post(get_post(get_post($post->post_parent)->post_parent)->post_parent)->post_name == 'segito-szolgalat');

if ( $segiton ){
    $masik_text = "Tovább a Johannita Rend oldalára";
    $masik_href = "/rend";
    $home_url = "/segito-szolgalat";
} else {
    $masik_text = "Tovább a Segítő Szolgálat oldalára";
    $masik_href = "/segito-szolgalat/a-segito-szolgalatrol/segito-szolgalatelnoki-koszonto";
    $home_url = "/rend";
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
    wp_head();
?>
</head>
<? ?>
<body <?php body_class(); ?>>
<div id='centerdiv'>
	<div id='allinthis'>
        <div id="header">
        <a href='<?php echo $masik_href; ?>' style='cursor: pointer; background-color: #444444; float: right; color: white; text-decoration: none;padding: 7px; text-transform: uppercase;'><?=$masik_text?> &gt;</a>
			<a href="<?php echo $home_url; ?>"><h1><img src="<?php bloginfo( 'template_url' ); ?>/images/<? print $segiton ? 'johannita-segito-szolgalat-logo-2.png' : 'johannita-logo-2.png';?>" alt="" /> <span class="title hu"><? print $segiton ? 'Johannita Segítő szolgálat' : 'Johannita Rend';?></span></h1></a>
			
			<!-- NAVIGATION -->
			
			<div id="access" role="navigation">
				<?php $menuid = ($segiton ? 5 : 12); wp_nav_menu( array( 'menu' => $menuid, 'container_class' => 'menu', 'theme_location' => 'header-menu' ) ); ?>
			</div><!-- #access -->
						
			<!-- NAVIGATION END -->
			
		</div><!-- /#header -->
