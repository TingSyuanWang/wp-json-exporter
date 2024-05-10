<?php
/**
 * File for class WP_Json_Exporter_Uninstall.
 *
 * @package WP_JSON_Exporter
 */

if ( ! class_exists( 'WP_Json_Exporter_Uninstall' ) ) {
	/**
	 * Class WP_Json_Exporter_Uninstall
	 *
	 * This class handles the uninstallation procedures of the plugin.
	 */
	class WP_Json_Exporter_Uninstall {
		/**
		 * Uninstall the plugin.
		 *
		 * This method handles the uninstallation cleanup for the plugin.
		 */
		public static function uninstall(): void {
			/** Remove options */
			delete_option( 'wp_json_exporter_version' );
			delete_option( 'wp_json_exporter_is_redirect' );
			delete_option( 'wp_json_exporter_redirect_url' );
			/** Remove visits table */
			self::wp_json_exporter_uninstall();
		}

		private static function wp_json_exporter_uninstall() {
			global $wpdb;
			$table_name = $wpdb->prefix . WP_JSON_EXPORTER_VISITS_TABLE;

			$sql = $wpdb->prepare( 'DROP TABLE IF EXISTS %s', $table_name );
			$wpdb->query( $sql ); // phpcs:ignore
		}
	}
}
