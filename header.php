<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
				
		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- Custom CSS Option Tree -->
		<?php if(ot_get_option("custom_css")): ?>
		<style>
			<?php echo ot_get_option("custom_css"); ?>
		</style>
		<?php endif; ?>
		<!-- end Custom CSS Option Tree -->
				
	</head>
	
	<body <?php body_class(); ?>>
	
		<header role="banner">
				
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
          			
					<div class="navbar-header">
						<?php echo ot_get_option('smooth_chrome'); ?>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
							<?php if(ot_get_option('logo')): ?>
								<img src="<?php echo ot_get_option('logo');  ?>" alt="<?php bloginfo('name'); ?>">
							<?php else: ?>
								<?php bloginfo('name'); ?>
							<?php endif; ?>
						</a>
					</div>

					<div class="collapse navbar-collapse navbar-responsive-collapse">
						
						<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
						
						<?php 
						//$xxx = ot_get_option('search_bar');
						//var_dump($xxx);
						if(ot_get_option('search_bar') == 'on') {?>

						<form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
							<div class="form-group">
								<input name="s" id="s" type="text" class="search-query form-control" autocomplete="off" placeholder="<?php _e('Search','wpbootstrap'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
							</div>
						</form>
						<?php } ?>
					</div>

				</div> <!-- end .container -->
			</div> <!-- end .navbar -->
		
		</header> <!-- end header -->
		<div id="slider">
			<?php putRevSlider("slider-home","homepage") ?>
		</div>

		<div class="container">
			<div id="sub_page">
			<?php 

			if(is_front_page()):
				$id_home = get_option('page_on_front');
				$meta_sub_page = get_post_meta($post->ID, 'sub_page_data', true);
				if ($meta_sub_page != null):
					foreach ( $meta_sub_page as $key => $pdata ): ?>
						
						<!-- //-->
						<a class="box color-box-<?php echo $key?> col-sm-3" href="<?php echo $pdata ['box_link']; ?>" style="background-color: #<?php echo $pdata ['color']; ?>">
							<img src="<?php echo $pdata ['imgsource']; ?>" alt="icon">
							<span class="caption"><?php echo $pdata ['title_box']; ?></span>
						</a>
						<style>
							.color-box-<?php echo $key;?>:hover{
								background-color: #<?php echo $pdata ['color_hover'];  ?>!important ;
							}
						</style>

				<?php
					endforeach;
				endif;
			endif;
			 ?>
		</div><!-- #sub_page -->
