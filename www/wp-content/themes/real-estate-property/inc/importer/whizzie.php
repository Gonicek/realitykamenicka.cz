<?php

/**
 * Wizard
 *
 * @package Whizzie
 * @author misbahwp
 * @since 1.0.0
 */

class Whizzie {

	protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */
	protected $theme_name = '';
	protected $theme_title = '';

	protected $plugin_path = '';
	protected $parent_slug = '';

	/** @var string Wizard page slug and title. */
	protected $page_slug = '';
	protected $page_title = '';

	/** @var array Wizard steps set by user. */
	protected $config_steps = array();

	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	// Where to find the widget.wie file
	protected $widget_file_url = '';

	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {

		// require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';
		// require_once trailingslashit( WHIZZIE_DIR ) . 'widgets/class-ti-widget-importer.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );

	}

	public function redirect_to_wizard() {
        update_option( 'dismissed-get_started', false );
    }

	/*
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {

		add_action( 'after_switch_theme', array( $this, 'redirect_to_wizard' ) );
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );

	}

	public function enqueue_scripts($hook) {

		wp_enqueue_style( 'importer-style', get_template_directory_uri() . '/inc/importer/assets/css/importer-style.css');

		wp_register_script( 'importer-script', get_template_directory_uri() . '/inc/importer/assets/js/importer-script.js', array( 'jquery' ), time() );
		wp_localize_script(
			'importer-script',
			'real_estate_property_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'real-estate-property' )
			)
		);
		wp_enqueue_script( 'importer-script' );

	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_menu_page( 
			esc_html( $this->page_title ), // Page title
			esc_html( $this->page_title ), // Menu title
			'manage_options', // Capability
			$this->page_slug, // Menu slug
			array( $this, 'real_estate_property_setup_wizard' ) , // Function that renders the page
			'dashicons-admin-generic', // Icon
			2 // Position in the dashboard menu
		);
	}

	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() {
		tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<?php printf('<h1>%s</h1>', esc_html($this->page_title));
			echo '<div class="card importer-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="importer-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'real-estate-property' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button

						if( isset( $step['button_text'] ) && $step['button_text'] ) {
							printf(
								'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
								esc_attr( $step['callback'] ),
								esc_attr( $step['id'] ),
								esc_html( $step['button_text'] )
							);
						}

						// The skip button
						if( isset( $step['can_skip'] ) && $step['can_skip'] ) {
							printf(
								'<div class="button-wrap" style="margin-left: 0.5em;"><a href="#" class="button button-secondary do-it" data-callback="%s" data-step="%s">%s</a></div>',
								'do_next_step',
								esc_attr( $step['id'] ),
								__( 'Skip', 'real-estate-property' )
							);
						}

					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="destiny-going"><span class="spinner"></span></div>
			</div><!-- .importer-wrap -->

		</div><!-- .wrap -->
	<?php }

	public function wz_activate_real_estate_property() {

		if ( is_wp_error( $response ) ) {
			$response = array('status' => false, 'msg' => 'Something Went Wrong!');
			wp_send_json($response);
			exit;
		} else {
			$response_body = wp_remote_retrieve_body( $response );
			$response_body = json_decode($response_body);

			if ( $response_body->is_suspended == 1 ) {
			} else {
			}

			if ($response_body->status === false) {
				$response = array('status' => false, 'msg' => $response_body->msg);
				wp_send_json($response);
				exit;
			} else {
				$response = array('status' => true, 'msg' => 'Theme Activated Successfully!');
				wp_send_json($response);
				exit;
			}
		}
	}

	public function real_estate_property_setup_wizard() {
		?>
			<div class="wrapper-info get-stared-page-wrap">
				<div id="demo_offer">
					<?php $this->wizard_page(); ?>
				</div>
			</div>
		<?php
	}

	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'real-estate-property' ) . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'START NOW', 'real-estate-property' ),
				'can_skip'		=> false // Show a skip button?
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'real-estate-property' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'INSTALL PLUGINS', 'real-estate-property' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'real-estate-property' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'IMPORT DEMO', 'real-estate-property' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'real-estate-property' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/**
	 * Print the content for the intro step
	 */
		public function get_step_intro() { ?>
			<div class="summary">
				<p>
					<?php
					printf(
						esc_html__('Thank you for choosing this %s Theme. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.', 'real-estate-property'),
						$this->theme_title
					);
					?>
				</p>
				<p>
					<?php esc_html_e('You may even skip the steps and get back to the dashboard if you have no time at the present moment. You can come back any time if you change your mind.','real-estate-property'); ?>
				</p>
			</div>
		<?php }

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.', 'real-estate-property') ?>
				</p>
			</div>
		<?php
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . '<span class="left-span">' .esc_html( $plugin['name'] ) .'</span>'. '<span class="right-span">';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';
		
		return $content;
	}

	function moveArrayPosition(&$array, $key, $new_position) {
	    if (!array_key_exists($key, $array)) {
	        return $array;
	    }
	    $item = $array[$key];
	    unset($array[$key]);
	    $result = [];
	    $position_added = false;

	    foreach ($array as $current_key => $current_value) {
	        if (!$position_added && $new_position === count($result)) {
	            $result[$key] = $item;
	            $position_added = true;
	        }
	        $result[$current_key] = $current_value;
	    }
	    if (!$position_added) {
	        $result[$key] = $item;
	    }
	    $array = $result;
	    return $array;
	}

	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('This theme supports importing the demo content and adding widgets. Get them installed with the below button. Using the Customizer, it is possible to update or even deactivate them','real-estate-property'); ?>
			</p>
		</div>
	<?php }

	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="mi-demo-wizard-guide" class="summary">
			<p><?php esc_html_e('Awesome! You have Imported Your Website Successfully.','real-estate-property'); ?></p>
			<div class="mi-wizard-finish">				
				<a target="_blank" href="<?php echo esc_url(admin_url()); ?>" class="button btnPush btnBlueGreen"><?php esc_html_e('FINISH', 'real-estate-property'); ?></a>
				<a target="_blank" href="<?php echo esc_url(home_url()); ?>" class="button btnPush btnBlueGreen"><?php esc_html_e('VISIT SITE', 'real-estate-property'); ?></a>
			</div>
		</div>		
		
	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */

	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','real-estate-property' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','real-estate-property' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','real-estate-property' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','real-estate-property' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','real-estate-property' ) ) );
		}
		exit;
	}

	public static function get_page_id_by_title($pagename){

		$args = array(
			'post_type' => 'page',
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'title' => $pagename
		);
		$query = new WP_Query( $args );
		
		$page_id = '1';
		if (isset($query->post->ID)) {
			$page_id = $query->post->ID;
		}
		
		return $page_id;
	}

public function create_theme_nav_menu() {

    // ------- Create Nav Menu --------
    $menuname = 'Primary Menu';
    $bpmenulocation = 'primary_menu';
    $menu_exists = wp_get_nav_menu_object($menuname);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menuname);

        // Create or fetch 'Blogs' page
        $blog_page = get_page_by_title('Blogs');
        if (!$blog_page) {
            $blog_page_id = wp_insert_post(array(
                'post_title'   => 'Blogs',
                'post_type'    => 'page',
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_name'    => 'blogs',
                'post_content' => 'This is the blog listing page.'
            ));
        } else {
            $blog_page_id = $blog_page->ID;
        }

        // Set the Posts page
        update_option('page_for_posts', $blog_page_id);

        // Add Home
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   => __('Home','real-estate-property'),
            'menu-item-classes' => 'home-page',
            'menu-item-url'     => home_url('/'),
            'menu-item-status'  => 'publish',
        ));

        // Add Blogs (Posts Page)
        if ($blog_page_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'   => __('Blogs', 'real-estate-property'),
                'menu-item-classes' => 'blogs',
                'menu-item-object'  => 'page',
                'menu-item-object-id' => $blog_page_id,
                'menu-item-type'    => 'post_type',
                'menu-item-status'  => 'publish',
            ));
        }

        // Add other pages
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   => __('Pages','real-estate-property'),
            'menu-item-classes' => 'pages',
            'menu-item-url'     => get_permalink(Whizzie::get_page_id_by_title('Pages')),
            'menu-item-status'  => 'publish',
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   => __('About Us','real-estate-property'),
            'menu-item-classes' => 'about-us',
            'menu-item-url'     => get_permalink(Whizzie::get_page_id_by_title('About Us')),
            'menu-item-status'  => 'publish',
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   => __('Contact Us','real-estate-property'),
            'menu-item-classes' => 'contact-us',
            'menu-item-url'     => get_permalink(Whizzie::get_page_id_by_title('Contact Us')),
            'menu-item-status'  => 'publish',
        ));

        // Assign menu to location
        if (!has_nav_menu($bpmenulocation)) {
            $locations = get_theme_mod('nav_menu_locations');
            $locations[$bpmenulocation] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
}

	public function setup_widgets() {

		 $real_estate_property_home_id='';
        $real_estate_property_home_content = '';
        $real_estate_property_home_title = 'Home';
        $real_estate_property_home = array(
            'post_type' => 'page',
            'post_title' => $real_estate_property_home_title,
            'post_content' => $real_estate_property_home_content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_slug' => 'home'
        );
        $real_estate_property_home_id = wp_insert_post($real_estate_property_home);

        add_post_meta( $real_estate_property_home_id, '_wp_page_template', 'templates/template-homepage.php' );

        update_option( 'page_on_front', $real_estate_property_home_id );
        update_option( 'show_on_front', 'page' );


            // Create a Posts Page
            $real_estate_property_blog_title = 'Blogs';
            $real_estate_property_blog_check = get_page_id_by_title($real_estate_property_blog_title);

            if ($real_estate_property_blog_check  == 1) {
                $real_estate_property_blog = array(
                    'post_type' => 'page',
                    'post_title' => $real_estate_property_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'blogs',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $real_estate_property_blog_id = wp_insert_post($real_estate_property_blog);
            }

            // Create a Posts Page
            $real_estate_property_blog_title = 'Pages';
            $real_estate_property_blog_check = get_page_id_by_title($real_estate_property_blog_title);

            if ($real_estate_property_blog_check == 1) {
                $real_estate_property_pages = array(
                    'post_type' => 'page',
                    'post_title' => $real_estate_property_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'pages',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $real_estate_property_blog_id = wp_insert_post($real_estate_property_pages);
            }

            // Create a Posts Page
            $real_estate_property_blog_title = 'About Us';
            $real_estate_property_blog_check = get_page_id_by_title($real_estate_property_blog_title);

            if ($real_estate_property_blog_check  == 1) {
                $real_estate_property_about_us = array(
                    'post_type' => 'page',
                    'post_title' => $real_estate_property_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'about-us',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $real_estate_property_blog_id = wp_insert_post($real_estate_property_about_us);
            }

            // Create a Posts Page
            $real_estate_property_blog_title = 'Contact Us';
            $real_estate_property_blog_check = get_page_id_by_title($real_estate_property_blog_title);

            if ($real_estate_property_blog_check  == 1) {
                $real_estate_property_contact = array(
                    'post_type' => 'page',
                    'post_title' => $real_estate_property_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'contact-us',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $real_estate_property_blog_id = wp_insert_post($real_estate_property_contact);
            }

		//---Header--//

        // set_theme_mod( 'real_estate_property_site_title_setting', false);

		set_theme_mod('real_estate_property_top_twitter_link', '#');
		set_theme_mod('real_estate_property_top_linkdin_link', '#');
		set_theme_mod('real_estate_property_top_youtube_link', '#');
		set_theme_mod('real_estate_property_top_facebook_link', '#');
		set_theme_mod('real_estate_property_top_instagram_link', '#');

		set_theme_mod('real_estate_property_header_register_link', '#');
		set_theme_mod('real_estate_property_header_register_text', 'Add Property');

		set_theme_mod('real_estate_property_header_phone_number', 'Call: +1234567890');
		set_theme_mod('real_estate_property_header_email_address', 'info@example.com');

		//-----Slider-----//

		set_theme_mod( 'real_estate_property_slide_on_off', 'on' );

		set_theme_mod('real_estate_property_slide_count','3');

		$real_estate_property_slider_title=array('Your Gateway to a Richer Life', 'Unlock the Door to a More Abundant Life', 'Your Key to a Life of Greater Fulfillment');

		for ($i=1; $i <= 3; $i++) {
			set_theme_mod( 'real_estate_property_slider_image'.$i, get_template_directory_uri().'/images/demo-import-images/slides/slide_'.$i.'.png' );
			
			set_theme_mod('real_estate_property_slider_heading'.$i, $real_estate_property_slider_title[$i - 1]);
			set_theme_mod('real_estate_property_slider_heading_link'.$i,'#');
			set_theme_mod('real_estate_property_slider_content'.$i,'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
			set_theme_mod('real_estate_property_slider_button_link'.$i, '#');
			set_theme_mod('real_estate_property_slider_button_text'.$i, 'Buy Now');
		}

		//-----Projects-----//

		set_theme_mod( 'real_estate_property_project_on_off', 'on' );

		set_theme_mod('real_estate_property_project_main_heading','Our Recent Projects');

		set_theme_mod('real_estate_property_project_count','3');

		$real_estate_property_features_title=array('The best place to buy property for investing', 'How to achieve financial independence through real...', 'Dream house plus best rates, How to calculate?');

		$real_estate_property_features_date=array('05 December 2021', '15 January 2021', '21 December 2021');

		$real_estate_property_features_category=array('Investment', 'Finance', 'Property');

		for ($i=1; $i <= 3; $i++) {
			set_theme_mod( 'real_estate_property_project_image'.$i, get_template_directory_uri().'/images/demo-import-images/project/project_'.$i.'.jpg' );
			set_theme_mod('real_estate_property_project_heading'.$i, $real_estate_property_features_title[$i - 1]);
			set_theme_mod('real_estate_property_project_date'.$i, $real_estate_property_features_date[$i - 1]);
			set_theme_mod('real_estate_property_project_category'.$i, $real_estate_property_features_category[$i - 1]);
			set_theme_mod('real_estate_property_project_content'.$i,'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
		}

		// /*--- Logo Start---*/

		// $image_url = get_template_directory_uri().'/images/demo-import-images/logo.png';
        // $image_name       = 'logo.png';

        // $upload_dir = wp_upload_dir();
        // // Set upload folder
        // $image_data_1 = file_get_contents(esc_url($image_url));

        // // Get image data
        // $unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
        // // Generate unique name
        // $filename = basename($unique_file_name);
        // // Create image file name

        // // Check folder permission and define file location
        // if (wp_mkdir_p($upload_dir['path'])) {
        //     $file = $upload_dir['path'].'/'.$filename;
        // } else {
        //     $file = $upload_dir['basedir'].'/'.$filename;
        // }

		// // Create the image  file on the server
		// if ( ! function_exists( 'WP_Filesystem' ) ) {
		//     require_once( ABSPATH . 'wp-admin/includes/file.php' );
		// }

		// WP_Filesystem();
		// global $wp_filesystem;

		// if ( ! $wp_filesystem->put_contents( $file, $image_data_1, FS_CHMOD_FILE ) ) {
		//     wp_die( 'Error saving file!' );
		// }


        // // Check image file type
        // $wp_filetype = wp_check_filetype($filename, null);

        // // Set attachment data
        // $attachment = array(
        // 'post_mime_type' => $wp_filetype['type'],
        // 'post_title'     => sanitize_file_name($filename),
        // 'post_type'      => '',
        // 'post_status'    => 'inherit',
        // );

        // // Create the attachment
        // $attach_id = wp_insert_attachment($attachment, $file);

        // set_theme_mod( 'custom_logo', $attach_id );

        // /*--- Logo End---*/

		//--------------------------------------//

		$this->create_theme_nav_menu();
		
	}
}