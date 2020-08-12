	
		</div> <!-- end header div 3 -->
	</div> <!-- end header div 2 -->
</div> <!-- end header div 1 -->


<div id="footerouter" class="footernavbarouter">
	<?php
	if( class_exists( 'Mega_Menu' ) && max_mega_menu_is_enabled( 'footer-menu' ) ) {
		wp_nav_menu( array( 'theme_location' => 'footer-menu' ) );
	} else {
		wp_nav_menu( array(
			'theme_location'    => 'footer-menu',
			'depth'             =>  1,
			'container'         => 'ul',
			'container_id'      => 'footer-navbarr',
			'container_class'   => 'footer-navbarc',
			'menu_id' 			=> 'footer-menu-menu',
			'menu_class'        => 'footer-nav-footer-menu',
		));
	}
	?>
</div>

<?php get_template_part( 'template-parts/footer', 'widgets' ); ?>

<?php get_template_part( 'template-parts/footer', 'copyright' ); ?>

<?php get_template_part( 'template-parts/footer', 'backtotop' ); ?>

<?php
if( get_theme_mod( 'site_layout', '1' ) == '3' ) {
	?>
	</div> <!-- End boxed layout -->
	<?php
}
?>

<?php wp_footer(); ?>
</body>
</html>
