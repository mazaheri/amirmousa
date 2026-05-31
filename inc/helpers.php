<?php
/**
 * Dynamic content helpers.
 *
 * Every template pulls its copy and images through these getters with the
 * ORIGINAL prototype value as the fallback. Result: identical to the prototype
 * out of the box, but every string/image is editable in the Customizer and
 * via the Import & Sync page — with no risk of breakage if a value is empty.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get an editable text value (theme mod), escaped for HTML output.
 *
 * @param string $key      Theme-mod key (without the spr_ prefix is fine; we add it).
 * @param string $fallback Original prototype text.
 * @param bool   $echo     Echo (default) or return.
 * @return string
 */
function spr_text( $key, $fallback = '', $echo = true ) {
	$value = get_theme_mod( 'spr_' . $key, $fallback );
	$out   = esc_html( $value );
	if ( $echo ) {
		echo $out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
	}
	return $out;
}

/**
 * Get an editable text value allowing safe inline HTML (e.g. <br>, <em>, links).
 *
 * @param string $key
 * @param string $fallback
 * @param bool   $echo
 * @return string
 */
function spr_html( $key, $fallback = '', $echo = true ) {
	$value = get_theme_mod( 'spr_' . $key, $fallback );
	$out   = wp_kses_post( $value );
	if ( $echo ) {
		echo $out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- kses-filtered.
	}
	return $out;
}

/**
 * Get the raw (unescaped) editable value — only for use inside attributes you
 * escape yourself (esc_url, esc_attr) or for comparisons.
 *
 * @param string $key
 * @param string $fallback
 * @return string
 */
function spr_raw( $key, $fallback = '' ) {
	return get_theme_mod( 'spr_' . $key, $fallback );
}

/**
 * Resolve an image to a usable URL.
 *
 * Looks up an attachment ID stored in a theme mod (set by the importer). If the
 * importer has not run yet (no ID), falls back to the bundled file under
 * content/images/ so the design never shows a broken image during development.
 *
 * @param string $mod_key       Theme-mod key holding the attachment ID (without spr_ prefix).
 * @param string $fallback_file Relative path under content/images/ used before import.
 * @param string $size          Image size; default 'full' (register-upload pattern safe).
 * @return string URL (may be empty string if nothing found).
 */
function spr_img_url( $mod_key, $fallback_file = '', $size = 'full' ) {
	$att_id = (int) get_theme_mod( 'spr_' . $mod_key, 0 );
	if ( $att_id ) {
		$url = wp_get_attachment_image_url( $att_id, $size );
		if ( $url ) {
			return $url;
		}
		// Named size missing (register-upload pattern) — try full.
		$url = wp_get_attachment_url( $att_id );
		if ( $url ) {
			return $url;
		}
	}
	if ( $fallback_file ) {
		return get_template_directory_uri() . '/content/images/' . ltrim( $fallback_file, '/' );
	}
	return '';
}

/**
 * Output the contact form area.
 *
 * If a Contact Form 7 form ID has been saved (option spr_contact_form_id), CF7
 * is active, AND the form actually renders, output it wrapped in .spr-cf7 so it
 * inherits the prototype styling. If the form is missing/broken (CF7 would emit
 * "Error: Contact form not found.") we DON'T show that error — we fall through
 * to the styled mailto block instead, so visitors never see a raw CF7 error.
 *
 * @return void
 */
function spr_contact_form() {
	// CF7 5.9+ uses a hash-based id (e.g. "1d3f601"); older versions use the
	// numeric post ID. Store and pass it verbatim as a string — CF7 accepts both.
	$form_id = trim( (string) get_option( 'spr_contact_form_id', '' ) );
	$email   = spr_raw( 'contact_email', 's.prestige.international@gmail.com' );

	if ( '' !== $form_id && shortcode_exists( 'contact-form-7' ) ) {
		$rendered = do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"]' );
		// Only show it if a real form came back; otherwise hide and use the fallback.
		if ( false !== stripos( $rendered, '<form' ) ) {
			echo '<div class="spr-cf7">';
			echo $rendered; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CF7 output.
			echo '</div>';
			return;
		}
	}

	// Fallback — styled prompt + mailto button (no JS, server-safe).
	?>
	<div class="spr-cf7-fallback">
		<p style="font-size:14px; color:var(--text-muted); line-height:1.7; margin-bottom:22px;">
			<?php esc_html_e( 'Tell us the product, grade, quantity, and destination — our team responds within one business day.', 's-prestige' ); ?>
		</p>
		<a href="<?php echo esc_url( 'mailto:' . $email ); ?>" class="btn-primary contact-submit" style="text-decoration:none;">
			<?php esc_html_e( 'Email us your enquiry', 's-prestige' ); ?>
			<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
		</a>
		<?php if ( current_user_can( 'manage_options' ) && '' === $form_id ) : ?>
			<p style="font-size:12px; color:var(--text-muted); margin-top:16px;">
				<?php
				printf(
					/* translators: %s: admin link to the Import & Sync page. */
					wp_kses_post( __( 'Admin tip: install Contact Form 7, then set its form ID under %s to replace this with the real form.', 's-prestige' ) ),
					'<a href="' . esc_url( admin_url( 'themes.php?page=spr-import' ) ) . '">' . esc_html__( 'Appearance → Import &amp; Sync', 's-prestige' ) . '</a>'
				);
				?>
			</p>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Resolve the URL of a theme page by the option the importer stores its ID in,
 * with a slug fallback, and finally a home anchor.
 *
 * @param string $option_key Option holding the page ID.
 * @param string $slug       Page slug fallback.
 * @param string $anchor     Final fallback path/anchor (relative to home).
 * @return string
 */
function spr_page_url( $option_key, $slug = '', $anchor = '/' ) {
	$id = (int) get_option( $option_key, 0 );
	if ( $id && get_post( $id ) ) {
		return get_permalink( $id );
	}
	if ( $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			return get_permalink( $page->ID );
		}
	}
	return home_url( $anchor );
}

/**
 * URL for the Contact area. Contact lives in the home page's #contact section,
 * so this points at the front page anchor unless a dedicated Contact page exists.
 *
 * @return string
 */
function spr_contact_url() {
	$id = (int) get_option( 'spr_contact_page_id', 0 );
	if ( $id && get_post( $id ) ) {
		return get_permalink( $id );
	}
	return home_url( '/#contact' );
}

/**
 * Render the primary navigation links.
 *
 * Uses the WP menu assigned to the 'primary' location when present (fully
 * editable under Appearance → Menus); otherwise falls back to the prototype's
 * four links resolved to real WordPress URLs.
 *
 * @return void
 */
function spr_nav_links() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => '',
				'items_wrap'     => '%3$s',
				'fallback_cb'    => false,
				'walker'         => new SPR_Nav_Walker(),
				'depth'          => 1,
			)
		);
		return;
	}

	$products = spr_page_url( 'spr_products_page_id', 'products', '/products/' );
	$about    = spr_page_url( 'spr_about_page_id', 'about', '/about/' );
	$current  = '';
	if ( is_page() ) {
		global $post;
		$current = $post ? $post->post_name : '';
	}
	$links = array(
		array( 'url' => $products, 'label' => __( 'Products', 's-prestige' ), 'active' => ( 'products' === $current ) ),
		array( 'url' => $about, 'label' => __( 'About Us', 's-prestige' ), 'active' => ( 'about' === $current ) ),
		array( 'url' => trailingslashit( $about ) . '#services', 'label' => __( 'Services', 's-prestige' ), 'active' => false ),
		array( 'url' => spr_contact_url(), 'label' => __( 'Contact', 's-prestige' ), 'active' => false ),
	);
	foreach ( $links as $l ) {
		printf(
			'<a href="%s" class="nav-link%s">%s</a>',
			esc_url( $l['url'] ),
			$l['active'] ? ' active' : '',
			esc_html( $l['label'] )
		);
	}
}

/**
 * Minimal nav walker that outputs the prototype's flat <a class="nav-link"> links.
 */
class SPR_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$active  = ( in_array( 'current-menu-item', $classes, true ) ) ? ' active' : '';
		$output .= sprintf(
			'<a href="%s" class="nav-link%s">%s</a>',
			esc_url( $item->url ),
			$active,
			esc_html( $item->title )
		);
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * Render the small periwinkle star logomark SVG used throughout the design.
 *
 * @param int    $size Pixel size.
 * @param string $fill Fill colour.
 * @return void
 */
function spr_star( $size = 24, $fill = 'white' ) {
	printf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 40 40" fill="none"><path d="M20 0L22.5 17.5L40 20L22.5 22.5L20 40L17.5 22.5L0 20L17.5 17.5L20 0Z" fill="%2$s"/></svg>',
		(int) $size,
		esc_attr( $fill )
	);
}
