<?php
echo "<div class='wrap-all'>";
$box              = array_filter( (array) $params['box'] );
$img_src          = '';
//Fixed
// $attachment_bg_id = intval( $params['bg-image'] ) ?? 0 ;

//Change to:
if ( isset( $params['bg-image'] ) ) {
	if ( isset( $params['bg-image']['id'] ) ) {
		$attachment_bg_id = $params['bg-image']['id'];
	} else {
		$attachment_bg_id = intval( $params['bg-image'] );
	}
} else {
	$attachment_bg_id = 0;
}

if ( $attachment_bg_id ) {
	$src     = wp_get_attachment_image_src( $attachment_bg_id, array( 1362, 534 ) );
	$img_src = $src ? $src[0] : '';
} elseif ( isset( $params['bg-image']['url'] ) ) {
	$img_src = $params['bg-image']['url'];
}
echo '<div class="intro-box-background" style="background-image: url(' . ( $img_src ) . ')">';
echo '<img src="' . ( $img_src ) . '">';
echo '</div>';
?>

<div class="owl-carousel owl-theme introduction-slider">
	<?php
	foreach ( $box as $key => $params ) {
		$attachment_bg_id = intval( $params['image'] ?? 0 );

		//Fixe
		//$attachment_bg_id = intval( $params['image'] ?? 0 );

		//Change to:
		if ( isset( $params['image'] ) ) {
			if ( isset( $params['image']['id'] ) ) {
				$attachment_bg_id = $params['image']['id'];
			} else {
				$attachment_bg_id = intval( $params['image'] );
			}
		} else {
			$attachment_bg_id = 0;
		}
		?>
		<div class="item">
			<div class="wrapper-box">
 					<div class="single-image">
						<?php echo wp_get_attachment_image( $attachment_bg_id, array( '434', '358' ) ) ?>
					</div>
 				<div class="content-wrapper">
					<?php if ( ! empty( $params['title'] ) ): ?>
						<h3 class="title"><?php echo esc_html( $params['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $params['description'] ) ): ?>
						<p class="description"><?php echo esc_html( $params['description'] ); ?></p>
					<?php endif; ?>
					<?php
					$link_detail = '';
					if ( isset($params['read_more'] ) ) {
						if ( isset( $params['read_more']['url'] ) && ! empty( $params['read_more']['url'] ) ) {
							$link_detail           = $params['read_more'];
							$link_detail['target'] = ( $params['read_more']['is_external'] == 'on' ) ? ' target="_blank"' : '';
							$link_detail['rel']    = ( $params['read_more']['nofollow'] == 'on' ) ? ' rel="nofollow"' : '';
							$link_output           = $link_detail['target'] . $link_detail['rel'];
							$link_detail['title']  = isset( $params['read_more_title'] ) ? $params['read_more_title'] : '';
						} elseif ( ! is_array( $params['read_more'] ) ) {
							$link_detail           = vc_build_link( $params['read_more'] );
							$link_detail['target'] = $link_detail['target'] ? ' target="' . esc_attr( $link_detail['target'] ) . '"' : '';
							$link_detail['rel']    = $link_detail['rel'] ? ' rel="' . esc_attr( $link_detail['rel'] ) . '"' : '';
							$link_output           = $link_detail['target'] . $link_detail['rel'];
						}
					}

					if ( $link_detail ) {
						echo '<a href="' . esc_url( $link_detail['url'] ) . '"' . ( $link_output ) . ' class="more-detail">' . esc_html( $link_detail['title'] ) . '</a>';
						$link_after = '</a>';
					}
					?>
				</div>
			</div>
		</div>

		<?php
	}
	?>

</div>
</div>
