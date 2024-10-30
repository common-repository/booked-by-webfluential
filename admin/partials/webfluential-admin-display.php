<?php
/**
 *
 * admin/partials/wp-cbf-admin-display.php - Don't add this comment
 *
 **/
?>

<style>
	#webfluentialWrap p, #webfluentialWrap a, #webfluentialWrap label {
		font-size: 15px;
	}
	.header {
		font-size: 17px;
	}
	.webfluential-themes {
		max-width: 90%;
	}
	.wf-settings-theme-container {
		float: left;
		margin-bottom: 20px;
	}
	.wf-settings-theme-images {
		position: relative;
	    width: 50%;
	    height: 60px;
	    max-width: 406px;
	    margin-right: 15px;
	    float: left;
	}
	.wf-settings-theme-images input[type=radio] {
		position: absolute;
		top: 23px;
		left: 10px;
		margin: 0;
		margin-right: 4px;
		transform: scale(1.5);
	}
	.wf-settings-theme-images img {
		margin-left: 40px;
		width: 90%;
	}
	@media only screen 
	  and (max-width: 600px){
	  	.wf-settings-theme-container {
	  		margin-bottom: 0;
	  	}
	  	.wf-settings-theme-images input[type=radio] {
		    position: absolute;
		    top: 20px;
		    left: 5px;
		    transform: scale(1.2);
		}
	  	.webfluential-themes, .wf-settings-theme-images {
			width: 100%;
			max-width: 100%;
		}
		.wf-settings-theme-images {
			margin-bottom: 20px;
		}
		textarea {
			width: 100% !important;
		}
	}
</style>

<br>
<?php
echo '<img style="width:200px; float:right; padding-right:20px;" src="' . plugins_url( 'img/webfluential_logo.png', __FILE__ ) . '" > ';
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="webfluentialWrap" class="wrap">
			
    <h2 class="nav-tab-wrapper" style="padding-bottom:20px;";>Webfluential Booking Form</h2>
	
	<?php
//	echo '<img style="width:100%;" src="' . plugins_url( 'img/home-image.jpg', __FILE__ ) . '" > ';
	echo '<img style="width:100%;" src="http://bookings.webfluential.io/public/img/public/wp-setting-image.jpg" > ';
	?>	
    <p></p>

    <form method="post" name="cleanup_options" action="options.php">

        <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        $profile_url = isset($options['profile_url']) ? $options['profile_url'] : '';
        $profile_email = isset($options['profile_email']) ? $options['profile_email'] : get_bloginfo( 'admin_email' );
        $profile_blog = isset($options['profile_blog']) ? $options['profile_blog'] : 0;
        $profile_twitter = isset($options['profile_twitter']) ? $options['profile_twitter'] : 0;
        $profile_facebook = isset($options['profile_facebook']) ? $options['profile_facebook'] : 0;
        $profile_instagram = isset($options['profile_instagram']) ? $options['profile_instagram'] : 0;
        $profile_youtube = isset($options['profile_youtube']) ? $options['profile_youtube'] : 0;
        $profile_linkedin = isset($options['profile_linkedin']) ? $options['profile_linkedin'] : 0;
        $theme_colour = isset($options['theme_colour']) ? $options['theme_colour'] : 3;
        $form_desc = isset($options['form_description']) ? $options['form_description'] : '';
//        $profile_email = isset($options['profile_email']) ? $options['profile_email'] : get_bloginfo( 'admin_email' );
//        $profile_domain = isset($options['profile_domain']) ? $options['profile_domain'] : get_bloginfo( 'url' );
//        $profile_footer = isset($options['profile_footer']) ? $options['profile_footer'] : 0;
//        $profile_contact = isset($options['profile_contact']) ? $options['profile_contact'] : 0;
        ?>
		
        <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        ?>
		
		<br>
		<!--Introduction-->
        <p class="header">Webfluential allows you to take bookings for social and native brands and marketers directly on your website. This allows you to make money easily by sharing brand content on your blog and social channels. As with other Webfluential campaigns, you can accept or decline jobs. Once you have accepted the job, you will then receive the full collateral – this means the campaign materials. Webfluential then manages the payment from the brand or marketer for you when the job is completed.
		
		<p><strong>If you are not a Webfluential influencer yet, you can</strong> <a href="https://webfluential.com/users/register" target="_blank" rel="nofollow">apply here</a></p>
		</p>
		<br>
		<hr>

		<!--To link your profile-->
        <p class="header"><strong>Step 1. Link your Webfluential account to your booking form.</strong></p>
        
        <p><strong>Please add your webfluential profile URL below.</strong> (i.e. https://webfluential.com/YOURNAME)</p>
        <p>*If you don't know where to find this url you can <a href="https://webfluential.com/faq#pluginSection" target="_blank" rel="nofollow">click here</a></p>

        <fieldset class="webfluential-admin-profile_url">    
            <legend class="screen-reader-text">Submit your Webfluential<br><br> url (i.e. https://webfluential.com/YOURNAME)</legend>
            <label for="webfluential-profile_url">https://webfluential.com/
                <input type="text" class="webfluential-profile_url" id="webfluential-profile_url" name="webfluential[profile_url]" value="<?php echo $profile_url;?>" /> 
				<a id="val"  href="javascript:void(0)">Validate your URL</a>
				<div id="message"></div>
            </label>
        </fieldset>
        <br>
        <hr>
		
		 <fieldset class="webfluential-admin-profile_url">       
            <label for="webfluential-form_description">
            	<p class="header"><strong>Step 2. Let brands and marketers know what this form is about.</strong></p>

            	<p>You can include which type of jobs you are interested in and what your minimum order would be, for example, 1 Tweet and 2 blog posts.</p>
            </label>
            <br>
            <textarea style="width:60%; min-height: 200px; padding:10px" type="text" placeholder="For example: If you would like to use me in your social campaign, please use this form to “Book Me” (or BookMe). Please note, my minimum package is 1 blog post and 2 Tweets." class="webfluential-form_description" id="webfluential-form-description" name="webfluential[form_description]"><?php echo $form_desc;?></textarea>
        </fieldset>
        
		<p class="header"><strong>Step 3: Select a colour theme for your booking form.</strong> (That best matches your own theme)</p>
		<br>

		<fieldset class="webfluential-themes">
			<div class="wf-settings-theme-container">
				<div class="wf-settings-theme-images">
					<input type="radio" <?= ($theme_colour == 3)? 'checked':''; ?> class="webfluential-influ" id="webfluential-influ" name="webfluential[theme_colour]" value ="3"; />
					<?php
					echo '<img src="' . plugins_url( 'img/influ.jpg', __FILE__ ) . '" > ';
					?>
				</div>
			
				<div class="wf-settings-theme-images">
					<input type="radio" <?= ($theme_colour == 4)? 'checked':''; ?> class="webfluential-influ" id="webfluential-influ" name="webfluential[theme_colour]" value ="4" />
					<?php
					echo '<img src="' . plugins_url( 'img/marketer.jpg', __FILE__ ) . '" > ';
					?>
				</div>
			</div>
			
			<div class="wf-settings-theme-container">
				<div class="wf-settings-theme-images">
					<input type="radio" <?= ($theme_colour == 2)? 'checked':''; ?> class="webfluential-influ" id="webfluential-influ" name="webfluential[theme_colour]" value ="2" />
					<?php
					echo '<img src="' . plugins_url( 'img/blk.jpg', __FILE__ ) . '" > ';
					?>	
				</div>
				<div class="wf-settings-theme-images">
					<input type="radio" <?= ($theme_colour == 1)? 'checked':''; ?> class="webfluential-influ" id="webfluential-influ" name="webfluential[theme_colour]" value ="1" />
					<?php
					echo '<img src="' . plugins_url( 'img/base.jpg', __FILE__ ) . '" > ';
					?>
				</div>
			</div>
        </fieldset>
        <div style="clear: both;"></div>
		
		<!-- webfluential profile url-->
        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','Save all changes', TRUE); ?>

        <hr>
		
		<p class="header"><strong>Adding the booking form to your site</strong></p>
		<p>Create a new page, called “Book me”(or whatever you'd like to call it) and paste the Shortcode below into that page. You can also paste the Shortcode into your “Contact” page. Brands will then be able to generate a quote to make use of your services, and if they elect to go ahead with the campaign, you will be notified via email.</p>
		
		<p>Booking form Shortcode : <strong>[webfluential_booking_form]</strong></p>
		<p><strong>If you are unsure of where to put this short code </strong> <a href="https://webfluential.com/faq#pluginSection" target="_blank" rel="nofollow">click here</a></p>
		<br>
		<hr>
		
		<p class="header"><strong>Webfluential Widget Settings</strong></p>
        <p>If you have set up your Influencer profile on <a href="https://webfluential.com" target="_blank" rel="nofollow">Webfluential.com</a>, you are able to display your verified audience and accredited Webfluential stats in a sidebar widget.</p>

        <p>To activate and edit your details, go to <strong>Appearance > Widgets</strong>. Then drag the <strong>“Webfluential Profile”</strong> from the Available Widgets column into your sidebar.</p>
		
		<p><strong>1) Enter your unique URL</strong> (as set above)</p>
		
		<p><strong>2) Choose your prefered display and theme options</strong></p>
		
		<p><strong>3) Add the full URL to your booking form</strong> (Remember to set this up first)</p>

		<p>The widget will be visible in your sidebar.</p>

		<a class="btn btn-primary" href="<?=get_site_url();?>/wp-admin/widgets.php">Go to your Widgets page</a>
    </form>
</div>

<script>
	jQuery("#val").click(function (){
		var profileURL = jQuery("#webfluential-profile_url").val();
		function urlExists(url, callback){
			jQuery.ajax({
			dataType: 'jsonp',
			url: "http://bookings.webfluential.io/profiles/wp_plugin_ajax_slug_test/" + profileURL +"/jsonp",
			success: function(data){
				if (data[0].status == 1)
				{
					jQuery("#message").empty().append("<span>This is a valid profile</span>").css("color","Green");
				} else {
					jQuery("#message").empty().append("<span>This is not a valid profile</span>").css("color","Red");
				}
			},
			error: function(data) {
				console.log(data);
			}
			});
		}
			urlExists();
			return false;
	})
		
	jQuery(".webfluential-themes img").each(function(){
		jQuery(this).click(function(){
        	jQuery(this).prev().click();
		});
    });	
</script>





