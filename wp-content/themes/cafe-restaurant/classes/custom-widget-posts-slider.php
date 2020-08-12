<?php

class Cafe_Restaurant_posts_Carousel extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'cafe_restaurant_posts_carousel',
			'description' => __( 'Display Posts in Carousel.', 'cafe-restaurant' ),
			'customize_selective_refresh' => false,
		);
		parent::__construct( 'cafe_restaurant_posts_carousel', __( 'Recent Posts Carousel', 'cafe-restaurant' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$dinprodis = ! empty( $instance['dinprodis'] ) ? $instance['dinprodis'] : '5';

		echo $args['before_widget'];

		if( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		?>
		<div class="di-categy-news-cur owl-carousel owl-theme">

			<?php
			$r = new WP_Query( array(
				'posts_per_page'		=> absint( $dinprodis ),
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> true,
				'post_type'				=> 'post',
				'order'					=> 'DESC',
			) );

			if( $r->have_posts() ) {
				while ( $r->have_posts() ) : $r->the_post();
					?>
					<div class="item">

						<a class="rpctitle" href="<?php the_permalink(); ?>">
							
							<?php if( has_post_thumbnail() ) { ?>
								<div class="postthumbmain_img">
									<?php the_post_thumbnail( 'cafe-restaurant-category-posts-carousel', array( 'class' => 'img-fluid csidproimg' ) ); ?>
								</div>
							<?php } else {
								?>
								<img class="img-fluid csidproimg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" src="<?php echo esc_url( trailingslashit( get_stylesheet_directory_uri() ) . 'assets/images/catsldrdefault360x360.jpg' ); ?>" >
								<?php
							}
							?>

							<p class="rpctitleouttr"><?php the_title(); ?></p>

						</a>

					</div>
					<?php
				endwhile;
				wp_reset_postdata(); // restores the $post global
			}
			?>

		</div>
		<?php
		
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$dinprodis = ! empty( $instance['dinprodis'] ) ? $instance['dinprodis'] : '5';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cafe-restaurant' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'dinprodis' ) ); ?>"><?php esc_html_e( 'Number of news to show:', 'cafe-restaurant' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'dinprodis' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dinprodis' ) ); ?>" type="number" step="1" min="1" value="<?php echo absint( $dinprodis ); ?>" size="3"></p>

		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] 		= sanitize_text_field( $new_instance['title'] );
		$instance['dinprodis'] 	= absint( $new_instance['dinprodis'] );
		return $instance;
	}
}

function Cafe_Restaurant_posts_Carousel_func() {
	register_widget( 'Cafe_Restaurant_posts_Carousel' );
}
add_action( 'widgets_init', 'Cafe_Restaurant_posts_Carousel_func' );
