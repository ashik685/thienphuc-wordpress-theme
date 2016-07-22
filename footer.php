<?php /* <!-- Begin WordPress Cache (DO NOT MODIFY) --> *//* <!-- End WordPress Cache --> */ ?>		<!-- banner bottom Home	 -->
			<?php  
			if(is_front_page()):
				$metabox_baner_bottom = get_post_meta( $post->ID, 'metabox_baner_bottom', true );
				if($metabox_baner_bottom):?>

				<section id="banner_bottom">
					<div class="content_banner">
						<h3><?php echo  $metabox_baner_bottom['title']; ?></h3>
						<?php 
						$content = do_shortcode( $metabox_baner_bottom['content'] );
						echo $content; ?>
					</div>
				</section> <!-- .section-top -->

			<?php 
				endif; 
			endif; ?>
		<!-- end banner bottom home	 -->
		

		<!-- social option tree-->
		<?php if(ot_get_option("social_links")): ?>
		<div class="social_footer">
			<ul>
			<?php $social_links = ot_get_option("social_links") ; 
				foreach ($social_links as $value):?>

				<li class='<?php echo $value['name']; ?>'><a href="<?php echo $value['href']; ?>"><?php echo $value['title']; ?></a></li>

			<?php	
				endforeach;
			?>
			</ul>
		</div>
		<?php endif; ?>
		<!-- end social option tree-->
		
		</div> <!-- end #container -->


		<!-- privacy policy option tree-->
		<div class="privacy_policy">
			<div class="container">
			<?php if(ot_get_option("privacy_policy_1")): ?>
				<?php $page_1 = ot_get_option("privacy_policy_1"); 
					$title_1 = get_the_title( $page_1);
					$link_1  = get_permalink( $page_1);
				?>
				<a href="<?php echo $link_1; ?>"><?php echo $title_1; ?></a>
			<?php endif; ?>
			and
			<?php if(ot_get_option("privacy_policy_2")): ?>
				<?php $page_2 = ot_get_option("privacy_policy_2"); 
					$title_2 = get_the_title( $page_2);
					$link_2  = get_permalink( $page_2);
				?>
				<a href="<?php echo $link_2; ?>"><?php echo $title_2; ?></a>
			<?php endif; ?>
			</div>
		</div>
		<!-- end privacy policy option tree-->
			

			<footer role="contentinfo">
				
				<div id="inner-footer" class="container clearfix">
		          <div id="widget-footer" class="clearfix row">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
		            <?php endif; ?>
		          </div>
					
					<nav class="clearfix">
						<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
					
					<?php if(ot_get_option("footer_copyright")): ?>
						<?php echo ot_get_option("footer_copyright"); ?>
					<?php endif; ?>
					
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->	

<a href="#0" class="cd-top">Top</a>
<script src="<?php bloginfo('template_url' ); ?>/js/main.js"></script>

		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>
	
	</body>
	<!-- Custom JavaScript Option Tree -->
		<?php if(ot_get_option("custom_js")): ?>
		<style>
			<?php echo ot_get_option("custom_js"); ?>
		</style>
		<?php endif; ?>
	<!-- end Custom JavaScript Option Tree -->
</html>