<?php

$sizesJson = file_get_contents( 'img/sizes.json' );
$sizes = json_decode( $sizesJson );
$breakpointsJson = file_get_contents( 'img/breakpoints.json' );
$breakpoints = json_decode( $breakpointsJson );

function responsiveImage( $img, $format, $set, $sizes, $breakpoints, $caption ){
	$img = str_replace( '.'.$format, '', $img );
?>
	<picture class="responsive-img">
		<!--[if IE 9]><video style="display: none;"><![endif]-->
		<source srcset="<?= $img.'-'.$sizes->$set->lg->w.'x'.$sizes->$set->lg->h.'.'.$format; ?>" media="(min-width: <?= $breakpoints->lg; ?>px)">
		<source srcset="<?= $img.'-'.$sizes->$set->md->w.'x'.$sizes->$set->md->h.'.'.$format; ?>" media="(min-width: <?= $breakpoints->md; ?>px)">
		<source srcset="<?= $img.'-'.$sizes->$set->sm->w.'x'.$sizes->$set->sm->h.'.'.$format; ?>" media="(min-width: <?= $breakpoints->sm; ?>px)">
		<!--[if IE 9]></video><![endif]-->
		<img srcset="<?= $img.'-'.$sizes->$set->xs->w.'x'.$sizes->$set->xs->h.'.'.$format; ?>" alt="<?= $caption; ?>">
	</picture>
<?php
} //end responsiveImage

function responsiveBackground( $img, $format, $set, $sizes ){
	$img = str_replace( '.'.$format, '', $img );
	$dimensions = $sizes->$set;
	$lg = $dimensions->lg->w.'x'.$dimensions->lg->h;
	$md = $dimensions->md->w.'x'.$dimensions->md->h;
	$sm = $dimensions->sm->w.'x'.$dimensions->sm->h;
	$xs = $dimensions->xs->w.'x'.$dimensions->xs->h;
	return 'style="background-image:url('.$img.'-'.$xs.'.'.$format.');" data-bg-lg="'.$img.'-'.$lg.'.'.$format.'" data-bg-md="'.$img.'-'.$md.'.'.$format.'" data-bg-sm="'.$img.'-'.$sm.'.'.$format.'" data-bg-xs="'.$img.'-'.$xs.'.'.$format.'"';
}

print( responsiveImage( '/img/test3.jpg', 'jpg', 'hero', $sizes, $breakpoints, 'caption' ) );
//print( '<div class="responsive-bg" '.responsiveBackground( '/img/test3.jpg', 'jpg', 'hero', $sizes, $breakpoints ).'>' );
?>

<style>
.responsive-img {
	margin-bottom: 2em;
}

.responsive-bg {
	background: red;
	width: 100%;
	height: 400px;
	background-size: cover;	
}
</style>

<script src="/wp-includes/js/jquery/jquery.js"></script>
<script>

	function updateResponsiveBackground( element ){
		var width = $( window ).width(),
			breakPoint = 'xs';
		if( width > 1200 ){
			breakPoint = 'lg';
		} else if( width > 992 ){
			breakPoint = 'md';
		} else if( width > 768 ){
			breakPoint = 'sm';
		} else {
			breakPoint = 'xs';
		}
		$( element ).each( function(){
			console.log( $( this ).attr( 'data-bg-'+breakPoint ) );
			$( this ).css( 'background-image', 'url('+$( this ).attr( 'data-bg-'+breakPoint )+')' );
		} )
	}

	$( document ).ready( function(){
		updateResponsiveBackground( '.responsive-bg' );
		$( window ).resize( function(){
			updateResponsiveBackground( '.responsive-bg' );
		} );
	} );

</script>