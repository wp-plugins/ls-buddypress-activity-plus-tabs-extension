<?php
/**
 * @author Stergatu Eleni
 * @version 2, 2/8/2013
 * Adds tabs in group for Links, Images and Videos uploaded via buddypress activity plus plugin
 */
if ( class_exists( 'BP_Group_Extension' ) ) : // Recommended, to prevent problems during upgrade or when Groups are disabled

    class BP_activity_plus_links_tab_Extension extends BP_Group_Extension {

	public $countLinks = 0;
	var $visibility = 'private';
	var $format_notification_function;
	var $enable_edit_item = false;
	var $enable_create_step = false;
	var $admin_metabox_context = 'side'; // The context of your admin metabox. See add_meta_box()
	var $admin_metabox_priority = 'default'; // The priority of your admin metabox. See add_meta_box()

	function __construct() {
	    $bp = buddypress();
	    if ( $bp->groups->current_group ) {
		if ( bp_has_activities( 'primary_id=' . $bp->groups->current_group->id . '&object=groups&action=activity_update&search_terms=bpfb_link' ) ) {
		    global $activities_template;
		}
		$nav_page_name = __( "Links" );
		$this->name = ! empty( $nav_page_name ) ? $nav_page_name : __( "Links", 'bpfb' );
		$this->slug = 'links';
		/* For internal identification */
		$this->id = 'group_links';
		$this->countLinks = ! empty( $activities_template->activity_count ) ? $activities_template->activity_count : '0';
		$this->nav_item_name = $this->name . ' <span>' . $this->countLinks . '</span>';
		$this->nav_item_position = 52;
		$this->admin_name = ! empty( $nav_page_name ) ? $nav_page_name : __( "Links", 'bpfb' );
		$this->admin_slug = 'links';
	    }
	}

	function display() {
	    $bp = buddypress();
	    ?>
	    	    <div class="info-group">
	        <h4><?php echo esc_attr( $this->name ); ?>
		    <?php if ( bp_group_is_member() ) : ?>
			<div class="generic-button group-button public"><a href="<?php bp_group_permalink(); ?>#whats-new-form" class="generic-button" id="bpfb_add_link"><?php _e( "Add New", 'buddypress' ); ?></a></div>
		    <?php endif; ?>
	        </h4>

			    <?php
			    do_action( 'bp_before_activity_loop' );
			    if ( $this->countLinks > 0 ) :
				if ( bp_has_activities( 'primary_id=' . $bp->groups->current_group->id . '&object=groups&action=activity_update&search_terms=bpfb_link' ) ) :
				    /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */
				    ?>
		    		<noscript>
		    		<div class="pagination">
		    		    <div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
		    		    <div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
		    		</div>
		    		</noscript>
				    <?php if ( empty( $_POST['page'] ) ) : ?>

			<ul id="activity-stream" class="activity-list item-list">

							<?php
						    endif;
						    while ( bp_activities() ) : bp_the_activity();
							bp_locate_template( array( 'activity/entry.php' ), true, false );
						    endwhile;
						    if ( bp_activity_has_more_items() ) :
							?>

				<li class="load-more">
							    <a href="#more"><?php _e( 'Load More', 'buddypress' ); ?></a>
							</li>

							<?php
						    endif;
						    if ( empty( $_POST['page'] ) ) :
							?>

			    </ul>
						    <?php
						endif;
					    endif;
					else :
					    ?>

							<div id="message" class="info">
					    <p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ); ?></p>
					</div>

				    <?php
				    endif;
				    do_action( 'bp_after_activity_loop' );
				    ?>

	    	    			<form action="" name="activity-loop-form" id="activity-loop-form" method="post">

				<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>

	    	    		</form>
	    	    </div>
			<?php
		    }

		}

		bp_register_group_extension( 'BP_activity_plus_links_tab_Extension' );

		class BP_activity_plus_videos_tab_Extension extends BP_Group_Extension {

		    var $visibility = 'private';
		    var $format_notification_function;
		    var $enable_edit_item = false;
		    var $enable_create_step = false;
		    var $admin_metabox_context = 'side'; // The context of your admin metabox. See add_meta_box()
		    var $admin_metabox_priority = 'default'; // The priority of your admin metabox. See add_meta_box()
		    var $countVideos;

		    function __construct() {
			$bp = buddypress();
	    if ( $bp->groups->current_group ) {
			    if ( bp_has_activities( 'primary_id=' . $bp->groups->current_group->id . '&object=groups&action=activity_update&search_terms=bpfb_video' ) ) {
				global $activities_template;
			    }
			    $nav_page_name = __( "Videos", 'bpfb' );
			    $this->name = ! empty( $nav_page_name ) ? $nav_page_name : __( "Videos", 'bpfb' );
			    $this->slug = 'videos';
			    /* For internal identification */
			    $this->id = 'group_videos';
			    // $this->format_notification_function = 'bp_group_documents_format_notifications';
			    $this->countVideos = ! empty( $activities_template->activity_count ) ? $activities_template->activity_count : '0';
			    $this->nav_item_name = $this->name . ' <span>' . $this->countVideos . '</span>';
			    $this->nav_item_position = 54;
			    $this->admin_name = ! empty( $nav_page_name ) ? $nav_page_name : __( "Videos", 'bpfb' );
			    $this->admin_slug = 'videos';
			}
		    }

		    function display() {
			$bp = buddypress();
	    ?>
	    	    <div class="info-group">
	    		<h4><?php echo esc_attr( $this->name ); ?>
				<?php if ( bp_group_is_member() ) : ?>
				    <div class="generic-button group-button public"><a href="<?php bp_group_permalink(); ?>#whats-new-form" class="generic-button" id="bpfb_add_video"><?php _e( "Add New", 'buddypress' ); ?></a></div>
				<?php endif; ?>
	    		</h4>
			    <?php
			    do_action( 'bp_before_activity_loop' );
			    if ( $this->countVideos > 0 ) :
				if ( bp_has_activities( 'primary_id=' . $bp->groups->current_group->id . '&object=groups&action=activity_update&search_terms=bpfb_video' ) ) :
				    /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */
				    ?>
		    		<noscript>
		    		<div class="pagination">
		    		    <div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
		    		    <div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
		    		</div>
		    		</noscript>

					    <?php if ( empty( $_POST['page'] ) ) : ?>
						<ul id="activity-stream" class="activity-list item-list">
						    <?php
						endif;
						while ( bp_activities() ) : bp_the_activity();
						    bp_locate_template( array( 'activity/entry.php' ), true, false );
						endwhile;
						if ( bp_activity_has_more_items() ) :
						    ?>

				<li class="load-more">
							    <a href="#more"><?php _e( 'Load More', 'buddypress' ); ?></a>
							</li>

							<?php
						    endif;
						    if ( empty( $_POST['page'] ) ) :
							?>

			    </ul>

						<?php
					    endif;
					endif;
				    else :
					?>

							<div id="message" class="info">
					    <p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ); ?></p>
					</div>

				    <?php
				    endif;
				    do_action( 'bp_after_activity_loop' );
				    ?>

	    	    			<form action="" name="activity-loop-form" id="activity-loop-form" method="post">

				<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>

	    	    		</form>
	    	    </div>
			<?php
		    }

		}

		bp_register_group_extension( 'BP_activity_plus_videos_tab_Extension' );

		class BP_activity_plus_images_tab_Extension extends BP_Group_Extension {

		    var $visibility = 'private';
		    var $format_notification_function;
		    var $enable_edit_item = false;
		    var $enable_create_step = false;
		    var $admin_metabox_context = 'side'; // The context of your admin metabox. See add_meta_box()
		    var $admin_metabox_priority = 'default'; // The priority of your admin metabox. See add_meta_box()
		    var $countImages;

		    function __construct() {
			$bp = buddypress();
	    if ( $bp->groups->current_group ) {
			    if ( bp_has_activities( 'primary_id=' . $bp->groups->current_group->id . '&object=groups&action=activity_update&search_terms=bpfb_image' ) ) {
				global $activities_template;
			    }

			    $nav_page_name = __( "Images" );
			    $this->name = ! empty( $nav_page_name ) ? $nav_page_name : __( "Images", 'bpfb' );
			    $this->slug = 'images';
			    /* For internal identification */
			    $this->id = 'group_images';
			    $this->countImages = ! empty( $activities_template->activity_count ) ? $activities_template->activity_count : '0';
			    $this->nav_item_name = $this->name . ' <span>' . $this->countImages . '</span>';
			    $this->nav_item_position = 53;
			}
			$this->admin_name = ! empty( $nav_page_name ) ? $nav_page_name : __( "Images", 'bpfb' );
			$this->admin_slug = 'images';
		    }

		    function display() {
			$bp = buddypress();
	    ?>
	    	    <div class="info-group">
	    		<h4><?php echo esc_attr( $this->name ) ?>
				<?php if ( bp_group_is_member() ) : ?>
				    <div class="generic-button group-button public"><a href="<?php bp_group_permalink(); ?>#whats-new-form" class="generic-button" id="bpfb_add_image"><?php _e( "Add New", 'buddypress' ); ?></a></div>
				<?php endif; ?>
	    		</h4>
			    <?php
			    do_action( 'bp_before_activity_loop' );
			    if ( $this->countImages > 0 ) :
				if ( bp_has_activities( 'primary_id=' . $bp->groups->current_group->id . '&object=groups&action=activity_update&search_terms=bpfb_image' ) ) :

				    /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */
				    ?>
		    		<noscript>
		    		<div class="pagination">
		    		    <div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
		    		    <div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
		    		</div>
		    		</noscript>

					    <?php if ( empty( $_POST['page'] ) ) : ?>

			<ul id="activity-stream" class="activity-list item-list">

						    <?php endif; ?>

						    <?php while ( bp_activities() ) : bp_the_activity(); ?>

							<?php bp_locate_template( array( 'activity/entry.php' ), true, false ); ?>

						    <?php endwhile; ?>

						    <?php if ( bp_activity_has_more_items() ) : ?>

				<li class="load-more">
							    <a href="#more"><?php _e( 'Load More', 'buddypress' ); ?></a>
							</li>

						    <?php endif; ?>

						    <?php if ( empty( $_POST['page'] ) ) : ?>

			    </ul>

						<?php
					    endif;
					endif;
				    else :
					?>
					<div id="message" class="info">
					    <p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ); ?></p>
					</div>

				    <?php endif; ?>

				    <?php do_action( 'bp_after_activity_loop' ); ?>

	    	    			<form action="" name="activity-loop-form" id="activity-loop-form" method="post">

				<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>

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
		    $bp = buddypress();
	//if we're on a group page
		    if ( $bp->current_component == $bp->groups->slug ) {
			if ( ! current_theme_supports( 'ls_bpfb_style' ) ) {
			    wp_register_style( 'ls_bpfb', LS_BPFB_PLUGIN_URL . '/css/style.css' );
			    wp_enqueue_style( 'ls_bpfb' );
			}
		    }
		}

		add_action( 'wp_enqueue_scripts', 'ls_bpfp_front_cssjs' );
endif;