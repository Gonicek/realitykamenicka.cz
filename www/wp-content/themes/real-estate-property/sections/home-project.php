<?php if ( true == get_theme_mod( 'real_estate_property_project_on_off', 'off' ) ) : ?>

<?php 

$real_estate_property_project_count = get_theme_mod('real_estate_property_project_count'); 

$real_estate_property_project_main_heading = get_theme_mod('real_estate_property_project_main_heading');

?>

<section id="home_project" class="py-5">
  <div class="container">

    <?php if ( ! empty( $real_estate_property_project_main_heading ) ): ?>
      <h3 class="mb-4"><?php echo esc_html( $real_estate_property_project_main_heading ); ?>
      </h3>
    <?php endif; ?>
    
    <div class="row">
      <?php for ($i=1; $i <= $real_estate_property_project_count; $i++) {
        
        $real_estate_property_project_image = get_theme_mod('real_estate_property_project_image'.$i);        
        $real_estate_property_project_category = get_theme_mod('real_estate_property_project_category'.$i);

        $real_estate_property_project_heading = get_theme_mod('real_estate_property_project_heading'.$i);

        $real_estate_property_project_content = get_theme_mod('real_estate_property_project_content'.$i);

        $real_estate_property_project_date = get_theme_mod('real_estate_property_project_date'.$i);
        ?>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="box mb-4">
            <div class="box-image">
              <?php if ( ! empty( $real_estate_property_project_image ) ) : ?>
                <img src="<?php echo esc_url( $real_estate_property_project_image ); ?>">
              <?php endif; ?>
              <?php if ( ! empty( $real_estate_property_project_category ) ): ?>
                <span class="post"><?php echo esc_html( $real_estate_property_project_category ); ?></span>
              <?php endif; ?>
            </div>
            <div class="box-content">
              <?php if ( ! empty( $real_estate_property_project_heading ) ): ?>
                <h4 class="title"><?php echo esc_html( $real_estate_property_project_heading ); ?></h4>
              <?php endif; ?>

              <?php if ( ! empty( $real_estate_property_project_content ) ): ?>
                <p><?php echo esc_html( $real_estate_property_project_content ); ?></p>
              <?php endif; ?>

              <?php if ( ! empty( $real_estate_property_project_date ) ): ?>
                <span><?php echo esc_html( $real_estate_property_project_date ); ?></span><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<?php endif; ?>