<?php
/*
Plugin Name: Social Media Slider
Plugin URI: http://www.socratesplugins.com
Description: The social media slider the <a target="_blank" href="http://www.socratestheme.com/?ref=smslider">Socrates Theme</a> creates, but as a widget you can place anywhere. Displays large Twitter, Facebook, LinkedIn, YouTube and RSS icons.  Just use and configure widget once activated.
Author: Flying Monkey Media, Inc.
Version: 1.0
Author URI: http://www.socratesplugins.com
*/
add_action("widgets_init", array('Social_Media_Slider', 'register'));
register_activation_hook( __FILE__, array('Social_Media_Slider', 'activate'));
register_deactivation_hook( __FILE__, array('Social_Media_Slider', 'deactivate'));
class Social_Media_Slider {
  function activate(){
    if ( ! get_option('smallAdOptions')){
	  $data = array( 'twitter' => '' ,'rss' => '', 'facebook' => '', 'linkedin' => '', 'clickbank1' => '', 'clickbank2' => '');
      add_option('smallAdOptions' , $data);
    }
  }
  function deactivate(){
  }
  function control(){
    $data = get_option('smallAdOptions');
	?>
	  <p>Enter full url to your social media profiles. You can add custom html in boxes below to display in rotation.</p><p><label>Widget Title<br><input name="Social_Media_Slider_title"
	type="text" value="<?php echo $data['widgettitle']; ?>" /></label></p>
	  <p><label>Twitter<br><input name="Social_Media_Slider_twitter"
	type="text" value="<?php echo $data['twitter']; ?>" /></label></p>
	  <p><label>RSS<br><input name="Social_Media_Slider_rss"
	type="text" value="<?php echo $data['rss']; ?>" /></label></p>
	  <p><label>Facebook<br><input name="Social_Media_Slider_facebook"
	type="text" value="<?php echo $data['facebook']; ?>" /></label></p>
	<p><label>LinkedIn<br><input name="Social_Media_Slider_linkedin"
	type="text" value="<?php echo $data['linkedin']; ?>" /></label></p>
	<p><label>YouTube<br><input name="Social_Media_Slider_youtube"
	type="text" value="<?php echo $data['youtube']; ?>" /></label></p>
	<p><label>Custom HTML1<br><input name="Social_Media_Slider_html1"
	type="text" value="<?php echo stripslashes($data['html1']); ?>" /></label></p>
	<p><label>Custom HTML2<br><input name="Social_Media_Slider_html2"
	type="text" value="<?php echo stripslashes($data['html2']); ?>" /></label></p>
	  <?php
	   if (isset($_POST['Social_Media_Slider_twitter'])){
	    $data['twitter'] = attribute_escape($_POST['Social_Media_Slider_twitter']);
	    $data['rss'] = attribute_escape($_POST['Social_Media_Slider_rss']);
	    $data['facebook'] = attribute_escape($_POST['Social_Media_Slider_facebook']);
	    $data['linkedin'] = attribute_escape($_POST['Social_Media_Slider_linkedin']);
	    $data['youtube'] = attribute_escape($_POST['Social_Media_Slider_youtube']);
	    $data['html1'] = attribute_escape($_POST['Social_Media_Slider_html1']);
	    $data['html2'] = attribute_escape($_POST['Social_Media_Slider_html2']);
	    $data['widgettitle'] = attribute_escape($_POST['Social_Media_Slider_title']);
	    update_option('smallAdOptions', $data);
	  }
	
  }
  function widget($args){
	?><div>
	<style type="text/css">
		.SocratesSocialMediaSlider { width:220px; height:90px; float:center; overflow:hidden; }
	</style>
	<?php
	$smallAds = get_option("smallAdOptions");
	$imagepath = get_bloginfo('url').'/wp-content/plugins/social-media-slider/images/';
	$count = 0; //foreach ($smallAds as $smallAd) { if ($smallAd != '') {$count++;} }
	if ($smallAds['twitter'] != ''){$count++;}
	if ($smallAds['rss'] != ''){$count++;}
	if ($smallAds['facebook'] != ''){$count++;}
	if ($smallAds['linkedin'] != ''){$count++;}
	if ($smallAds['youtube'] != ''){$count++;}
	if ($smallAds['clickbank1'] != ''){$count++;}
	if ($smallAds['clickbank2'] != ''){$count++;}
	if ($smallAds['html1'] != ''){$count++;}
	if ($smallAds['html2'] != ''){$count++;}
	?>
	<script type="text/javascript">
	    /* <![CDATA[ */
			var oldBox2 = 1; //set the deafault featured village
			var stopAnimation2 = "false";

			var J = jQuery.noConflict();

							J(document).ready(function(){
			//alert("document ready");
				  <?php // use php to write each of the document ready functions
				  for ($i=2;$i<=$count;$i++){
				  echo 'J("#new2'.$i.'").slideUp("fast");';
				  }	?>				   
				automate2();
//alert("social media slider document on load called");
				});
				

			// function for changing the small ad on the home page
			function fade2(newBox2, stopMotion){

				//alert("oldBox = "+oldBox+" newBox ="+newBox);

				if ((newBox2) != oldBox2){

					var villageIn2 = ('#new2'+newBox2); //set div id to a string for animation
					var villageOut2 = ('#new2'+oldBox2);

					J(villageOut2).slideUp("slow", function(){ J(villageIn2).slideDown("slow"); } );

					var activeNav2 = ("box2"+newBox2); //set nav div id to a string for animation
					var oldNav2 = ("box2"+oldBox2);

					oldBox2 = newBox2; //set newBox as the oldBox so we now what to fade out next time
					automate2();
				}
			}; //close fade

			//sets which box to load and to fade
			function setBox2(){
				newBox2 = (oldBox2+1); // adds 1 to the current box
				if (newBox2 >= <?php echo $count + 1 ?>){									   
					newBox2 = 1;
				} 
				fade2(newBox2); // starts the function fade as if it was clicked with a newBox to load
			};

			var animationTimer2 = '';
			function automate2(change){
					if (stopAnimation2 == "false"){
						animationTimer2 = window.setTimeout(function() { setBox2(); }, 7000); // set time
					}
			};

			// pauses animation on mouse over
			function mouseOver2(){ 
				if (stopAnimation2 != "clicked"){
					stopAnimation2 = "true";
					window.clearTimeout(animationTimer2);
				}
			};



			// unpauses animation on mouse out
			function mouseOut2(){ 
				if (stopAnimation2 != "clicked"){
					stopAnimation2 = "false";
					automate2();
				}
			};

		//]]>
       </script>
		</div>
	<?php
    echo $args['before_widget'];
    echo $args['before_title'] . $smallAds['widgettitle'] . $args['after_title'];
    ?>
    <div class="SocratesSocialMediaSlider" onmouseover="mouseOver2()" onmouseout="mouseOut2()">
    <?php
	$count = 1;
			
			if ($smallAds['twitter'] != ''){
				echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
						<a href="'.$smallAds['twitter'].'"><img src="'.$imagepath.'Twitter.png" alt="Twitter"/></a>
					  </div>';
				$count++;
			} 
			
			if ($smallAds['rss'] != ''){
				echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
						<a href="'.$smallAds['rss'].'"><img src="'.$imagepath.'RSS.png" alt="RSS"/></a>
					  </div>';
				$count++;
			}
			
			if ($smallAds['facebook'] != ''){
				echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
						<a href="'.$smallAds['facebook'].'"><img src="'.$imagepath.'Facebook.png" alt="Facebook"/></a>
					  </div>';
				$count++;
			}
			
			if ($smallAds['linkedin'] != ''){
				echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
						<a href="'.$smallAds['linkedin'].'"><img src="'.$imagepath.'Linkedin.png" alt="LinkedIn"/></a>
					  </div>';
				$count++;
			}
			
			if ($smallAds['youtube'] != ''){
											echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
													<a href="'.$smallAds['youtube'].'"><img src="'.$imagepath.'Youtube.png" alt="YouTube"/></a>
												  </div>';
											$count++;
										}
			
			if ($smallAds['html1'] != ''){
				echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
						'.htmlspecialchars_decode(stripslashes($smallAds['html1'])).'
					 </div>';
				$count++;
			}
			if ($smallAds['html2'] != ''){
				echo '<div id="new2'.$count.'" class="smallAd"  style="height:90px;">
						'.htmlspecialchars_decode(stripslashes($smallAds['html2'])).'
					 </div>';
				$count++;
			}

		echo '</div>';
    echo $args['after_widget'];
  }
  function register(){
    register_sidebar_widget('Socrates Social Media Slider', array('Social_Media_Slider', 'widget'));
    register_widget_control('Socrates Social Media Slider', array('Social_Media_Slider', 'control'));
  }
}

?>
