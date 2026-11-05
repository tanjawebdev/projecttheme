
  </div><!-- #content -->

  <footer id="colophon" class="site-footer">
    <div class="footer-content container-lg">
      <div class="footer-logo">
        <?php
        $logo_path = get_template_directory() . '/assets/images/logo.svg';
        if ( file_exists( $logo_path ) ) :
          ?>
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php esc_attr_e( 'Logo', 'textdomaintomodify' ); ?>">
        <?php endif; ?>
      </div>
      <?php wp_nav_menu( array( 'theme_location' => 'menu-footer', 'menu_id' => 'menu-footer' ) ); ?>
      <div class="footer-text">
        <p> &copy; Tanja Kobler</p>
      </div>
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
