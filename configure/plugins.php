<?php

// Plugin installation and activation guidance.

if ( ! is_admin() ) {
	return;
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

function projecttheme_required_plugins() {
	return array(
		'acf_pro' => array(
			'name' => 'Advanced Custom Fields PRO',
			'type' => 'acf_pro',
		),
		'acf-extended' => array(
			'name' => 'Advanced Custom Fields: Extended',
			'slug' => 'acf-extended',
			'file' => 'acf-extended/acf-extended.php',
			'type' => 'directory',
		),
	);
}

function projecttheme_recommended_plugins() {
	return array(
		'cookiebot' => array(
			'name' => 'Cookiebot by Usercentrics',
			'slug' => 'cookiebot',
			'file' => 'cookiebot/cookiebot.php',
			'notice' => 'Cookiebot requires additional setup after activation, including connecting and configuring your Cookiebot account.',
		),
		'ewww-image-optimizer' => array(
			'name' => 'EWWW Image Optimizer',
			'slug' => 'ewww-image-optimizer',
			'file' => 'ewww-image-optimizer/ewww-image-optimizer.php',
		),
		'duplicate-post' => array(
			'name' => 'Yoast Duplicate Post',
			'slug' => 'duplicate-post',
			'file' => 'duplicate-post/duplicate-post.php',
		),
		'wordpress-seo' => array(
			'name' => 'Yoast SEO',
			'slug' => 'wordpress-seo',
			'file' => 'wordpress-seo/wp-seo.php',
		),
	);
}

function projecttheme_is_acf_pro_active() {
	$acf_pro_file = projecttheme_get_acf_pro_plugin_file();

	if ( ! $acf_pro_file || ! is_plugin_active( $acf_pro_file ) ) {
		return false;
	}

	return defined( 'ACF_PRO' ) && ACF_PRO;
}

function projecttheme_get_acf_pro_plugin_file() {
	static $acf_pro_file = null;

	if ( null !== $acf_pro_file ) {
		return $acf_pro_file;
	}

	$acf_pro_file = false;
	foreach ( get_plugins() as $plugin_file => $plugin_data ) {
		if (
			! empty( $plugin_data['Name'] )
			&& false !== stripos( $plugin_data['Name'], 'Advanced Custom Fields' )
			&& false !== stripos( $plugin_data['Name'], 'PRO' )
		) {
			$acf_pro_file = $plugin_file;
			break;
		}
	}

	return $acf_pro_file;
}

function projecttheme_plugin_is_active( $plugin ) {
	if ( isset( $plugin['type'] ) && 'acf_pro' === $plugin['type'] ) {
		return projecttheme_is_acf_pro_active();
	}

	return is_plugin_active( $plugin['file'] );
}

function projecttheme_plugin_action_url( $slug ) {
	return wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'projecttheme_install_plugin',
				'plugin' => $slug,
			),
			admin_url( 'admin-post.php' )
		),
		'projecttheme_install_' . $slug
	);
}

function projecttheme_plugin_status_notice() {
	if ( ! current_user_can( 'activate_plugins' ) && ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$missing_required = array();
	foreach ( projecttheme_required_plugins() as $plugin ) {
		if ( ! projecttheme_plugin_is_active( $plugin ) ) {
			$missing_required[] = $plugin;
		}
	}

	if ( ! empty( $missing_required ) ) {
		echo '<div class="notice notice-warning">';
		echo '<p><strong>Theme plugins require attention.</strong> Please install and activate the following plugins:</p>';
		echo '<ul>';

		foreach ( $missing_required as $plugin ) {
			echo '<li><strong>' . esc_html( $plugin['name'] ) . '</strong>';

			if ( 'acf_pro' === $plugin['type'] ) {
				if ( projecttheme_get_acf_pro_plugin_file() ) {
					echo '<p>ACF PRO is installed but not active. Activate it from the <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">Plugins page</a>.</p>';
				} elseif ( current_user_can( 'install_plugins' ) ) {
					echo '<p>Install and activate the provided ACF PRO ZIP first. We will activate the license together in the course afterwards.</p>';
					echo '<a class="button button-secondary" href="' . esc_url( admin_url( 'plugin-install.php?tab=upload' ) ) . '">Upload ACF PRO ZIP</a>';
				} else {
					echo '<p>Install and activate the provided ACF PRO ZIP first. We will activate the license together in the course afterwards.</p>';
				}
			} elseif ( ! projecttheme_is_acf_pro_active() ) {
				echo '<p class="description">Install and activate ACF PRO before installing or activating ACF Extended.</p>';
			} elseif ( current_user_can( 'install_plugins' ) ) {
				echo ' &mdash; <a href="' . esc_url( projecttheme_plugin_action_url( $plugin['slug'] ) ) . '">Install and activate</a>';
				echo '<p class="description">ACF PRO must be installed and active first.</p>';
			} elseif ( current_user_can( 'activate_plugins' ) ) {
				echo ' &mdash; activate it from the <a href="' . esc_url( admin_url( 'plugins.php' ) ) . 'Plugins page</a>.';
			}

			echo '</li>';
		}

		echo '</ul>';
		echo '</div>';
	}
}
add_action( 'admin_notices', 'projecttheme_plugin_status_notice' );

function projecttheme_recommended_plugin_notice() {
	if ( ! current_user_can( 'activate_plugins' ) && ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$dismissed = get_user_meta( get_current_user_id(), 'projecttheme_dismiss_recommended_plugins', true );
	if ( $dismissed ) {
		return;
	}

	$missing = array();
	foreach ( projecttheme_recommended_plugins() as $plugin ) {
		if ( ! projecttheme_plugin_is_active( $plugin ) ) {
			$missing[] = $plugin;
		}
	}

	if ( empty( $missing ) ) {
		return;
	}

	$dismiss_url = wp_nonce_url(
		admin_url( 'admin-post.php?action=projecttheme_dismiss_recommended_plugins' ),
		'projecttheme_dismiss_recommended_plugins'
	);

	echo '<div class="notice notice-info is-dismissible">';
	echo '<p><strong>Recommended plugins.</strong> The following optional plugins are not active:</p>';
	echo '<ul>';
	foreach ( $missing as $plugin ) {
		echo '<li><strong>' . esc_html( $plugin['name'] ) . '</strong>';
		if ( current_user_can( 'install_plugins' ) ) {
			echo ' &mdash; <a href="' . esc_url( projecttheme_plugin_action_url( $plugin['slug'] ) ) . '">Install and activate</a>';
		} elseif ( current_user_can( 'activate_plugins' ) ) {
			echo ' &mdash; activate it from the <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">Plugins page</a>.';
		}
		if ( ! empty( $plugin['notice'] ) ) {
			echo '<p class="description">' . esc_html( $plugin['notice'] ) . '</p>';
		}
		echo '</li>';
	}
	echo '</ul>';
	echo '<p><a href="' . esc_url( $dismiss_url ) . '">Dismiss this recommendation</a></p>';
	echo '</div>';
}
add_action( 'admin_notices', 'projecttheme_recommended_plugin_notice' );

function projecttheme_install_plugin() {
	check_admin_referer( 'projecttheme_install_' . ( isset( $_GET['plugin'] ) ? sanitize_key( $_GET['plugin'] ) : '' ) );

	if ( ! current_user_can( 'install_plugins' ) ) {
		wp_die( esc_html__( 'You do not have permission to install plugins.', 'projecttheme' ) );
	}

	$slug = isset( $_GET['plugin'] ) ? sanitize_key( $_GET['plugin'] ) : '';
	$plugins = array_merge( projecttheme_required_plugins(), projecttheme_recommended_plugins() );
	if ( empty( $plugins[ $slug ]['slug'] ) ) {
		wp_die( esc_html__( 'The requested plugin is not available.', 'projecttheme' ) );
	}

	$plugin = $plugins[ $slug ];
	if ( 'acf-extended' === $slug && ! projecttheme_is_acf_pro_active() ) {
		wp_die( esc_html__( 'Install and activate ACF PRO before installing ACF Extended.', 'projecttheme' ) );
	}
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

	$api = plugins_api( 'plugin_information', array( 'slug' => $plugin['slug'], 'fields' => array( 'download_link' => true ) ) );
	if ( is_wp_error( $api ) ) {
		wp_die( esc_html( $api->get_error_message() ) );
	}

	$upgrader = new Plugin_Upgrader( new Automatic_Upgrader_Skin() );
	if ( ! $upgrader->install( $api->download_link ) ) {
		wp_die( esc_html__( 'The plugin could not be installed.', 'projecttheme' ) );
	}

	$plugin_file = $plugin['file'];
	if ( ! is_plugin_active( $plugin_file ) && current_user_can( 'activate_plugins' ) ) {
		$result = activate_plugin( $plugin_file );
		if ( is_wp_error( $result ) ) {
			wp_die( esc_html( $result->get_error_message() ) );
		}
	}

	wp_safe_redirect( admin_url( 'plugins.php' ) );
	exit;
}
add_action( 'admin_post_projecttheme_install_plugin', 'projecttheme_install_plugin' );

function projecttheme_dismiss_recommended_plugins() {
	check_admin_referer( 'projecttheme_dismiss_recommended_plugins' );

	if ( ! current_user_can( 'activate_plugins' ) && ! current_user_can( 'install_plugins' ) ) {
		wp_die( esc_html__( 'You do not have permission to dismiss this notice.', 'projecttheme' ) );
	}

	update_user_meta( get_current_user_id(), 'projecttheme_dismiss_recommended_plugins', 1 );
	wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );
	exit;
}
add_action( 'admin_post_projecttheme_dismiss_recommended_plugins', 'projecttheme_dismiss_recommended_plugins' );
