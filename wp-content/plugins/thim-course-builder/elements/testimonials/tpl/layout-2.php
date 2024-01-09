<?php

$items_visile = is_array($params['testimonials']) ? count($params['testimonials']) : 3;

?>

<div class="slider testimonial-slider" data-itemsvisible="<?php echo esc_attr($items_visile); ?>">
	<?php foreach ( $params['testimonials'] as $key => $testimonial ) : ?>
		<div class="item">
			<div class="content">
				<div class="image">
					<?php
					$thumbnail_id = 0;
					if( ! empty($testimonial['image'] )) {
						$thumbnail_id = $testimonial['image']['id'] ?? $testimonial['image'];
					}

 					thim_thumbnail( $thumbnail_id, '130x130', 'attachment', false, 'no-lazy' );
					?>
				</div>

				<div class="user-info">
					<?php if ( isset( $testimonial['website'] ) ) : ?>
						<a href="<?php echo esc_html( $testimonial['website'] ) ?>" class="title" target="_blank"><?php echo esc_html( $testimonial['name'] ?? '' ); ?></a>
					<?php else: ?>
						<?php echo esc_html( $testimonial['name'] ?? '' ); ?>
					<?php endif; ?>
					<?php if ( isset( $testimonial['regency'] ) ) : ?>
						<span class="regency"><?php echo esc_html( $testimonial['regency'] ) ?></span>
					<?php endif; ?>
				</div>

				<?php if ( isset( $testimonial['social_links'] ) ):
					$social_links = vc_param_group_parse_atts( $testimonial['social_links'] );
					if ( $social_links ): ?>
						<div class="thim-sc-social-links">
							<ul class="socials">
								<?php foreach ( $social_links as $index => $social ):
									if ( isset( $social['link'] ) && isset( $social['name'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $social['link'] ) ?>"><?php echo esc_html( $social['name'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				<?php else: ?>
					<div class="thim-sc-social-links">
							<ul class="socials">
								<?php if($testimonial['show_facebook'] == 'yes' ): ?>
									<?php if ( isset( $testimonial['link_facebook'] ) && isset( $testimonial['name_social_facebook'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $testimonial['link_facebook'] ) ?>"><?php echo esc_html( $testimonial['name_social_facebook'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if($testimonial['show_dribbble'] == 'yes' ): ?>
									<?php if ( isset( $testimonial['link_dribbble'] ) && isset( $testimonial['name_social_dribbble'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $testimonial['link_dribbble'] ) ?>"><?php echo esc_html( $testimonial['name_social_dribbble'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if($testimonial['show_instagram'] == 'yes' ): ?>
									<?php if ( isset( $testimonial['link_instagram'] ) && isset( $testimonial['name_social_instagram'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $testimonial['link_instagram'] ) ?>"><?php echo esc_html( $testimonial['name_social_instagram'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if($testimonial['show_twitter'] == 'yes' ): ?>
									<?php if ( isset( $testimonial['link_twitter'] ) && isset( $testimonial['name_social_twitter'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $testimonial['link_twitter'] ) ?>"><?php echo esc_html( $testimonial['name_social_twitter'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if($testimonial['show_youtube'] == 'yes' ): ?>
									<?php if ( isset( $testimonial['link_youtube'] ) && isset( $testimonial['name_social_youtube'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $testimonial['link_youtube'] ) ?>"><?php echo esc_html( $testimonial['name_social_youtube'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>

								<?php if($testimonial['show_google'] == 'yes' ): ?>
									<?php if ( isset( $testimonial['link_google'] ) && isset( $testimonial['name_social_google'] ) ): ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( $testimonial['link_google'] ) ?>"><?php echo esc_html( $testimonial['name_social_google'] ); ?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>
							</ul>
						</div>
				<?php endif; ?>

				<div class="description"><?php echo esc_html( $testimonial['content'] ?? '' ); ?></div>

			</div>
		</div>
	<?php endforeach; ?>
</div>