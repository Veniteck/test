<?php
/**
 * WordPress Admin Message Handler
 * Class that takes care of rendering admin notices
 *
 * @since      1.0.0
 * @package    XT_Framework
 * @subpackage XT_Framework/includes
 * @author     XplodedThemes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'XT_Framework_Notices' ) ) :

	/**
	 * # WordPress Backend & Frontend Message Handler Class
	 *
	 * This class provides a reusable wordpress admin messaging facility for setting
	 * and displaying messages and error messages across admin page requests or frontend pages without
	 * resorting to passing the messages as query vars
	 *
	 * @version 1.0.0
	 */
	class XT_Framework_Notices {

		/** transient message prefix */
		const MESSAGE_TRANSIENT_PREFIX = '_xtfw_notice_';

		/** the message id GET name */
		const MESSAGE_ID_GET_NAME = 'xtfw_notice';

		/** @var string unique message identifier, defaults to __FILE__ unless otherwise set */
		private $message_id;

		/** @var string title to be shown before the notice */
		private $title;

		/** @var array array of messages */
		private $messages = array();

		/** @var bool $frontend*/
		private $frontend = false;

		/** @var bool $woocommerce_notices*/
		private $woocommerce_notices = false;

		private $woocommerce_notice_types_map = array(
			'error' => 'error',
			'warning' => 'error',
			'success' => 'message',
			'info' => 'info',
		);

		/**
		 * Construct and initialize the admin message handler class
		 *
		 * @param string $message_id optional message id.  Best practice is to set
		 *        this to a unique identifier based on the client plugin, such as __FILE__
		 *
		 * @since 1.0
		 */
		public function __construct( $message_id, $title = null, $frontend = false, $woocommerce_notices = false) {

			$this->message_id = $message_id.($frontend ? '-frontend' : '');
			$this->title      = $title;
			$this->frontend   = $frontend;
			$this->woocommerce_notices = $woocommerce_notices;

			// load any available messages
			add_action( 'init', array( $this, 'load_messages' ) );
			add_filter( 'wp_redirect', array( $this, 'redirect' ), 1, 2 );

			if(is_admin() && !$this->frontend) {

				add_action( 'admin_notices', array( $this, 'show_messages' ) );

			}else{

				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts') );
			}

		}


		/**
		 * Persist messages
		 *
		 * @return boolean true if any messages were set, false otherwise
		 * @since 1.0
		 */
		public function set_messages() {

			// any messages to persist?
			if ( $this->message_count() > 0 ) {

				set_transient(
					self::MESSAGE_TRANSIENT_PREFIX . $this->get_message_id(),
					array(
						'messages' => $this->messages
					),
					60 * 60
				);

				return true;
			}

			return false;
		}


		/**
		 * Loads messages
		 *
		 * @since 1.0
		 */
		public function load_messages() {

			if ( isset( $_GET[ self::MESSAGE_ID_GET_NAME ] ) && $this->get_message_id() == $_GET[ self::MESSAGE_ID_GET_NAME ] ) {

				$memo = get_transient( self::MESSAGE_TRANSIENT_PREFIX . $_GET[ self::MESSAGE_ID_GET_NAME ] );

				if ( isset( $memo['messages'] ) ) {
					$this->messages = $memo['messages'];
				}

				$this->clear_messages( $_GET[ self::MESSAGE_ID_GET_NAME ] );
			}
		}


		/**
		 * Clear messages and errors
		 *
		 * @param string $id the messages identifier
		 *
		 * @since 1.0
		 */
		public function clear_messages( $id ) {
			delete_transient( self::MESSAGE_TRANSIENT_PREFIX . $id );
		}


		/**
		 * Add an error message.
		 *
		 * @param string $message message
		 *
		 * @since 1.0
		 */
		public function add_error_message( $message ) {

			$this->add_message( $message, 'error' );
		}

		/**
		 * Add an warning message.
		 *
		 * @param string $message message
		 *
		 * @since 1.0
		 */
		public function add_warning_message( $message ) {

			$this->add_message( $message, 'warning' );
		}

		/**
		 * Add an success message.
		 *
		 * @param string $message message
		 *
		 * @since 1.0
		 */
		public function add_success_message( $message ) {

			$this->add_message( $message, 'success' );
		}

		/**
		 * Add an info message.
		 *
		 * @param string $message message
		 *
		 * @since 1.0
		 */
		public function add_info_message( $message ) {

			$this->add_message( $message, 'info' );
		}

		/**
		 * Add a message.
		 *
		 * @param string $message the message to add
		 * @param bool $type message type
		 *
		 * @since 1.0
		 */
		public function add_message( $message, $type = 'info' ) {

			$this->messages[ $type ][] = $message;
		}


		/**
		 * Get error count.
		 *
		 * @return int error message count
		 * @since 1.0
		 */
		public function error_message_count() {
			return sizeof( $this->get_error_messages() );
		}

		/**
		 * Get warning count.
		 *
		 * @return int warning count
		 * @since 1.0
		 */
		public function warning_message_count() {
			return sizeof( $this->get_warning_messages() );
		}

		/**
		 * Get info message count.
		 *
		 * @return int success count
		 * @since 1.0
		 */
		public function info_message_count() {
			return sizeof( $this->get_info_messages() );
		}

		/**
		 * Get success count.
		 *
		 * @return int success count
		 * @since 1.0
		 */
		public function success_message_count() {
			return sizeof( $this->get_success_messages() );
		}

		/**
		 * Get message count.
		 *
		 * @return int message count
		 * @since 1.0
		 */
		public function message_count() {
			return $this->error_message_count() + $this->warning_message_count() + $this->info_message_count() + $this->success_message_count();
		}


		/**
		 * Get error messages
		 *
		 * @return array of error message strings
		 * @since 1.0
		 */
		public function get_error_messages() {

			return $this->get_messages( 'error' );
		}

		/**
		 * Get an error message
		 *
		 * @param int $index the error index
		 *
		 * @return string the error message
		 * @since 1.0
		 */
		public function get_error_message( $index ) {

			$messages = $this->get_error_messages();

			return isset( $messages[ $index ] ) ? $messages[ $index ] : '';
		}


		/**
		 * Get warning messages
		 *
		 * @return array of warning message strings
		 * @since 1.0
		 */
		public function get_warning_messages() {

			return $this->get_messages( 'warning' );
		}

		/**
		 * Get an warning message
		 *
		 * @param int $index the warning index
		 *
		 * @return string the warning message
		 * @since 1.0
		 */
		public function get_warning_message( $index ) {

			$messages = $this->get_warning_messages();

			return isset( $messages[ $index ] ) ? $messages[ $index ] : '';
		}


		/**
		 * Get success messages
		 *
		 * @return array of success message strings
		 * @since 1.0
		 */
		public function get_success_messages() {

			return $this->get_messages( 'success' );
		}

		/**
		 * Get an success message
		 *
		 * @param int $index the success index
		 *
		 * @return string the success message
		 * @since 1.0
		 */
		public function get_success_message( $index ) {

			$messages = $this->get_success_messages();

			return isset( $messages[ $index ] ) ? $messages[ $index ] : '';
		}

		/**
		 * Get info messages
		 *
		 * @return array of info message strings
		 * @since 1.0
		 */
		public function get_info_messages() {

			return $this->get_messages( 'info' );
		}

		/**
		 * Get an info message
		 *
		 * @param int $index the info index
		 *
		 * @return string the info message
		 * @since 1.0
		 */
		public function get_info_message( $index ) {

			$messages = $this->get_info_messages();

			return isset( $messages[ $index ] ) ? $messages[ $index ] : '';
		}

		/**
		 * Get messages
		 *
		 * @param string $type type of messages
		 *
		 * @return array of message strings
		 * @since 1.0
		 */
		public function get_messages( $type = null ) {

			if ( empty( $type ) ) {

				// get all messages
				return $this->messages;

			} else {

				// get messages by type
				return ! empty( $this->messages[ $type ] ) ? $this->messages[ $type ] : array();
			}
		}

		/**
		 * Render the errors and messages.
		 *
		 * @since 1.0
		 */
		public function show_messages() {

			if ( $this->message_count() > 0 ) {

				if ( is_admin() ) {

					$this->render_backend_messages();

				} else {

					$this->render_frontend_messages();
				}
			}

		}

		/**
		 * Render the errors and messages within the backend.
		 *
		 * @since 1.0
		 */
		public function render_backend_messages() {

			foreach ( $this->get_messages() as $type => $messages ) {

				$messages = array_unique(array_filter($messages));

				$output = '';
				foreach ( $messages as $message ) {
					$output .= $this->get_backend_message_output( $type, $message );
				}

				$dimissible       = ( $type === 'info' );
				$dimissible_class = $dimissible ? ' is-dismissible' : '';

				if ( ! empty( $output ) ) {
					echo '<div class="xt-framework-admin-notice notice notice-' . esc_attr( $type ) . '' . esc_attr( $dimissible_class ) . '">' . $output . '</div>';
				}

			}

			wp_enqueue_script( self::MESSAGE_ID_GET_NAME, xtfw_dir_url( XTFW_DIR_NOTICES_ASSETS ) . '/js/admin-notices' . XTFW_SCRIPT_SUFFIX . '.js', array( 'jquery' ), XTFW_VERSION, true );

		}

		/**
		 * Render the errors and messages within the frontend.
		 *
		 * @since 1.0
		 */
		public function render_frontend_messages() {

			echo '<div class="xt-framework-notices">';

			foreach ( $this->get_messages() as $type => $messages ) {

				$messages = array_unique(array_filter($messages));

				foreach ( $messages as $message ) {
					echo $this->get_frontend_message_output( $type, $message );
				}
			}

			echo '</div>';

		}


		/**
		 * get the error or message output for the backend.
		 *
		 * @since 1.0
		 */
		public function get_backend_message_output( $type, $message ) {

			$id = 'xtfw_hide_notice_' . md5( $this->get_message_id() . $type . $message );

			$dimissible = ($type === 'info');

			if ( $dimissible && ( ! empty( $_COOKIE[ $id ] ) && 'yes' == $_COOKIE[ $id ] ) ) {
				return '';
			}

			$message = str_replace( '{title}', '<strong>' . $this->title . '</strong>', $message );
			$message = str_replace( '{title:}', '<strong>' . $this->title . '</strong>', $message );

			return '<p data-id="' . esc_attr( $id ) . '">' . $message . '</p>';
		}


		/**
		 * get the error or message output for the frontend.
		 *
		 * @since 1.0
		 */
		public function get_frontend_message_output( $type, $message ) {

			$classes = array('xt-framework-notice');

			if($this->woocommerce_notices) {
				$type = $this->woocommerce_notice_types_map[ $type ];
				$classes[] = 'woocommerce-' . esc_attr( $type );
			}

			$classes = implode(" ", $classes);

			return '<div class="'.esc_attr($classes).'">' . $message . '</div>';

		}

		public function enqueue_frontend_scripts() {

			wp_enqueue_style( self::MESSAGE_ID_GET_NAME, xtfw_dir_url( XTFW_DIR_NOTICES_ASSETS ) . '/css/frontend-notices.css', array(), XTFW_VERSION );
		}

		/**
		 * Redirection hook which persists messages into session data.
		 *
		 * @param string $location the URL to redirect to
		 *
		 * @return string the URL to redirect to
		 * @since 1.0
		 */
		public function redirect( $location ) {

			// add the admin message id param to the
			if ( $this->set_messages() ) {
				$location = add_query_arg( self::MESSAGE_ID_GET_NAME, $this->get_message_id(), $location );
			}

			return $location;
		}


		/**
		 * Generate a unique id to identify the messages
		 *
		 * @return string unique identifier
		 * @since 1.0
		 */
		private function get_message_id() {

			if ( ! isset( $this->message_id ) ) {
				$this->message_id = __FILE__;
			}

			return wp_create_nonce( $this->message_id );

		}


	}

endif; // class exists check
