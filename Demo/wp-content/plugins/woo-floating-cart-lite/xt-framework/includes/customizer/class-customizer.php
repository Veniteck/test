<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class that takes care of rendering common message blocks
 *
 * @since      1.0.0
 * @package    XT_Framework
 * @subpackage XT_Framework/includes
 * @author     XplodedThemes
 */
class XT_Framework_Customizer {

	/**
	 * Core class reference.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      XT_Framework    $core    Core Class
	 */
	private $core = null;

	private $config_id;
	private $panels = array();
	private $sections = array();
	private $fields = array();

	/**
	 * Class constructor
	 * @param $core
	 */
	public function __construct( &$core ) {

		$this->core = $core;

		$this->config_id = $this->core->plugin_short_prefix();

		add_filter( 'xirki_telemetry', '__return_false', 1 );

        require_once XTFW_DIR_CUSTOMIZER . '/class-customizer-options.php';
        require_once XTFW_DIR_CUSTOMIZER . '/xirki/xirki.php';

		$this->panels = apply_filters( $this->core->plugin_prefix( 'customizer_panels' ), $this->panels, $this );
		$this->sections = apply_filters( $this->core->plugin_prefix( 'customizer_sections' ), $this->sections, $this );
		$this->fields = apply_filters( $this->core->plugin_prefix( 'customizer_fields' ), $this->fields, $this );

		$this->init();

		$this->core->plugin_loader()->add_action( 'customize_register', $this, 'customizer_controls' );

		$this->core->plugin_loader()->add_action( 'customize_preview_init', $this, 'customizer_preview_assets' );
		$this->core->plugin_loader()->add_action( 'customize_controls_enqueue_scripts', $this, 'customizer_controls_assets' );

		$this->core->plugin_loader()->add_filter( 'upload_mimes', $this, 'allow_myme_types', 1, 1 );
		$this->core->plugin_loader()->add_filter( 'wp_check_filetype_and_ext', $this, 'check_filetype_and_ext', 10, 4 );

        $this->core->plugin_loader()->add_filter($this->core->plugin_prefix('admin_tabs'), $this, 'admin_tabs', 1, 1);

	}

	/**
	 * Init customizer
	 */
	public function init() {

		$this->add_config();
		$this->add_panels();
		$this->add_sections();
		$this->add_fields();

	}

	/**
	 * @param $wp_customize
	 */
	public function customizer_controls($wp_customize ) {

		require_once XTFW_DIR_CUSTOMIZER . '/class-customizer-controls.php';

		new XT_Framework_Customizer_Controls( $wp_customize );

	}

	/**
	 * Get config ID
	 */
	public function config_id() {

		return $this->config_id;
	}

	/**
	 * Get panel ID
	 * @param null $id
	 * @return string
	 */
	public function panel_id( $id = null ) {

		$panel_id = $this->config_id();

		if ( ! empty( $id ) ) {
			$panel_id .= '-' . $id;
		}

		return $panel_id;
	}

	/**
	 * Get section ID
	 * @param $id
	 * @return string
	 */
	public function section_id( $id ) {

		return $this->config_id() . '-' . $id;
	}

	/**
	 * Xirki Config
	 */
	public function add_config() {

		Xirki::add_config( $this->config_id(), array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'option',
			'option_name' => $this->config_id()
		) );
	}

	/**
	 * Add panels to Xirki.
	 */
	public function add_panels() {

		$count = 0;
		foreach ($this->panels as $panel) {

			$panel_id = !empty( $panel['id'] ) ? $this->panel_id( $panel['id'] ) : $this->panel_id();

			if($count > 0) {
				$panel['panel'] = isset( $panel['panel'] ) ? $this->panel_id( $panel['panel'] ) : $this->panel_id();
			}

            if ( !empty( $panel['id'] ) ) {
                unset( $panel['id'] );
            }

			Xirki::add_panel( $panel_id, $panel);

			$count++;
		}
	}

	/**
	 * Add sections to Xirki.
	 */
	public function add_sections() {

		$count = 0;
		foreach ( $this->sections as $key => $section ) {

			$section_id            = $this->section_id( $section['id'] );

			$section['capability'] = !empty( $section['capability'] ) ? $section['capability'] : 'edit_theme_options';
			$section['priority']   = !empty( $section['priority'] ) ? $section['priority'] : 160;
			$section['panel'] = !empty($section['panel']) ? $this->panel_id($section['panel']) : $this->panel_id();

			if ( ! empty( $section['id'] ) ) {
				unset( $section['id'] );
			}

			Xirki::add_section( $section_id, $section);

			$count++;
		}
	}

	/**
	 * Add fields to Xirki.
	 */
	public function add_fields() {

		foreach ( $this->fields as $field ) {

			$field['settings'] = ! empty( $field['id'] ) ? $field['id'] : $field['settings'];
			$field['section']  = $this->section_id( $field['section'] );
			$field['priority'] = ! empty( $field['priority'] ) ? $field['priority'] : 10;

			if ( !empty( $field['id'] ) ) {
				unset( $field['id'] );
			}

			Xirki::add_field( $this->config_id(), $field );
		}

	}

	/**
	 * Add customizer admin tab
	 * @param $tabs
	 * @return array
	 */
	public function admin_tabs( $tabs ) {

		$tabs[] = array(
			'id'          => 'customizer',
			'title'       => esc_html__( 'Customize', 'xt-framework' ),
			'show_menu'   => false,
			'action_link' => true,
			'content'    => array(
			    'type' => 'function',
                'function' => array($this, 'customizer_tab_section')
            ),
            'order' => 0
		);

		return $tabs;
	}

	public function customizer_tab_section() {

        $has_one_panel = count($this->panels) === 1;

        if(!$has_one_panel) {
            array_shift($this->panels);
        }

	    echo '<ul>';
        foreach($this->panels as $panel) {

            if(!$has_one_panel) {
                echo '<li>';
                echo '    <a title="'.esc_html__('Open in Customizer', 'xt-framework').'" href="' . $this->customizer_link($panel['id']) . '"><span class="dashicons '.$panel['icon'].'"></span> ' . $panel['title'] . ' <span class="dashicons dashicons-arrow-right-alt2"></span></a>';
                echo '    <ul>';
            }

            foreach($this->sections as $section) {

                if(!$has_one_panel && (empty($section['panel']) || ($section['panel'] !== $panel['id']))) {
                    continue;
                }

                echo '    <li><a title="'.esc_html__('Open in Customizer', 'xt-framework').'" href="'.$this->customizer_link(null, $section['id']).'"><span class="dashicons '.$section['icon'].'"></span> '.$section['title'].' <span class="dashicons dashicons-arrow-right-alt2"></span></a></li>';
            }

            if(!$has_one_panel) {
                echo '    </ul>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }

	/**
	 * Check if option exists
	 * @param $id
	 * @return bool
	 */
	public function option_exists( $id ) {

		$key = array_search($id, array_column($this->fields, 'id'));

		return ($key !== false);
	}

	/**
	 * Get customizer link
	 */
	public function customizer_link($panel = null, $section = null) {

	    $path = 'customize.php';

	    if(!empty($section)) {
            $path .= '?autofocus[section]=' . $this->section_id($section);
        }else if(!empty($panel)) {
            $path .= '?autofocus[panel]='.$this->panel_id($panel);
        }else{
            $path .= '?autofocus[panel]='.$this->panel_id();
        }

		return admin_url( $path );
	}

	/**
	 * Get all options
	 */
	public function get_options() {

		get_option($this->config_id());
	}

	/**
	 * Update all options
	 * @param $options
	 */
	public function update_options( $options ) {

		update_option($this->config_id(), $options);
	}

	/**
	 * Update all options
	 */
	public function delete_options() {

		delete_option($this->config_id());
	}

	/**
	 * Get option and allow it's value to be filtered
	 * @param $id
	 * @param null $default
	 * @return mixed
	 */
	public function get_option( $id, $default = null ) {

		if ( ! $this->option_exists( $id ) ) {

			return $default;
		}

		$config_id = $this->config_id();

		$value = Xirki::get_option( $config_id, $id );

		if ( ! empty( $_POST['customized'] ) ) {

			$options = json_decode( stripslashes( sanitize_text_field( $_POST['customized'] ) ), true );

			if ( isset( $options[ $config_id . '[' . $id . ']' ] ) ) {

				$value = $options[ $config_id . '[' . $id . ']' ];
				if ( strpos( $options[ $config_id . '[' . $id . ']' ], '%22' ) !== false ) {
					$value = json_decode( urldecode( $value ), true );
				}

			}
		}

		return apply_filters( $this->core->plugin_short_prefix( 'customizer_option' ), $value, $id, $default, $this->core->plugin_short_prefix() );
	}

	/**
	 * Get option and cast it as boolean
	 * @param $id
	 * @param null $default
	 * @return bool
	 */
	function get_option_bool( $id, $default = null ) {

		return (bool) $this->get_option( $id, $default );
	}

	/**
	 * Update option
	 * @param $id
	 * @param $value
	 */
	function update_option( $id, $value ) {

		$config_id = $this->config_id();

		$options = get_option( $config_id );

		$options[ $id ] = $value;

		update_option( $config_id, $options );
	}

	/**
	 * Delete option
	 * @param $id
	 */
	function delete_option( $id ) {

		$config_id = $this->config_id();

		$options = get_option( $config_id );

		if ( isset( $options[ $id ] ) ) {
			unset( $options[ $id ] );
		}

		update_option( $config_id, $options );
	}

	public function customizer_preview_assets() {

		wp_enqueue_script(
			$this->core->framework_prefix( 'customizer' ),
			xtfw_dir_url( XTFW_DIR_CUSTOMIZER_ASSETS ) . '/js/customizer' . XTFW_SCRIPT_SUFFIX . '.js',
			array( 'jquery', 'customize-preview' ),
			$this->core->framework_version(),
			true
		);

		$js_vars_fields = array();
		$fields         = Xirki::$fields;
		foreach ( $fields as $field ) {
			if ( isset( $field['transport'] ) && 'postMessage' === $field['transport'] && isset( $field['js_vars'] ) && ! empty( $field['js_vars'] ) && is_array( $field['js_vars'] ) && isset( $field['settings'] ) ) {
				$js_vars_fields[ $field['settings'] ] = $field['js_vars'];
			}
		}
		wp_localize_script( $this->core->framework_prefix( 'customizer' ), 'jsvars', $js_vars_fields );

		do_action( $this->core->framework_prefix( 'customizer_preview_assets' ) );
	}

	public function customizer_controls_assets() {

		wp_enqueue_style(
			$this->core->framework_prefix( 'customizer' ),
			xtfw_dir_url( XTFW_DIR_CUSTOMIZER_ASSETS ) . '/css/customizer.css',
			array(),
			$this->core->framework_version()
		);

		if(!empty($_GET['premium_css'])) {
			wp_enqueue_style(
				$this->core->framework_prefix('customizer-premium'),
				xtfw_dir_url(XTFW_DIR_CUSTOMIZER_ASSETS) . '/css/customizer-premium.css',
				array(),
				$this->core->framework_version()
			);
		}

		do_action( $this->core->plugin_prefix( 'customizer_controls_assets' ) );

	}

	// Allow SVG
	/**
	 * @param $data
	 * @param $file
	 * @param $filename
	 * @param $mimes
	 * @return array
	 */
	public function check_filetype_and_ext($data, $file, $filename, $mimes ) {

		global $wp_version;
		if ( $wp_version <= '4.7.1' ) {
			return $data;
		}

		$filetype = wp_check_filetype( $filename, $mimes );

		return [
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename']
		];

	}

	/**
	 * @param $mime_types
	 * @return mixed
	 */
	public function allow_myme_types($mime_types ) {

		$mime_types['svg']  = 'image/svg+xml'; //Adding svg extension
		$mime_types['svgz'] = 'image/svg+xml';

		return $mime_types;

	}

} // End Class
	
