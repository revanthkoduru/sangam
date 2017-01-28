<?php if (!function_exists('enigma_parallax_info_page')) {
	function enigma_parallax_info_page() {
	$page1=add_theme_page(__('Welcome to Enigma Parallax', 'enigma-parallax'), __('Pro Themes & Plugin', 'enigma-parallax'), 'edit_theme_options', 'enigma-parallax', 'parallax_display_theme_info_page');
	
	add_action('admin_print_styles-'.$page1, 'parallax_admin_info');
	}	
}
add_action('admin_menu', 'enigma_parallax_info_page');

function parallax_admin_info(){
	// CSS
	wp_enqueue_style('bootstrap',  get_template_directory_uri() .'/css/bootstrap.css');
	wp_enqueue_style('admin',  get_template_directory_uri() .'/core/admin/admin-themes.css');
	wp_enqueue_style('font-awesome',  get_template_directory_uri() .'/css/font-awesome-4.4.0/css/font-awesome.css');

	//JS
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.js');
	wp_enqueue_script('script-menu', get_template_directory_uri().'/core/admin/js/script.js');
	
} 
if (!function_exists('parallax_display_theme_info_page')) {
	function parallax_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		
<div class="wrapper">
<!-- Header -->
<header>
<div class="container-fluid p_header">
	<div class="container">
		<div class="row p_head">
		<div class="col-md-4"></div>
			<div class="col-md-4">
			<img style="width:268px;height:193px" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo">
				
			</div>
		<div class="col-md-4"></div>	
		</div>
	</div>
</div>
<nav class="navbar navbar-default menu">
		<div class="container-fluid">
			<div class="container">
				<div class="row spa-menu-head">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					  </button>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li class="theme-menu active" id="theme"><button class="btn tp">Themes</button></li>
							<li class="theme-menu" id="plugin"><button class="btn tp">Plugins</button></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<!-- Header -->
<!-- Themes & Plugin -->
<div class="container-fluid space p_front theme active">
	<div class="container">	
			<div class="row p_head theme">
				<div class="col-xs-12 col-md-8 col-sm-6">
					<h1 class="section-title">WordPress Themes</h1>
				</div>
			</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Weblizar.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Weblizar- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						A Responsive WordPress Theme for Business & Corporate Sector’s . Clean And Eye Catching Design with Crisp Look..</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>29</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/weblizar-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/weblizar-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Chronicle.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Chronicle- Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Chronicle is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Cool Blog Layout and full width page also present.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>35</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/chronicle-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/chronicle-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Creative.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Creative- Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Creative is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Competible with WPML & Woo Commerce Plugin.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>41</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/creative-premium/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/creative-premium/">Buy Now</a>
				</div>				
			</div>
		</div>		
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Enigma.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Enigma- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Enigma is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Cool Blog Layout and full width page also present.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/enigma-premium/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/enigma-premium/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Healthcare.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Healthcare- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, Business,
						WordPress, Corporate, etc…</p>
						<div>
						<p><strong>Description: </strong>
						Healthcare is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Cool Blog Layout and full width page also present.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>41</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/healthcare-premium/">Detail</a>
					<a class="btn btn-success btn-lg" href="http://demo.weblizar.com/healthcare-premium/">Buy Now</a>
				</div>				
			</div>
		</div>		
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Incredible.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Incridible- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Incredible is an incredibly superfine multipurpose responsive theme coded & designed with a lot of care and love. Incredible is Responsive and flexible based on BOOTSTRAP CSS framework.</p>
						</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>19</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/incredible-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/incredible-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>	
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Guardian.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Guardian- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Guardian is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Cool Blog Layout and full width page also present.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/guardian-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/guardian-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>	
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Green lantern.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Green Lantern- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						A Responsive WordPress Theme for Business & Corporate Sector’s . Clean And Eye Catching Design with Crisp Look..</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>29</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/green-lantern-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/green-lantern-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!----Plugin----->
<div class="container-fluid space p_front plugin">
	<div class="container">
		<div class="row p_head theme">
			<div class="col-xs-12 col-md-8 col-sm-6">
				<h1 class="section-title">WordPress Plugins</h1>
			</div>
		</div>
		
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Comingsoon.jpg" class="img-responsive" alt="Coming-Soon-Page"/>
					
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Responsive Coming Soon Page</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Bootstrap Based Responsive Plugin Settings Panel</li>
						<li>Compatible With Most WordPress Theme</li>
						<li>Image background</li>
						<li>Color background</li>
						<li>Multiple Color Skins Selection</li>
						<li>News Letter Subscriber Forms</li>
						<li>Subscriber Notification</li>
						<li>Export & Import Subscribers List</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number"><span>FREE</span></span>
				</div>
				<div class="btn-group-vertical">
					<a target="_blank" class="btn btn-primary btn-lg" href="https://wordpress.org/plugins/responsive-coming-soon-page/">Download</a>
					<!-- <a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/about-author-pro/">Buy Now</a> -->
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/about-author.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">About Author Pro- Display Profile In Various Style</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Author Design Templates</li>
						<li>Social Media Profiles</li>
						<li>General & Google Fonts</li>
						<li>Multiple Author Image Layout</li>
						<li>Responsive Design</li>
						<li>Multiple Author Widgets</li><li>Multiple Author Shortcode, and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>15</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/about-author-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/about-author-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/gallery-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Gallery Pro- Gallery Layout with Various Fonts</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Gallery Layout</li>
						<li>Color Scheme</li>
						<li>Light Box</li>
						<li>All Gallery Shortcode</li>
						<li>Single Gallery Shortcode</li> 
						<li>Number of Gallery Layout</li>
						<li>Number of Hover Color and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>9</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/gallery-pro-by-weblizar/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/instagram-gallery-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Instagram Gallery Pro- Display Instagram Images</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Responsive Design<li>
						<li>Animation Effects</li>
						<li>Number of LightBox Style</li>
						<li>Number of Gallery Layout</li>
						<li>Image Style Layout</li>
						<li>Profile Backgound Image Option</li>
						<li>Multiple Instagram Shortcode etc..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>15</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/instagram-gallery-pro-demo/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/instagram-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/ultimate-image-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Ultimate Responsive Image Slider Pro- Perfect Responsive Image Slider Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Responsiveness</li>
						<li>Full Screen Slideshow</li>
						<li>Thumbnail Slider</li>
						<li>All Gallery Shortcode</li>
						<li>Drag and Drop image Position</li>
						<li>Shortcode Button on post or page and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>21</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/ultimate-responsive-image-slider-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/ultimate-responsive-image-slider-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Photo Video Link Gallery Pro- Display Hover Animation & Lightbox</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Image Hover Animation</li>
						<li>Single Gallery Shortcode</li>
						<li>Number of Hover Animation</li>
						<li>Number of Gallery Layout</li>
						<li>Shortcode Button on post or page</li>
						<li>Video Gallery and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>16</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/photo-video-link-gallery-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/photo-video-link-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/flicker-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Flickr Album Gallery Pro- Plublish Flickr Albums On WordPress Blog Site</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Image Hover Animation</li>
						<li>All Gallery Shortcode</li>
						<li>Single Gallery Shortcode</li>
						<li>Number of Hover Animation</li>
						<li>Number of Light Styles</li>
						<li>Unique settings for each gallery and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>15</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/flickr-album-gallery-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/flickr-album-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/responsive-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Responsive Portfolio Pro- Perfect Responsive Portfolio Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Image Hover Animation</li>
						<li>Number of Hover Color</li>
						<li>Number of Font Style</li>
						<li>Number of Lightbox Styles</li>
						<li>Drag and Drop image Position</li>
						<li>Multiple Image uploader and so on..<li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>19</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/responsive-portfolio-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/responsive-portfolio-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/lightbox-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Lightbox Slider Pro- A Complete Lightbox Gallery Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Gallery Layout</li>
						<li>Hover Color</li>
						<li>Hover Color Opacity</li>
						<li>Caption Font Style</li>
						</li>Light Box</li>
						<li>All Gallery Shortcode</li>
						<li>Single Gallery Shortcode, and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>12</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/lightbox-slider-pro-demo/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/lightbox-slider-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/responsive-photo-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Responsive Photo Gallery Pro- A Highly Animated Image Gallery Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Number of Lightbox Styles</li>
						<li>Drag and Drop image Position</li>
						<li>Multiple Image uploader</li>
						<li>Shortcode Button on post or page</li>
						<li>Unique settings for each gallery</li>
						<li>Hide/Show gallery Title and label and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>10</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/responsive-photo-gallery-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/responsive-photo-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/recent-post-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Recent Related Post And Page WordPress Plugin- Fully Responsive Plugin For WordPress Blog</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Multiple Template</li>
						<li>select feature image</li>
						<li>8 Border style</li>
						<li>8 post Status, 2 Post Type</li>
						<li>500+ Google Font for Template and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>10</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/recent-related-post-and-page-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/recent-related-post-and-page-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
	</div>
</div>
	<div id="theme-author">
		<p><?php printf(__('%1s is proudly brought to you by %2s. If you like this WordPress theme, %3s.', 'enigma-parallax'),
			$theme_data->Name,
			'<a target="_blank" href="https://weblizar.com/" title="weblizar">Weblizar</a>',
			'<a target="_blank" href="https://wordpress.org/support/view/theme-reviews/weblizar" title="Enigma Parallax Review">' . __('rate it', 'enigma-parallax') . '</a>'); ?>
		</p>
	</div>
</div>
<?php
	}
}
?>