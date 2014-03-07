<?php
/*
Template Name: DJ Gigs Page
*/
?>

<style type="text/css">
 
.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	/*margin: 20px 0;*/
}
 
</style>

<?php get_header(); ?>

		<?php get_sidebar(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="twelvecol first clearfix" role="main">

						<h1 class="page-title"><?php the_title(); ?></h1>

						<table class="tg tg-th">
							<tbody>
									  <tr class="tg-header-row">
									    <th class="tg-031e tg-date">Date</th>
									    <th class="tg-031e djgig-event-image-header">Image</th>
									    <th class="tg-031e tg-title">Event Title</th>
									    <th class="tg-031e tg-venue">Venue</th>
									    <th class="tg-031e tg-city">City</th>
									    <th class="tg-031e tg-country">Country</th>
									    <th class="tg-expand-heading">See More</th>
									  </tr>
							</tbody>
							</table>
					
							<?php	// WP_Query arguments
								$args = array (
									'post_type'              => 'djgig',
									'post_status'            => 'publish',
									'pagination'             => true,
									'posts_per_page'         => '10',
								);
								
								// The Query
								$query = new WP_Query( $args );
								
								// The Loop
								if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
									<table class="tg tg-info">
									<tbody>
									  <tr class="dj-gig-row">
									    <td class="tg-031e tg-date"><?php $date = DateTime::createFromFormat('Ymd', get_field('djgig_date'));
echo $date->format('Y-m-d'); ?></td>
									    <td class="djgig-event-image-header"><a href="<?php the_field('djgig_image_1'); ?>"><img class="djgigimage" src="<?php the_field('djgig_image_1'); ?>" height="48px" width="48px"/></a></td>
									    <td class="tg-031e tg-title"><strong><?php the_title(); ?></strong></td>
									    <td class="tg-031e tg-venue"><a href="<?php the_field('djgig_venue_url'); ?>"><?php the_field('djgig_venue_name'); ?></a></td>
									    <td class="tg-031e tg-city"><?php the_field('djgig_venue_city'); ?>, <?php the_field('djgig_venue_state'); ?></td>
									    <td class="tg-031e tg-country"><?php the_field('djgig_venue_country'); ?></td>
									    <td class="tg-expand"><a class="djgig-table-trigger" href="#"><span>+</span></a></td>
									  </tr>
									  </tbody>
									  </table>

									  <table id="post-<?php the_ID(); ?>" class="tg gig-table tg-main">
									  <tr class="tg-image-info">
									    <td class="tg-031e djgig-image1" colspan="1"><div><img class="djgigimage" src="<?php the_field('djgig_image_1'); ?>" /></div></td>
									    <td class="tg-031e tg-info" colspan="4" rowspan="1"><?php the_field('djgig_info'); ?></td>
									  </tr>
									  <?php if( get_field('djgig_image_2') ): ?>
									  <tr>
									    <td class="tg-031e"><?php the_field('djgig_image_2'); ?></td>
									  </tr>
									  <?php endif; ?>
									  <tr>
									    <td class="tg-031e djgig-date-time" colspan="5"><span class="djgig-date"><?php $date = DateTime::createFromFormat('Ymd', get_field('djgig_date'));
echo $date->format('l jS F Y'); ?></span> <span class="separator">|</span> <span class="djgig-time"><?php the_field('djgig_start_time'); ?>-<?php the_field('djgig_end_time'); ?></span> <?php if( get_field('djgig_ticket_price') ): ?><span class="separator">|</span> <?php the_field('djgig_ticket_price'); ?><?php endif; ?></td>
									   </tr>
									   <tr>
									   <td colspan="6">
									   <?php 
 
										$location = get_field('djgig_google_map');
										 
										if( !empty($location) ):
										?>
										<div class="acf-map">
											<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
										</div>
										<?php endif; ?>
										</td>					   
									  </tr>
									  <tr>
									    <td class="tg-031e tg-border"><a href="<?php the_field('djgig_venue_url'); ?>"><?php the_field('djgig_venue_name'); ?></a></td>
									    <td class="tg-031e tg-border"><?php the_field('djgig_venue_address1'); ?> <?php the_field('djgig_venue_address2'); ?> <?php the_field('djgig_venue_city'); ?>,
									    <?php the_field('djgig_venue_state'); ?> <?php the_field('djgig_venue_postcode'); ?> <?php the_field('djgig_venue_country'); ?></td>
									  </tr>
									  
									  <tr>
									  <?php if( get_field('djgig_ticket_price') ): ?>
									    <td class="tg-031e">Tickets: <?php the_field('djgig_ticket_price'); ?></td>
									   <?php endif; ?>
									   <?php if( get_field('djgig_ticket_url') ): ?>
									    <td class="tg-031e" colspan="4">Get Tickets: <?php the_field('djgig_ticket_url'); ?></td>
									   <?php endif; ?>
									  </tr>
									 
									  <?php if( get_field('djgig_event_url_1') ): ?>
									  <tr>
									    <td class="tg-031e">Event URL:</td>
									    <td class="tg-031e" colspan="4"><?php the_field('djgig_event_url_1'); ?></td>
									  </tr>
									  <?php endif; ?>
									  <?php if( get_field('djgig_event_url_2') ): ?>
									  <tr>
									    <td class="tg-031e">Event URL:</td>
									    <td class="tg-031e" colspan="4"><?php the_field('djgig_event_url_2'); ?></td>
									  </tr>
									  <?php endif; ?>
									</table>
 

									<?php }

								} else { ?>

									<h3>Sorry, no gigs to show right now.</h3>

								<?php }
								
								// Restore original Post Data
								wp_reset_postdata(); ?>
							

						</div>

				</div>

			</div>

<?php get_footer(); ?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
(function($) {
 
/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/
 
function render_map( $el ) {
 
	// var
	var $markers = $el.find('.marker');
 
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
 
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
 
	// add a markers reference
	map.markers = [];
 
	// add markers
	$markers.each(function(){
 
    	add_marker( $(this), map );
 
	});
 
	// center map
	center_map( map );
 
}
 
/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/
 
function add_marker( $marker, map ) {
 
	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
 
	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});
 
	// add to array
	map.markers.push( marker );
 
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
 
		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {
 
			infowindow.open( map, marker );
 
		});
	}
 
}
 
/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/
 
function center_map( map ) {
 
	// vars
	var bounds = new google.maps.LatLngBounds();
 
	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){
 
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
 
		bounds.extend( latlng );
 
	});
 
	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 14 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

	$(document).on('mouseenter', 'body', function() {
        google.maps.event.trigger(map, 'resize');
        map.setCenter( bounds.getCenter() );
        map.setZoom( 14 );
    });
 

 		$(document).on('click', '.acf-map', function() {
        google.maps.event.trigger(map, 'resize');
        map.setCenter( bounds.getCenter() );
        map.setZoom( 16 );
    });
}
 
/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
 
$(document).ready(function(){
 
	$('.acf-map').each(function(){
 
		render_map( $(this) );
 
	});

});
 
})(jQuery);
</script>
<script>

jQuery(document).ready(function($){

	$('.djgig-table-trigger').click(function(e) {

		// grab next instance of hidden table within WP loop (using nextInDOM function)
		var nextInst = nextInDOM('.tg-main', $(this));
		// var nextTgInfo = nextInDOM('.tg-info', nextInst);

		// if table is visible, change plus sign to minus
		var txt = nextInst.is(':visible') ? '+' : '-';

		// if table is visible change table heading
		var th = nextInst.is(':visible') ? 'See More' : 'See Less';

		// show/hide next instance of table
		nextInst.slideToggle(300);



		// when we show a table, hide all other tables
		$('.tg-main').not(nextInst).hide();

		// toggle trigger text
		$(this).text(txt);

		// toggle 'See More' text (a tough DOM traversal :)
		// $(this).closest('tr').prev('tr').find('th.tg-expand-heading').text(th);  // this is the one...whew!
		
		// toggle heading text; we only have one table heading now so easy peasy
		$('th.tg-expand-heading').text(th);

		// $("#sidebar1").toggleClass("tg-main-height"); // toggleClass backup
		
		
  		if($(this).text() == "-") {

  			// toggle #sidebar1 height when we add more content; equalHeight doesn't work here
  			$("#sidebar1").animate({height:'+=500'}, 300);

  			// remove extra margin once expanded
  			$(this).closest('table.tg-th').css('margin-bottom', '0');

  			// only the expanded table should have minus sign
  			$('.djgig-table-trigger').not(this).text('+');

  			// add top border to table when table above is expanded
  			nextInst.nextAll('.tg-info:first').css('border-top','1px solid #ddd');

  			// scroll to expanded table
  			$('body').scrollTo(this);

		} else {

			// remove extra height once collapsed
			$("#sidebar1").animate({height:'-=500'}, 300);

			// restore extra margins (maybe not needed now)
			$(this).closest('table.tg-th').css('margin-bottom', '2em');

			// remove top border when no tables are expanded
			nextInst.nextAll('.tg-info:first').css('border-top','0');

		}
	
	return false; // prevent scroll to top on click; e.preventDefault didn't work here

	});

});

// add default image if our event doesn't have one
jQuery(document).ready(function($){

	$("img.djgigimage[src='']").attr('src','http://joshuaiz:8888/images/calendar_blue.png').show();

});

// add alternating background to table rows. Can't use pure css for this because of discrete/nested tables
jQuery(document).ready(function($){
	$('.dj-gig-row').filter(':odd').css('background', '#f5f5f5');
});

</script>




