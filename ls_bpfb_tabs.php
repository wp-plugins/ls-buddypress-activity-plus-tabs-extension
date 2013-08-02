<?php
/**
 * @author Stergatu Eleni 
 * @version 2, 2/8/2013
 * Adds tabs in group for Links, Images and Videos uploaded via buddypress activity plus plugin 
 */
if (class_exists('BP_Group_Extension')) : // Recommended, to prevent problems during upgrade or when Groups are disabled

    class BP_activity_plus_links_tab_Extension extends BP_Group_Extension {

        var $visibility = 'private';
        var $format_notification_function;
        var $enable_edit_item = false;
        var $enable_create_step = false;
        var $admin_metabox_context = 'side'; // The context of your admin metabox. See add_meta_box()
        var $admin_metabox_priority = 'default'; // The priority of your admin metabox. See add_meta_box()

        function __construct() {
            global $bp;
            if (bp_has_activities('search_terms=bpfb_link')) {
                global $activities_template;
            }


            $nav_page_name = __("Links");

            $this->name = !empty($nav_page_name) ? $nav_page_name : __("Links");
            $this->slug = 'links';

            /* For internal identification */
            $this->id = 'group_links';


            if ($bp->groups->current_group) {
                $num = !empty($activities_template->activity_count) ? $activities_template->activity_count : '0';
                $this->nav_item_name = $this->name . ' <span>(' . $num . ')</span>';
                $this->nav_item_position = 32;
            }

            $this->admin_name = !empty($nav_page_name) ? $nav_page_name : __("Links");

            $this->admin_slug = 'links';
        }

        function display() {
            ?>
            <div class="info-group">
                <h4><?php echo esc_attr($this->name) ?></h4>
                <?php do_action('bp_before_activity_loop'); ?>
                <?php if (bp_has_activities('search_terms=bpfb_link')) :
                    ?>

                    <?php /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */ ?>
                    <noscript>
                    <div class="pagination">
                        <div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
                        <div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
                    </div>
                    </noscript>

                    <?php if (empty($_POST['page'])) : ?>

                        <ul id="activity-stream" class="activity-list item-list">

                        <?php endif; ?>

                        <?php while (bp_activities()) : bp_the_activity(); ?>

                            <?php locate_template(array('activity/entry.php'), true, false); ?>

                        <?php endwhile; ?>

                        <?php if (bp_activity_has_more_items()) : ?>

                            <li class="load-more">
                                <a href="#more"><?php _e('Load More', 'buddypress'); ?></a>
                            </li>

                        <?php endif; ?>

                        <?php if (empty($_POST['page'])) : ?>

                        </ul>

                    <?php endif; ?>

                <?php else : ?>

                    <div id="message" class="info">
                        <p><?php _e('Sorry, there was no activity found. Please try a different filter.', 'buddypress'); ?></p>
                    </div>

                <?php endif; ?>

                <?php do_action('bp_after_activity_loop'); ?>

                <form action="" name="activity-loop-form" id="activity-loop-form" method="post">

                    <?php wp_nonce_field('activity_filter', '_wpnonce_activity_filter'); ?>

                </form>
            </div>
            <?php
        }

    }

    bp_register_group_extension('BP_activity_plus_links_tab_Extension');
    ?>

    <?php

    class BP_activity_plus_videos_tab_Extension extends BP_Group_Extension {

        var $visibility = 'private';
        var $format_notification_function;
        var $enable_edit_item = false;
         var $enable_create_step = false;
        var $admin_metabox_context = 'side'; // The context of your admin metabox. See add_meta_box()
        var $admin_metabox_priority = 'default'; // The priority of your admin metabox. See add_meta_box()

        function __construct() {
            global $bp;
            if (bp_has_activities('search_terms=bpfb_video')) {
                global $activities_template;
            }


            $nav_page_name = __("Videos");

            $this->name = !empty($nav_page_name) ? $nav_page_name : __("Videos");
            $this->slug = 'videos';

            /* For internal identification */
            $this->id = 'group_videos';
            // $this->format_notification_function = 'bp_group_documents_format_notifications';

            if ($bp->groups->current_group) {
                $num = !empty($activities_template->activity_count) ? $activities_template->activity_count : '0';
                $this->nav_item_name = $this->name . ' <span>(' . $num . ')</span>';
                $this->nav_item_position = 34;
            }

            $this->admin_name = !empty($nav_page_name) ? $nav_page_name : __("Videos");
            ;
            $this->admin_slug = 'videos';
        }

        function display() {
            ?>
            <div class="info-group">
                     <h4><?php echo esc_attr($this->name) ?></h4>
                <?php do_action('bp_before_activity_loop'); ?>
                <?php // add_thickbox(); ?>
                <?php if (bp_has_activities('search_terms=bpfb_video')) :
                    ?>

                    <?php /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */ ?>
                    <noscript>
                    <div class="pagination">
                        <div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
                        <div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
                    </div>
                    </noscript>

                    <?php if (empty($_POST['page'])) : ?>

                        <ul id="activity-stream" class="activity-list item-list">

                        <?php endif; ?>

                        <?php while (bp_activities()) : bp_the_activity(); ?>

                            <?php locate_template(array('activity/entry.php'), true, false); ?>

                        <?php endwhile; ?>

                        <?php if (bp_activity_has_more_items()) : ?>

                            <li class="load-more">
                                <a href="#more"><?php _e('Load More', 'buddypress'); ?></a>
                            </li>

                        <?php endif; ?>

                        <?php if (empty($_POST['page'])) : ?>

                        </ul>

                    <?php endif; ?>

                <?php else : ?>

                    <div id="message" class="info">
                        <p><?php _e('Sorry, there was no activity found. Please try a different filter.', 'buddypress'); ?></p>
                    </div>

                <?php endif; ?>

                <?php do_action('bp_after_activity_loop'); ?>

                <form action="" name="activity-loop-form" id="activity-loop-form" method="post">

                    <?php wp_nonce_field('activity_filter', '_wpnonce_activity_filter'); ?>

                </form>
            </div>
            <?php
        }

    }

    bp_register_group_extension('BP_activity_plus_videos_tab_Extension');

    class BP_activity_plus_images_tab_Extension extends BP_Group_Extension {

        var $visibility = 'private';
        var $format_notification_function;
        var $enable_edit_item = false;
         var $enable_create_step = false;
        var $admin_metabox_context = 'side'; // The context of your admin metabox. See add_meta_box()
        var $admin_metabox_priority = 'default'; // The priority of your admin metabox. See add_meta_box()

        function __construct() {
            global $bp;
            if (bp_has_activities('search_terms=bpfb_image')) {
                global $activities_template;
            }

            $nav_page_name = __("Images");

            $this->name = !empty($nav_page_name) ? $nav_page_name : __("Images");
            $this->slug = 'images';

            /* For internal identification */
            $this->id = 'group_images';

            if ($bp->groups->current_group) {
                $num = !empty($activities_template->activity_count) ? $activities_template->activity_count : '0';
                $this->nav_item_name = $this->name . ' <span>(' . $num . ')</span>';
                $this->nav_item_position = 33;
            }

            $this->admin_name = !empty($nav_page_name) ? $nav_page_name : __("Images");
            $this->admin_slug = 'images';
        }

        
        /** 
         * @version 2
         * Add thickbox 
         */
        function display() {
            ?>
            <div class="info-group">
                <h4><?php echo esc_attr($this->name) ?></h4>
                <?php do_action('bp_before_activity_loop'); ?>
                <?php add_thickbox(); ?>
                <?php if (bp_has_activities('search_terms=bpfb_image')) :
                    ?>

                    <?php /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */ ?>
                    <noscript>
                    <div class="pagination">
                        <div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
                        <div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
                    </div>
                    </noscript>

                    <?php if (empty($_POST['page'])) : ?>

                        <ul id="activity-stream" class="activity-list item-list">

                        <?php endif; ?>

                        <?php while (bp_activities()) : bp_the_activity(); ?>

                            <?php locate_template(array('activity/entry.php'), true, false); ?>

                        <?php endwhile; ?>

                        <?php if (bp_activity_has_more_items()) : ?>

                            <li class="load-more">
                                <a href="#more"><?php _e('Load More', 'buddypress'); ?></a>
                            </li>

                        <?php endif; ?>

                        <?php if (empty($_POST['page'])) : ?>

                        </ul>

                    <?php endif; ?>

                <?php else : ?>

                    <div id="message" class="info">
                        <p><?php _e('Sorry, there was no activity found. Please try a different filter.', 'buddypress'); ?></p>
                    </div>

                <?php endif; ?>

                <?php do_action('bp_after_activity_loop'); ?>

                <form action="" name="activity-loop-form" id="activity-loop-form" method="post">

                    <?php wp_nonce_field('activity_filter', '_wpnonce_activity_filter'); ?>

                </form>
            </div>
            <?php
        }

    }

    bp_register_group_extension('BP_activity_plus_images_tab_Extension');

    /**
     *  * This function will enqueue the components css and javascript files
     * only when the front group  page is displayed
     */
    function ls_bpfp_front_cssjs() {
        global $bp;
        //if we're on a group page
        if ($bp->current_component == $bp->groups->slug) {

            wp_register_style('ls_bpfb', LS_BPFB_PLUGIN_URL . '/css/style.css');
            wp_enqueue_style('ls_bpfb');
        }
    }

//changed with chriskeeble suggestion
    add_action('wp_enqueue_scripts', 'ls_bpfp_front_cssjs');


endif;
?>