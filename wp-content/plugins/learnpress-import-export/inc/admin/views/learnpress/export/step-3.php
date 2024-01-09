<?php
/**
 * Admin Export step 3 view.
 *
 * @since 3.0.0
 */

$courses = LP_Request::get_param( 'courses', [] );
?>

<div id="exporting" class="hide-if-js">
	<span class="dashicons dashicons-image-rotate"></span>
	<?php _e( 'Exporting...', 'learnpress-import-export' ); ?>
</div>

<div id="exported">
	<?php _e( 'Exported', 'learnpress-import-export' ); ?>
	<?php if ( ! empty( $courses ) ) { ?>
		<?php foreach ( $courses as $course_id ) : ?>
			<input type="hidden" name="courses[]" value="<?php echo esc_attr( $course_id ); ?>"/>
		<?php endforeach; ?>
	<?php } ?>
	<input type="hidden" name="step" value="<?php echo esc_attr( LP_Request::get_param( 'step' ) ); ?>"/>
	<input type="hidden" name="exporter" value="<?php echo esc_attr( LP_Request::get_param( 'exporter' ) ); ?>"/>
	<input type="hidden" name="download_export" value="<?php echo esc_attr( LP_Request::get_param( 'download_export' ) ); ?>"/>
	<input type="hidden" name="learn-press-export-file-name"
		value="<?php echo esc_attr( LP_Request::get_param( 'learn-press-export-file-name' ) ); ?>"/>
	<p>
		<button class="button button-primary" id="lpie-button-cancel">
			<?php _e( 'Export new', 'learnpress-import-export' ); ?></button>
		<button class="button" id="lpie-export-again">
			<?php _e( 'Export again!', 'learnpress-import-export' ); ?></button>
	</p>
</div>
<?php if ( ! empty( LP_Request::get_param( 'download_url' ) ) ) { ?>
	<script type="text/javascript">
		typeof jQuery !== 'undefined' && jQuery(function ($) {
			window.location.href = '<?php echo admin_url( 'admin.php?page=learnpress-import-export' ) . '&download-file=' . LP_Request::get_param( 'download_url' ) . '&alias=' . LP_Request::get_param( 'download_alias' ) . '&nonce=' . wp_create_nonce( 'lpie-download-file' ); ?>';
		})
	</script>
<?php } ?>
