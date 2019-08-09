<?php
/**
 * Neira Admin Class.
 *
 * @author  VolThemes
 * @package neira-lite
 * @since   neira-lite 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Neira_Lite_admin' ) ) :

	/**
	 * Neira_Lite_admin Class.
	 */
	class Neira_Lite_admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
			add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		}

		/**
		 * Add admin menu.
		 */
		public function admin_menu() {
			$theme = wp_get_theme( get_template() );

			$page = add_theme_page( esc_html__( 'About', 'neira-lite' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'neira-lite' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'neira-lite-welcome', array(
				$this,
				'welcome_screen',
			) );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function enqueue_styles() {
			global $neira_lite_version;

			wp_enqueue_style( 'neira-lite-welcome', get_template_directory_uri() . '/assets/css/welcome.css', array(), $neira_lite_version );
		}

		/**
		 * Add admin notice.
		 */
		public function admin_notice() {
			global $neira_lite_version, $pagenow;

			wp_enqueue_style( 'neira-lite-message', get_template_directory_uri() . '/assets/css/message.css', array(), $neira_lite_version );

			// Let's bail on theme activation.
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
				update_option( 'neira_lite_admin_notice_welcome', 1 );

				// No option? Let run the notice wizard again..
			} elseif ( ! get_option( 'neira_lite_admin_notice_welcome' ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			}
		}

		/**
		 * Hide a notice if the GET variable is set.
		 */
		public static function hide_notices() {
			if ( isset( $_GET['neira-lite-hide-notice'] ) && isset( $_GET['_neira_lite_notice_nonce'] ) ) {
				if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash($_GET['_neira_lite_notice_nonce']) ), 'neira_lite_hide_notices_nonce' ) ) {
					wp_die( esc_html_e( 'Action failed. Please refresh the page and retry.', 'neira-lite' ) );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( esc_html_e( 'Cheatin&#8217; huh?', 'neira-lite' ) );
				}

				$hide_notice = sanitize_text_field( wp_unslash( $_GET['neira-lite-hide-notice'] ) );
				update_option( 'neira_lite_admin_notice_' . $hide_notice, 1 );
			}
		}
			
		/**
		 * Show welcome notice.
		 */
		public function welcome_notice() {
			?>
			<div id="message" class="updated neira-lite-message">
				<a class="neira-lite-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'neira-lite-hide-notice', 'welcome' ) ), 'neira_lite_hide_notices_nonce', '_neira_lite_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'neira-lite' ); ?></a>
				<p><?php printf( 
				/* translators: 1: Display Welcome Page */
				wp_kses( __( 'Welcome! Thank you for choosing Neira Theme! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%1$s">Welcome Page</a>.', 'neira-lite' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'themes.php?page=neira-lite-welcome' ) ) ); ?></p>
				<p class="submit">
					<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=neira-lite-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Neira Lite', 'neira-lite' ); ?></a>
				</p>
			</div>
			<?php
		}

		/**
		 * Intro text/links shown to all about pages.
		 *
		 * @access private
		 */
		private function intro() {
			global $neira_lite_version;
			$theme = wp_get_theme( get_template() );

			// Drop minor version if 0
			//$major_version = substr( $neira_lite_version, 0, 3 );
			?>
			<div class="neira-lite-theme-info">
				<h1>
					<?php esc_html_e( 'About', 'neira-lite' ); ?>
					<?php echo esc_attr($theme->display( 'Name' )); ?>
					<?php printf ( '%s', esc_attr($neira_lite_version )); ?>
				</h1>

				<div class="welcome-description-wrap">
					<div class="about-text"><?php echo esc_attr($theme->display( 'Description' )); ?></div>

					<div class="neira-lite-screenshot">
						<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
					</div>
				</div>
			</div>

			<p class="neira-lite-actions">
				<a href="<?php echo esc_url( 'https://volthemes.com/themes/neira-lite/?utm_source=neira-lite-about&utm_medium=theme-info-link&utm_campaign=theme-info' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'neira-lite' ); ?></a>

				<a href="<?php echo esc_url( 'https://volthemes.com/demo/?theme=neira-lite' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'neira-lite' ); ?></a>

				<a href="<?php echo esc_url( 'https://volthemes.com/theme/neira/?utm_source=neira-lite-about&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'neira-lite' ); ?></a>

				<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/neira-lite/reviews/?filter=5' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'neira-lite' ); ?></a>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && isset( $_GET['page'] ) == 'neira-lite-welcome' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'neira-lite-welcome' ), 'themes.php' ) ) ); ?>">
					<?php echo esc_attr($theme->display( 'Name' )); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'neira-lite-welcome',
					'tab'  => 'supported_plugins',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Supported Plugins', 'neira-lite' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'neira-lite-welcome',
					'tab'  => 'free_vs_pro',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Free Vs Pro', 'neira-lite' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'neira-lite-welcome',
					'tab'  => 'changelog',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Changelog', 'neira-lite' ); ?>
				</a>
			</h2>
			<?php
		}

		/**
		 * Welcome screen page.
		 */
		public function welcome_screen() {
			$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( wp_unslash($_GET['tab'] ));
			
			// Look for a {$current_tab}_screen method.
			if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
				return $this->{$current_tab . '_screen'}();
			}

			// Fallback to about screen.
			return $this->about_screen();
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			$theme = wp_get_theme( get_template() );
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<div class="changelog point-releases">
					<div class="two-col">
						<div class="col">
							<h3><?php esc_html_e( 'Theme Customizer', 'neira-lite' ); ?></h3>
							<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'neira-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url(admin_url( 'customize.php' )); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'neira-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Documentation', 'neira-lite' ); ?></h3>
							<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'neira-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://volthemes.com/docs/neira-lite-documentation/?utm_source=neira-lite-about&utm_medium=documentation' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Documentation', 'neira-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got theme support question?', 'neira-lite' ); ?></h3>
							<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'neira-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/neira-lite' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support Forum', 'neira-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Need more features?', 'neira-lite' ); ?></h3>
							<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'neira-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://volthemes.com/theme/neira/?utm_source=neira-lite-about&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Pro', 'neira-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got sales related question?', 'neira-lite' ); ?></h3>
							<p><?php esc_html_e( 'Please send it via our sales contact page.', 'neira-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://volthemes.com/contact/?utm_source=neira-lite-about&utm_medium=contact-page-link&utm_campaign=contact-page' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Contact Page', 'neira-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3>
								<?php
								esc_html_e( 'Translate', 'neira-lite' );
								echo ' ' . esc_attr($theme->display( 'Name' ));
								?>
							</h3>
							<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'neira-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/neira-lite' ); ?>" class="button button-secondary" target="_blank">
									<?php
									esc_html_e( 'Translate', 'neira-lite' );
									echo ' ' . esc_attr($theme->display( 'Name' ));
									?>
								</a>
							</p>
						</div>
					</div>
				</div>

				<div class="return-to-dashboard neira-lite">
					<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
						<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
							<?php is_multisite() ? esc_html_e( 'Return to Updates', 'neira-lite' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'neira-lite' ); ?>
						</a> |
					<?php endif; ?>
					<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'neira-lite' ) : esc_html_e( 'Go to Dashboard', 'neira-lite' ); ?></a>
				</div>
			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function changelog_screen() {
			global $wp_filesystem;

			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'View changelog below:', 'neira-lite' ); ?></p>

				<?php
				$changelog_file = apply_filters( 'neira_lite_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog      = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
				?>
			</div>
			<?php
		}

		/**
		 * Parse changelog from readme file.
		 *
		 * @param  string $content
		 *
		 * @return string
		 */
		private function parse_changelog( $content ) {
			$matches   = null;
			$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
			$changelog = '';

			if ( preg_match( $regexp, $content, $matches ) ) {
				$changes = explode( '\r\n', trim( $matches[1] ) );

				$changelog .= '<pre class="changelog">';

				foreach ( $changes as $index => $line ) {
					$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
				}

				$changelog .= '</pre>';
			}

			return wp_kses_post( $changelog );
		}

		/**
		 * Output the supported plugins screen.
		 */
		public function supported_plugins_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'neira-lite' ); ?></p>
				<ol>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>" target="_blank"><?php esc_html_e( 'Contact Form 7', 'neira-lite' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/jetpack/' ); ?>" target="_blank"><?php esc_html_e( 'Jetpack by WordPress.com', 'neira-lite' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>" target="_blank"><?php esc_html_e( 'WooCommerce', 'neira-lite' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'neira-lite' ); ?>
					</li>
				</ol>

			</div>
			<?php
		}

		/**
		 * Output the free vs pro screen.
		 */
		public function free_vs_pro_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'neira-lite' ); ?></p>

				<table>
					<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'neira-lite' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Neira Lite', 'neira-lite' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Neira Pro', 'neira-lite' ); ?></h3></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Responsive Design', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom Logo', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Translation Ready', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Content Boxes', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Color Options', 'neira-lite' ); ?></h3></td>
						<td><?php esc_html_e( '6', 'neira-lite' ); ?></td>
						<td><?php esc_html_e( '35+ color options', 'neira-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Social Icons', 'neira-lite' ); ?></h3></td>
						<td><?php esc_html_e( '6', 'neira-lite' ); ?></td>
						<td><?php esc_html_e( '15+', 'neira-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Google Fonts Option', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '600+', 'neira-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Font Size options', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Slider', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Layout option', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Blog & Post Settings', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Override Theme Text', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Sticky Header', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Sticky Sidebar', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Woocommerce Compatible', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Instagram Feed', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Footer Copyright Editor', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom Scripts', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Content Demo', 'neira-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Support', 'neira-lite' ); ?></h3></td>
						<td><?php esc_html_e( 'WordPress Forum', 'neira-lite' ); ?></td>
						<td><?php esc_html_e( 'Support Forum + Emails/Support Ticket', 'neira-lite' ); ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'neira_lite_pro_theme_url', 'https://volthemes.com/theme/neira-lite/?utm_source=neira-lite-about&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Pro', 'neira-lite' ); ?></a>
						</td>
					</tr>
					</tbody>
				</table>

			</div>
			<?php
		}
	}

endif;

return new Neira_Lite_admin();