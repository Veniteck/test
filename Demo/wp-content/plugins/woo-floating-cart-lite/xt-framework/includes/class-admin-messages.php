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
class XT_Framework_Admin_Messages {

	/**
	 * Core class reference.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      XT_Framework    core    Core Class
	 */
	private $core;

	public function __construct( $core ) {

		$this->core = $core;
	}

	public function premium_required($scope = 'this section', $classes = array(), $tag = 'p') {

		$classes = array_merge(array('xt-framework-premium-required'), $classes);
		$classes = implode($classes, " ");
		?>
        <<?php echo $tag;?> class="<?php echo esc_attr($classes);?>">
			<?php
			echo sprintf(
				wp_kses_post( __( 'You can <a href="%s">Upgrade</a> or <a href="%s">Activate</a> your license to unlock access to %s.', 'slick-menu' ) ),
				esc_url( $this->core->access_manager()->get_upgrade_url() ),
				esc_url( $this->core->access_manager()->get_account_url( false, array( 'activate_license' => 'true' ) ) ),
				$scope
			);
			?>
        </<?php echo $tag;?>>
		<?php
	}

	public function premium_required_table_row($scope = 'this section', $classes = array(), $colspan = 2) {

		$classes = array_merge(array('xt-framework-premium-required'), $classes);
		$classes = implode($classes, " ");
		?>
        <tr class="<?php echo esc_attr($classes);?>">
            <th colspan="<?php echo esc_attr($colspan);?>">
			<?php
			echo sprintf(
				wp_kses_post( __( 'You can <a href="%s">Upgrade</a> or <a href="%s">Activate</a> your license to unlock access to %s.', 'slick-menu' ) ),
				esc_url( $this->core->access_manager()->get_upgrade_url() ),
				esc_url( $this->core->access_manager()->get_account_url( false, array( 'activate_license' => 'true' ) ) ),
                $scope
			);
			?>
            </th>
        </tr>
		<?php
	}

	public function premium_required_big( $scope = 'this section', $classes = array(), $tag = 'div') {

	    $classes = array_merge(array('xt-framework-premium-required-big'), $classes);
		$classes = implode($classes, " ");
		?>
        <<?php echo $tag;?> class="<?php echo esc_attr($classes);?>">
            <p>
				<?php
                echo sprintf(
                    esc_html__( 'The %s will unlock access to %s.', 'xt-framework' ),
                    wp_kses_post( '<strong>' . esc_html__( 'Premium Version', 'xt-framework' ) . '</strong>' ),
                    $scope
                );
				?>
            </p>
            <p>
                <a href="<?php echo esc_url( $this->core->access_manager()->get_upgrade_url() ); ?>" class="button button-primary button-hero">
					<?php echo esc_html__( 'Upgrade License', 'xt-framework' ); ?>
                </a>
                <a href="<?php echo esc_url( $this->core->access_manager()->get_account_url( false, array( 'activate_license' => 'true' ) ) ); ?>" class="button button-secondary button-hero">
					<?php echo esc_html__( 'Activate License', 'xt-framework' ); ?>
                </a>
            </p>
        </<?php echo $tag;?>>
		<?php
	}

}
