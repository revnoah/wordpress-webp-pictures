<?php
/**
 * Plugin Name:       WebP Pictures
 * Plugin URI:        https://github.com/revnoah/wordpress-webp-pictures
 * Description:       A plugin that replaces standard img tags with pictures tags and generates webp images
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Noah J. Stewart
 * Author URI:        https://noahjstewart.com
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       webp-pictures
 * Domain Path:       /languages
 *
 * @package WebpPictures
 */

namespace noahjstewart\WebpPictures;

define( 'WEBP_PICTURES_VERSION', '1.0.0' );
define( 'WEBP_PICTURES_FILE', __FILE__ );

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

class WebpPictures {

	/**
	 * Holds the class instance.
	 *
	 * @var WebpPictures $instance
	 */
	private static $instance = null;


	/**
	 * Return an instance of the class
	 *
	 * Return an instance of the WebpPictures Class.
	 *
	 * @since 1.0.0
	 *
	 * @return WebpPictures class instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class initializer.
	 */
	public function plugins_loaded() {
		load_plugin_textdomain(
			'webp-pictures',
			false,
			basename( dirname( __FILE__ ) ) . '/languages'
		);

		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Init plugin, add filters
	 */
	public function init() {
		add_filter( 'post_thumbnail_html', array('WebpPictures', 'filter_image_thumbnail_webp' ));
	}    

    private function get_image_webp( $thumbnail_src, $url_only = false ) {
        $thumbnail_src_parts = explode('/', $thumbnail_src);

        $dest_file = $thumbnail_src_parts[count($thumbnail_src_parts) - 1];

        $upload_pos = array_search('uploads', $thumbnail_src_parts);
        $parts = array_splice($thumbnail_src_parts, -1, 3);
        $dest_file = implode('-', $parts);

        if (stristr($thumbnail_src, '.png')) {
            $dest_file = str_replace('.png', '.webp', $dest_file);
            $img_type = 'image/png';
        } else {
            $dest_file = str_replace('.jpg', '.webp', $dest_file);
            $img_type = 'image/jpeg';
        }
        $upload_dir = wp_upload_dir();

        $dest_src = $upload_dir['baseurl']  . '/webp/' . $dest_file;
        $dest_file = $upload_dir['basedir']  . '/webp/' . $dest_file;

        if (!file_exists($dest_file)) {
            if ($img_type === 'image/png') {
                $im = imagecreatefrompng($thumbnail_src);
            } else {
                $im = imagecreatefromjpeg($thumbnail_src);
            }
            
            imagewebp($im, $dest_file);
            imagedestroy($im);
        }

        if ($url_only) {
            return $dest_src;
        }

        $size = getimagesize($thumbnail_src);

        $output = '<picture>
            <source srcset="' . $dest_src . '" type="image/webp">
            <source srcset="' . $thumbnail_src . '" type="' . $img_type . '">'
            . '<img src="' . $thumbnail_src . '" width="' . $size[0] . '" height="' . $size[1] . '" />'
            . '</picture>';

        return $output;
    }

    /**
     * Filter to add webp version to thumbnail output
     *
     * @param string $thumbnail_img
     * @return string
     */
    public function filter_image_thumbnail_webp( $thumbnail_img ) {
        preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $thumbnail_img, $img_src_matches);
        $thumbnail_src = $img_src_matches[1];

        $output = $this->get_image_webp($thumbnail_src);

        return $output;
    }
}

add_action(
	'plugins_loaded',
	function() {
		$WEBP_PICTURES = WebPictures::get_instance();
		$WEBP_PICTURES->plugins_loaded();
	}
);
