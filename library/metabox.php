<?php
function Page_img_function($counter='#intcounter#',$val='#strvalue#'){

	$output = '<input class="upload_image upload_image_'.$counter.'" type="text" size="36" name="sub_page_data['.$counter.'][imgsource]" value="'. $val .'" >';
	$output .= '<div class="button media_upload_button" data-order="'.$counter.'">';
	$output .= '<div style="margin-top:2px;">Upload</div></div>';
	$output .= '<h4>Preview :</h4><img src="'. $val .'" class="image_review_'.$counter.'" />';

	return $output;

}

$output .= '<div class="col-md-6" style="width:50%;float:left;">';

function Page_title_function($counter='#intcounter#',$val='#strvalue#'){
	
	$output = '<input class="video_url" type="text" size="36" name="sub_page_data['.$counter.'][title_box]" value="'. $val .'" >';


	return $output;

}

function color_function($counter='#intcounter#',$val='#strvalue#'){
	
	$output = ' #<input class="color_display" id="picker-'.$counter.'" type="text" name="sub_page_data['.$counter.'][color]" value="'. $val .'" >';

	return $output;

}

function color_hover_function($counter='#intcounter#',$val='#strvalue#'){
	
	$output = ' #<input class="color_display" id="picker_hover-'.$counter.'" type="text" name="sub_page_data['.$counter.'][color_hover]" value="'. $val .'" >';

	return $output;

}

function box_link($counter='#intcounter#',$val='#strvalue#'){
	
	$output = '<input class="link" id="link-'.$counter.'" type="text" size="36" name="sub_page_data['.$counter.'][box_link]" value="'. $val .'" >';

	return $output;

}


add_action('admin_menu', 'mytheme_add_box');
// Add meta box 
function banner_bottom_callback( $post ) {

        wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );

        $metabox_baner_bottom = get_post_meta( $post->ID, 'metabox_baner_bottom', true );


        if(!$metabox_baner_bottom['content']) $metabox_baner_bottom['content'] = "";
        if(!$metabox_baner_bottom['title']) $metabox_baner_bottom['title'] = " ";
        $val_title = $metabox_baner_bottom['title']; 
  		?>
		<p><label for="title_banner">Title: </label><input id="title_banner" type="text" value=" <?php echo  $val_title ?>" name="area_metabox_baner_bottom[title]" ></p>
  		<?php


        $settings = array( 'textarea_name' => 'area_metabox_baner_bottom[content]','textarea_rows' => 2 );
        $editor_id = 'edit_baner_bottom';
      
        wp_editor( htmlspecialchars_decode($metabox_baner_bottom['content']), $editor_id, $settings );
       
}
add_action( 'save_post', 'banner_bottom_save' );

function banner_bottom_save( $post_id )
{
    // Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;


    // if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
	$allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
            ),
        'br' => array()
        );

   	$datta=$_POST['area_metabox_baner_bottom'];
      
    update_post_meta($post_id, 'metabox_baner_bottom', $datta );
	
}



// add metabox
function mytheme_add_box() {
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	if ($template_file == 'page-homepage.php') {
		add_meta_box( 'Page_section', 'Other Sub Page', 'sub_page_callback', 'page', 'normal', 'low' );
		add_meta_box( 'Banner_bottom', 'Banner Bottom', 'banner_bottom_callback', 'page', 'normal', 'low' );
	} 
}


// custom post type Page metabox register
function sub_page_callback($post){
	$post_id = $post->ID;
	$sub_page_datavalues = get_post_meta($post->ID, 'sub_page_data', true);
	$c = 0;

	?>
	<div class="addPageSection">Add Item</div>
	<div id="sub_page_dataContent">

		<?php

		if ($sub_page_datavalues != null) {
			foreach ( $sub_page_datavalues as $key => $pdata ) {
				$c = $c + 1;
				$imgSrc = Page_img_function ( $c, $pdata ['imgsource'] );
				$title_box = Page_title_function ( $c, $pdata ['title_box'] );
				$color = color_function( $c, $pdata ['color'] );
				$color_hover = color_hover_function( $c, $pdata ['color_hover'] );
				$box_link = box_link( $c, $pdata ['box_link'] );

				$title = $pdata ['title_box'];
				?>
				<div class="ProtfolioSection ui-state-default">
					<div class="header-section"><h3 class='title-section'><?php echo "Sub page $c - <strong>$title</strong>"; ?></h3><span class='toogle-section handlediv' status='close-section'>OO</span></div>
					<table style='display:none'>
						<tbody>
						<tr><td><div class="removePortolioSection">X</div></td></tr>
						<tr>
							<td><?php echo $sectionOrder; ?></td>
						</tr> 
						<tr>
							<td>
								<h4>Caption:</h4> <?php echo $title_box; ?>
								<h4>Link:</h4> <?php echo $box_link; ?>
								<div class="col-md-6"><h4>Color default:</h4><?php echo $color; ?></div>
								<div class="col-md-6"><h4>Color hover:</h4><?php echo $color_hover; ?></div>
							</td>
							<td>
								<h4>Image link: </h4>
								<div class="tab_image"><?php echo $imgSrc; ?></div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>

				<?php
				}
		}else{
			$imgSrc = Page_img_function ( 1, '' );
			$title_box = Page_title_function ( 1, '' );
			$color = color_function( 1, '' );
			$color_hover = color_hover_function( 1, '' );
			$box_link = box_link( 1, '' );

			?>					
			<div class="ProtfolioSection">
				<div class="header-section"><h3 class='title-section'>New Item</h3><span class='toogle-section handlediv' status='close-section'>OO</span></div>
				<table>
					<tbody>
						<tr><td><div class="removePortolioSection">X</div></td></tr>
						<tr>
							<td><?php echo $sectionOrder; ?></td>
						</tr> 
						<tr>
							<td>
								<h4>Caption:</h4> <?php echo $title_box; ?>
								<h4>Link:</h4> <?php echo $box_link; ?>
								<div class="col-md-6"><h4>Color default:</h4><?php echo $color; ?></div>
								<div class="col-md-6"><h4>Color hover:</h4><?php echo $color_hover; ?></div>
							</td>
							<td>
								<h4>Image link: </h4>
								<div class="tab_image"><?php echo $imgSrc; ?></div>
							</td>
						</tr>
					</tbody>
				</table>

			</div>

			<?php } ?>
		</div>
		<style type="text/css">

		.ProtfolioSection {
			position: relative;
			margin: 10px 0;
		}
		.addPageSection{
			float: left;
			padding: 5px 10px;
			border: 1px solid black;
			cursor: pointer;
			background-color: gray;
			clear: both;
			margin-bottom: 10px;
			display: block;
		}
		.removePortolioSection{
			float: left;
			padding: 5px 10px;
			border: 1px solid;
			background-color: #d4d4d4;
			margin: 5px 0;
			cursor: pointer;
			position: absolute;
			right: 5px;
		}
		#sub_page_dataContent{
			float: none;
			display: block;
			clear: both;
		}
		table{
			width: 100%;
			border: 1px solid lightgray;
			padding: 10px;
			border-top:none; 
		}
		input.upload_image{width: 80%;}
		
		.tab_image img{
			width: 20%;
			height: auto;
			background: none repeat scroll 0 0 #f1f1f1;
		} 
		ul.ul_tab_title {
			display: table;
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		ul.ul_tab_title>li {
			float: left;
			padding: 10px;
			background-color: lightgray;
			cursor: pointer;
		}

		ul.ul_tab_title>li:hover,ul.ul_tab_title .current-tab {
			background-color: rgb(163, 163, 176);
		}

		ul.ul_tab_title li.tabselected {
			background-color: rgb(163, 163, 176) !important;
		}
		.ProtfolioSection tr > td {
			width: 50%;
			vertical-align: top;
		}
		.title-section{
			float: left;
		}
		.header-section{
			clear: both;
			overflow: hidden;
			border: 1px solid lightgray;
			background: #F7F7F7;
			cursor: move;
		}
		.toogle-section{
			float: right;
		}
		.ProtfolioSection{
			background: #fff;
		}
		.ProtfolioSection h4{
			margin-bottom: 0.9em;
		}
		.color_display {
			margin:0;
			padding:0;
			border:0;
			width:90px;
			height:20px;
			border-style: none solid !important;
   			border-width: 0 20px 0 0 !important;
			line-height:20px;
		}
		.color-label{
			margin-right: 15px;
			height: 20px;
			line-height: 20px;
			float: left;
		}
		.col-md-6 {
			float: left;
			width: 50%;
		}
	
		</style>
		
		<script src="<?php bloginfo('template_url'); ?>/library/js/colpick.js"></script>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/library/css/colpick.css">

		<script type="text/javascript">
		var $ =jQuery.noConflict();
		jQuery(document).ready(function($) {
			$('.color_display').colpick({
				layout:'hex',
				submit:0,
				colorScheme:'dark',
				onChange:function(hsb,hex,rgb,el,bySetColor) {
					$(el).css('border-color','#'+hex);
				if(!bySetColor) $(el).val(hex);
			}
			}).keyup(function(){
				$(this).colpickSetColor(this.value);
			});
		});



		var counter = <?php echo $c; ?>;
		var post_id = <?php echo $post_id; ?>;
		var removeditem=false;
		$(".addPageSection").click(function() {

			counter = jQuery("#sub_page_dataContent .ProtfolioSection").length + 1;

			//var num_section = jQuery(".ProtfolioSection").length + 1;

			var imgSrc = '<?php echo Page_img_function (); ?>'.replace("#intcounter#", counter).replace("#strvalue#","");
			var title_box = '<?php echo Page_title_function (); ?>'.replace("#intcounter#", counter).replace("#strvalue#","");
			var color = '<?php echo color_function(); ?>'.replace("#intcounter#", counter).replace("#strvalue#","");
			var color_hover = '<?php echo color_hover_function(); ?>'.replace("#intcounter#", counter).replace("#strvalue#","");
			var box_link = '<?php echo box_link(); ?>'.replace("#intcounter#", counter).replace("#strvalue#","");
			var color_pick_js = "$(this).find('.color_display').colpick({layout:'hex',submit:0,colorScheme:'dark',onChange:function(hsb,hex,rgb,el,bySetColor) {$(el).css('border-color','#'+hex);if(!bySetColor) $(el).val(hex);}}).keyup(function(){$(this).colpickSetColor(this.value);});";



			$('#sub_page_dataContent').append('<div class="ProtfolioSection"><div class="header-section"><h3 class="title-section">New sub page</h3><span class="toogle-section handlediv" status="close-section">OO</span></div><table><tbody><tr><td><div class="removePortolioSection">X</div></td></tr><tr><td>'+ sectionOrder +'</td></tr><tr><td><h4>Caption:</h4> '+ title_box +'<h4>Link:</h4> '+ box_link +'<div class="col-md-6"><h4>Color default:</h4><span onclick="'+ color_pick_js +'">'+ color +'</span></div><div class="col-md-6"><h4>Color hover:</h4><span onclick="'+ color_pick_js +'">'+ color_hover +'</span></div></td><td><h4>Image link: </h4><div class="tab_image">'+ imgSrc +'</div></td></tr></tbody></table></div>');

			

			// tinymce.init({selector:'.descbox textarea',
			// 	menubar : false,
			// 	plugins: "textcolor",
			// 	toolbar: "forecolor | bold | styleselect"
			// }); 
			removeditem=false;

			return false;
		});	

$(".removePortolioSection").live('click', function() {
	$(this).closest(".ProtfolioSection").remove();
	counter = counter -1;
	removeditem=true;
	var i=1;
	$('#sub_page_dataContent .ProtfolioSection').each(function(){
		$(this).find('.section_order').val(i);
		i++;
	})
});




var custom_uploader;


var data_order_img;

$('.media_upload_button').live('click', function(e) {

	data_order_img = $(this).attr('data-order');



	e.preventDefault();



        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
        	custom_uploader.open();
        	return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
        	title: 'Choose Image',
        	button: {
        		text: 'Choose Image'
        	},
        	multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
        	attachment = custom_uploader.state().get('selection').first().toJSON();
        	attachmentUrl = attachment.url;
        	$(".upload_image_"+ data_order_img).val(attachment.url);
        	$(".image_review_"+ data_order_img).attr('src', attachment.url);
        });

        //Open the uploader dialog
        custom_uploader.open();
    });


$('ul.ul_tab_title li').live('click', function(e) {
	var tab_data = $(this).attr("data-tab");
	$(this).parent().find('.current-tab').removeClass('current-tab');
	$(this).addClass('current-tab');
	$(this).parents('.tab-title').siblings('div.tab-detail').children('div').hide();
	$(this).parents('.tab-title').siblings('div.tab-detail').children('div.'+ tab_data +'').show();
	$(this).siblings('input').val(tab_data);
});

	//sorttable UI
	$(function() {
		$( "#sub_page_dataContent" ).sortable({
			 update: function(event, ui) {
			 	var i=1;
           		$('#sub_page_dataContent .ProtfolioSection').each(function(){
           			$(this).find('.section_order').val(i);
           			i++;
           		})
       		 }
		});
		//$( "#sub_page_dataContent" ).disableSelection();
	});
	//show hide tooggle
	jQuery('.toogle-section').click(function(){

		var status = jQuery(this).attr('status');
		if( status == "open-section" ){
			jQuery(this).parent().next().hide();
			jQuery(this).attr('status','close-section');
		}
		if( status == "close-section" ){
			jQuery(this).parent().next().show();
			jQuery(this).attr('status','open-section');
			
		}

	})
	//edit color picker
	jQuery('.color_display').each(function(){
		var color = jQuery(this).val();
		jQuery(this).css('border-color','#'+color);
	})
</script>
<?php } 


add_action( 'save_post', 'block_post' );

function block_post( $post_id )
{
    // Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;


    // if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
	$allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
            ),
        'br' => array()
        );

	$flvsub_page_data = $_POST ['sub_page_data'];

	if ($flvsub_page_data != null)
		update_post_meta ( $post_id, 'sub_page_data', $flvsub_page_data );
	

	$credit_text = $_POST ['credit_text'];

	if ($credit_text != null)
		update_post_meta ( $post_id, 'credit_text', $credit_text );
	
	}


?>