<?php
/**
 * Template Name: Contact
 */
if (has_post_thumbnail()) {
    $style = 'style="background-image: url(\'' . get_the_post_thumbnail_url('', 'full') . '\')"';
}
get_header(); ?>
    <div id="main">
        <div id="page-title" <?php echo $style; ?>>
            <div id="page-title-inner">
                <h1><?php the_title(); ?></h1>
                <?php travbo_breadcrumbs(); ?>
                <!--END .breadcrumbs-->
            </div>
        </div>
        <div id="map_wrapper">
            <div id='map'></div>
        </div>
        <?php
        if (travbo_get_option('contact_map')) {
            ?>
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
            <script type='text/javascript'>
                function init_map() {
                    var myOptions = {
                        zoom: 14,
                        center: new google.maps.LatLng(<?php echo travbo_get_option('contact_map_latlng')?>),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById('map'), myOptions);
                    marker = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(<?php echo travbo_get_option('contact_map_latlng')?>)
                    });
                    infowindow = new google.maps.InfoWindow({content: '<strong><?php echo travbo_get_option('contact_map_title');?></strong><br><?php echo travbo_get_option('contact_map_desc');?><br>'});
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
                }
                google.maps.event.addDomListener(window, 'load', init_map);
            </script>
            <?php
        }
        ?>
        <div id="main-content">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <div class="clearfix">
                    <div class="contact-info col-md-7">
                        <h2 class="main-block-title">
                            <span><?php _e('Contact Info', 'travbo'); ?></span>
                        </h2>

                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                        <div class="more-info clearfix">

                            <?php
                            if (travbo_get_option('contact_address_enable')) {
                                ?>
                                <div class="info-item col-md-6">
                                    <h3><?php _e('Address', 'travbo'); ?></h3>

                                    <p class="address">
                                        <?php echo nl2br(travbo_get_option('contact_address')); ?>
                                    </p>
                                </div>
                                <?php
                            }
                            if (travbo_get_option('contact_phone_enable')) {
                                ?>
                                <div class="info-item col-md-6">
                                    <h3><?php _e('Phone & Fax', 'travbo'); ?></h3>

                                    <p class="phone-fax">
                                        <?php echo nl2br(travbo_get_option('contact_phone')); ?>
                                    </p>
                                </div>
                                <?php
                            }
                            if (travbo_get_option('contact_email_enable')) {
                                ?>
                                <div class="info-item col-md-6">
                                    <h3><?php _e('Email', 'travbo'); ?></h3>

                                    <p class="email">
                                        <?php echo nl2br(travbo_get_option('contact_email')); ?>
                                    </p>
                                </div>
                                <?php
                            }
                            if (travbo_get_option('contact_social_network')) {
                                ?>
                                <div class="info-item col-md-6">
                                    <h3><?php _e('Social Network', 'travbo'); ?></h3>

                                    <p class="social_network">
                                        <?php travbo_social_link_group(); ?>
                                    </p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="contact-form col-md-5">
                        <h2 class="main-block-title">
                            <span><?php _e('Contact Form', 'travbo'); ?></span>
                        </h2>

                        <form action="">
                            <input type="text" name="contact_name" placeholder="<?php _e('Name', 'travbo'); ?>">
                            <input type="text" name="contact_email"
                                   placeholder="<?php _e('Email Address', 'travbo'); ?>">
                            <label for="contact_message"></label>
                            <textarea name="contact_message" id="contact_message" rows="10"
                                  placeholder="<?php _e('Message', 'travbo'); ?>"></textarea>
                            <button type="submit" name="contact_sent" class="button"><?php _e('send now', 'travbo'); ?></button>
                        </form>
                    </div>
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <!--END #main-content-->
    </div>
    <!--END #main-->
<?php
get_footer();