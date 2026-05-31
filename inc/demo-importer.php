<?php
/**
 * Import & Sync — the admin page that populates the site from theme assets.
 *
 * Based on the v5 "Import Demo & Git Workflow" methodology, tailored to this
 * project (no portfolio CPT → no AJAX chunk loop; only 6 images, imported
 * synchronously with MD5-hash dedup so re-running never duplicates).
 *
 * Components:
 *   pages   — create Home/Products/About/Contact, assign templates, set front page, build nav menu
 *   images  — import the 6 content/images files as attachments, store IDs in theme mods
 *   text    — apply all Customizer text defaults (initial fill / re-baseline)
 *   contact — save the Contact Form 7 form ID the user enters
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Admin menu ───────────────────────────────────────────────────────────────
function spr_demo_menu() {
	add_theme_page(
		__( 'Import & Sync', 's-prestige' ),
		__( 'Import & Sync', 's-prestige' ),
		'manage_options',
		'spr-import',
		'spr_demo_page'
	);
}
add_action( 'admin_menu', 'spr_demo_menu' );

// ── Component registry ─────────────────────────────────────────────────────────
function spr_get_components() {
	return array(
		'pages'  => array(
			'label' => __( 'Pages &amp; Menu', 's-prestige' ),
			'desc'  => __( 'Creates Home (front page), Products, About & Contact pages, assigns templates, builds the primary nav menu.', 's-prestige' ),
			'fn'    => 'spr_import_pages',
		),
		'images' => array(
			'label' => __( 'Images &amp; Video', 's-prestige' ),
			'desc'  => __( 'Imports the 4 product images, the shipping image, and the hero video as real media attachments (hash-deduped — unchanged files are skipped).', 's-prestige' ),
			'fn'    => 'spr_import_images',
		),
		'text'   => array(
			'label' => __( 'Site Text &amp; Copy', 's-prestige' ),
			'desc'  => __( 'Applies all default headings, descriptions, contact details, and FAQ copy as Customizer values (only fills blanks — won’t overwrite your edits unless Reset is used).', 's-prestige' ),
			'fn'    => 'spr_import_text',
		),
	);
}

function spr_get_component( $key ) {
	$c = spr_get_components();
	return isset( $c[ $key ] ) ? $c[ $key ] : null;
}

// ── Admin page UI ───────────────────────────────────────────────────────────────
function spr_demo_page() {
	$notices = array();

	// Handle Contact Form 7 ID save.
	if ( isset( $_POST['spr_save_cf7'] ) && check_admin_referer( 'spr_import_nonce' ) ) {
		$cf7_id = isset( $_POST['spr_cf7_id'] ) ? absint( $_POST['spr_cf7_id'] ) : 0;
		update_option( 'spr_contact_form_id', $cf7_id );
		$notices[] = array( 'success', $cf7_id ? sprintf( __( 'Contact Form 7 form #%d saved.', 's-prestige' ), $cf7_id ) : __( 'Contact form ID cleared — the mailto fallback will show.', 's-prestige' ) );
	}

	// Handle selected-component sync.
	if ( isset( $_POST['spr_sync_selected'] ) && check_admin_referer( 'spr_import_nonce' ) ) {
		spr_load_media_includes();
		$selected = isset( $_POST['components'] ) ? array_map( 'sanitize_key', (array) $_POST['components'] ) : array();
		$done     = array();
		foreach ( $selected as $key ) {
			$comp = spr_get_component( $key );
			if ( $comp && is_callable( $comp['fn'] ) ) {
				call_user_func( $comp['fn'] );
				$done[] = wp_strip_all_tags( $comp['label'] );
			}
		}
		flush_rewrite_rules( false );
		if ( $done ) {
			$notices[] = array( 'success', sprintf( __( 'Synced: %s', 's-prestige' ), implode( ', ', $done ) ) );
		}
	}

	// Handle Sync All.
	if ( isset( $_POST['spr_sync_all'] ) && check_admin_referer( 'spr_import_nonce' ) ) {
		spr_run_full_import();
		$notices[] = array( 'success', __( 'Full sync complete.', 's-prestige' ) );
	}

	// Handle Reset.
	if ( isset( $_POST['spr_reset'] ) && check_admin_referer( 'spr_import_nonce' ) ) {
		spr_reset_content();
		spr_run_full_import();
		$notices[] = array( 'success', __( 'Reset complete — everything re-imported from theme assets.', 's-prestige' ) );
	}

	$status     = spr_check_status();
	$components = spr_get_components();
	$cf7_active = shortcode_exists( 'contact-form-7' );
	$cf7_saved  = (int) get_option( 'spr_contact_form_id', 0 );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'S-Prestige — Import &amp; Sync', 's-prestige' ); ?></h1>

		<?php foreach ( $notices as $n ) : ?>
			<div class="notice notice-<?php echo esc_attr( $n[0] ); ?> is-dismissible"><p><?php echo esc_html( $n[1] ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'View site →', 's-prestige' ); ?></a></p></div>
		<?php endforeach; ?>

		<div style="max-width:760px; margin-top:1.5rem;">

			<?php if ( 'ok' === $status['status'] ) : ?>
				<div class="notice notice-success inline" style="margin-bottom:1.5rem;"><p>✅ <?php esc_html_e( 'Site is set up and content is in place.', 's-prestige' ); ?></p></div>
			<?php elseif ( 'needs_sync' === $status['status'] ) : ?>
				<div class="notice notice-warning inline" style="margin-bottom:1.5rem;"><p>⚠️ <?php echo esc_html( implode( ' · ', $status['messages'] ) ); ?></p></div>
			<?php else : ?>
				<div class="notice notice-error inline" style="margin-bottom:1.5rem;"><p>🔴 <?php echo esc_html( implode( ' · ', $status['messages'] ) ); ?> — <?php esc_html_e( 'use "Sync All" below for a first-time setup.', 's-prestige' ); ?></p></div>
			<?php endif; ?>

			<!-- First-time / full sync -->
			<div style="padding:1rem 1.25rem; background:#f0f6fc; border-left:4px solid #2271b1; margin-bottom:1.5rem;">
				<h2 style="margin-top:0;"><?php esc_html_e( 'First-time setup', 's-prestige' ); ?></h2>
				<p style="font-size:13px; color:#555;"><?php esc_html_e( 'On a fresh site (or after a git pull on production), click Sync All. It creates the pages, sets the front page, imports the images/video, and fills in the default copy. Safe to run repeatedly — unchanged images are skipped.', 's-prestige' ); ?></p>
				<form method="post"><?php wp_nonce_field( 'spr_import_nonce' ); ?>
					<?php submit_button( __( 'Sync All', 's-prestige' ), 'primary large', 'spr_sync_all', false ); ?>
				</form>
			</div>

			<!-- Component selector -->
			<form method="post">
				<?php wp_nonce_field( 'spr_import_nonce' ); ?>
				<h3 style="margin-bottom:.25rem;"><?php esc_html_e( 'Sync individual components', 's-prestige' ); ?></h3>
				<p style="color:#666;font-size:13px;margin:0 0 1rem;"><?php esc_html_e( 'Pick what to refresh after a content change.', 's-prestige' ); ?></p>
				<table class="wp-list-table widefat striped" style="margin-bottom:1rem;">
					<thead><tr>
						<th style="width:36px;padding:8px 10px;"><input type="checkbox" id="spr-select-all"></th>
						<th style="padding:8px 10px;"><?php esc_html_e( 'Component', 's-prestige' ); ?></th>
					</tr></thead>
					<tbody>
						<?php foreach ( $components as $key => $comp ) : ?>
						<tr>
							<td style="padding:10px;"><input type="checkbox" name="components[]" value="<?php echo esc_attr( $key ); ?>"></td>
							<td style="padding:10px;">
								<strong><?php echo wp_kses_post( $comp['label'] ); ?></strong><br>
								<span style="color:#666;font-size:12px;"><?php echo esc_html( $comp['desc'] ); ?></span>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<script>
				document.getElementById('spr-select-all').addEventListener('change', function () {
					document.querySelectorAll('input[name="components[]"]').forEach(function (cb) { cb.checked = this.checked; }, this);
				});
				</script>
				<?php submit_button( __( 'Sync Selected', 's-prestige' ), 'secondary large', 'spr_sync_selected', false ); ?>
			</form>

			<!-- Contact Form 7 -->
			<div style="margin-top:2rem; padding:1rem 1.25rem; background:#fff; border:1px solid #dcdcde; border-radius:4px;">
				<h3 style="margin-top:0;"><?php esc_html_e( 'Contact Form 7', 's-prestige' ); ?></h3>
				<?php if ( ! $cf7_active ) : ?>
					<p style="font-size:13px; color:#b32d2e;">⚠️ <?php esc_html_e( 'Contact Form 7 is not active yet. Install & activate it, create a form, then enter its ID here. Until then the contact section shows a styled “Email us” button.', 's-prestige' ); ?></p>
				<?php else : ?>
					<p style="font-size:13px; color:#1a5c2e;">✅ <?php esc_html_e( 'Contact Form 7 is active. Enter the ID of the form you want shown in the contact section.', 's-prestige' ); ?></p>
				<?php endif; ?>
				<form method="post">
					<?php wp_nonce_field( 'spr_import_nonce' ); ?>
					<label for="spr_cf7_id" style="font-size:13px;"><?php esc_html_e( 'CF7 form ID:', 's-prestige' ); ?></label>
					<input type="number" min="0" id="spr_cf7_id" name="spr_cf7_id" value="<?php echo esc_attr( $cf7_saved ); ?>" style="width:90px;">
					<?php submit_button( __( 'Save form ID', 's-prestige' ), 'secondary', 'spr_save_cf7', false ); ?>
					<span style="font-size:12px; color:#666;"><?php esc_html_e( 'Tip: in Contact → Forms, the ID is in the shortcode, e.g. [contact-form-7 id="42"].', 's-prestige' ); ?></span>
				</form>
			</div>

			<!-- Reset (danger) -->
			<details style="margin-top:1.5rem;">
				<summary style="cursor:pointer;font-weight:600;color:#856404;font-size:14px;">▶ <?php esc_html_e( 'Reset &amp; Reimport Everything (destructive)', 's-prestige' ); ?></summary>
				<div style="margin-top:.75rem;padding:.75rem 1rem;background:#fff3cd;border-left:4px solid #ffc107;">
					<p style="margin:0 0 .75rem;font-size:13px;"><?php esc_html_e( 'Deletes all importer-managed images, clears stored IDs and resets every text/image Customizer value back to the theme defaults, then re-imports. Your manual Customizer edits will be lost.', 's-prestige' ); ?></p>
					<form method="post" onsubmit="return confirm('<?php echo esc_js( __( 'This deletes imported images and resets all content to defaults. Are you sure?', 's-prestige' ) ); ?>');">
						<?php wp_nonce_field( 'spr_import_nonce' ); ?>
						<?php submit_button( __( 'Reset & Reimport Everything', 's-prestige' ), 'secondary', 'spr_reset', false, array( 'style' => 'background:#856404;color:#fff;border-color:#856404;' ) ); ?>
					</form>
				</div>
			</details>

		</div>
	</div>
	<?php
}

// ── Shared media includes ─────────────────────────────────────────────────────
function spr_load_media_includes() {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
}

// ── Status check ────────────────────────────────────────────────────────────────
function spr_check_status() {
	$messages = array();
	$severity = 'ok';

	if ( 'page' !== get_option( 'show_on_front' ) || ! get_option( 'page_on_front' ) ) {
		$messages[] = __( 'Front page not set', 's-prestige' );
		$severity   = 'needs_reset';
	}
	if ( ! get_option( 'spr_products_page_id' ) || ! get_option( 'spr_about_page_id' ) ) {
		$messages[] = __( 'Product/About pages missing', 's-prestige' );
		$severity   = 'needs_reset';
	}
	if ( ! get_theme_mod( 'spr_prod_steel_id' ) ) {
		$messages[] = __( 'Images not imported', 's-prestige' );
		if ( 'needs_reset' !== $severity ) {
			$severity = 'needs_sync';
		}
	}

	return array( 'status' => $severity, 'messages' => $messages );
}

// ── Full import runner ──────────────────────────────────────────────────────────
function spr_run_full_import() {
	spr_load_media_includes();
	spr_import_pages();
	spr_import_images();
	spr_import_text();
	flush_rewrite_rules( false );
	return true;
}

// ── Reset ─────────────────────────────────────────────────────────────────────
function spr_reset_content() {
	// Delete importer-managed attachments.
	$managed = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'meta_query'     => array( array( 'key' => '_source_file_path', 'compare' => 'EXISTS' ) ), // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);
	foreach ( $managed as $att_id ) {
		wp_delete_attachment( $att_id, true );
	}

	// Clear image-ID theme mods.
	foreach ( array( 'spr_hero_video_id', 'spr_prod_steel_id', 'spr_prod_minerals_id', 'spr_prod_petrochemicals_id', 'spr_prod_chemicals_id', 'spr_ship_image_id' ) as $mod ) {
		remove_theme_mod( $mod );
	}

	// Clear text theme mods (so import re-baselines from defaults).
	foreach ( array_keys( spr_content_defaults() ) as $key ) {
		remove_theme_mod( 'spr_' . $key );
	}
}

// ── Pattern: smart hash-deduped import of a theme-asset file ─────────────────────
function spr_smart_import_file( $full_path ) {
	if ( ! file_exists( $full_path ) ) {
		return new WP_Error( 'not_found', "File not found: $full_path" );
	}

	$hash      = md5_file( $full_path );
	$norm_path = wp_normalize_path( $full_path );

	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'meta_query'     => array( array( 'key' => '_source_file_path', 'value' => $norm_path ) ), // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);

	if ( $existing ) {
		$att_id = $existing[0]->ID;
		if ( get_post_meta( $att_id, '_source_file_hash', true ) === $hash ) {
			return array( 'id' => $att_id, 'status' => 'skipped' );
		}
		wp_delete_attachment( $att_id, true );
	}

	$upload = wp_upload_bits( basename( $full_path ), null, file_get_contents( $full_path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( ! empty( $upload['error'] ) ) {
		return new WP_Error( 'upload_failed', $upload['error'] );
	}

	$mime   = wp_check_filetype( $upload['file'] );
	$att_id = wp_insert_attachment(
		array(
			'guid'           => $upload['url'],
			'post_mime_type' => $mime['type'],
			'post_title'     => sanitize_file_name( basename( $full_path ) ),
			'post_status'    => 'inherit',
		),
		$upload['file']
	);

	if ( is_wp_error( $att_id ) ) {
		return $att_id;
	}

	// Videos get no thumbnail metadata; images do.
	if ( 0 === strpos( (string) $mime['type'], 'image/' ) ) {
		wp_update_attachment_metadata( $att_id, wp_generate_attachment_metadata( $att_id, $upload['file'] ) );
	}
	update_post_meta( $att_id, '_source_file_path', $norm_path );
	update_post_meta( $att_id, '_source_file_hash', $hash );

	return array( 'id' => $att_id, 'status' => 'imported' );
}

// ── Component: images & video ────────────────────────────────────────────────────
function spr_import_images() {
	$dir = trailingslashit( get_template_directory() . '/content/images' );
	$map = array(
		'prod_steel.jpg'          => 'spr_prod_steel_id',
		'prod_minerals.jpg'       => 'spr_prod_minerals_id',
		'prod_petrochemicals.jpg' => 'spr_prod_petrochemicals_id',
		'prod_chemicals.jpg'      => 'spr_prod_chemicals_id',
		'cta_sea.jpg'             => 'spr_ship_image_id',
		'ship.mp4'                => 'spr_hero_video_id',
	);
	foreach ( $map as $file => $mod ) {
		$result = spr_smart_import_file( $dir . $file );
		if ( ! is_wp_error( $result ) ) {
			set_theme_mod( $mod, (int) $result['id'] );
		}
	}
}

// ── Component: pages & menu ──────────────────────────────────────────────────────
function spr_import_pages() {
	// Home (front page) — uses front-page.php automatically by template hierarchy.
	$home_id = (int) get_option( 'page_on_front' );
	if ( ! $home_id || ! get_post( $home_id ) ) {
		$existing = get_page_by_path( 'home' );
		$home_id  = $existing ? $existing->ID : wp_insert_post(
			array(
				'post_title'  => 'Home',
				'post_status' => 'publish',
				'post_type'   => 'page',
				'post_name'   => 'home',
			)
		);
	}
	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}

	// Products page.
	$products_id = spr_ensure_page( 'Products', 'products', 'page-products.php', 'spr_products_page_id' );
	// About page.
	$about_id    = spr_ensure_page( 'About', 'about', 'page-about.php', 'spr_about_page_id' );

	// Build the primary nav menu (idempotent).
	spr_import_nav_menu( $products_id, $about_id );
}

/**
 * Create or update a page bound to a template, recording its ID in an option.
 *
 * @return int Page ID.
 */
function spr_ensure_page( $title, $slug, $template, $option_key ) {
	$page_id = (int) get_option( $option_key, 0 );
	if ( ! $page_id || ! get_post( $page_id ) ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$page_id = $existing->ID;
		} else {
			$page_id = wp_insert_post(
				array(
					'post_title'  => $title,
					'post_status' => 'publish',
					'post_type'   => 'page',
					'post_name'   => $slug,
				)
			);
		}
	}
	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_post_meta( $page_id, '_wp_page_template', $template );
		update_option( $option_key, $page_id );
	}
	return (int) $page_id;
}

/**
 * Create the primary nav menu and assign it. Skips if one already exists.
 */
function spr_import_nav_menu( $products_id, $about_id ) {
	$menu_name = 'Primary';
	$existing  = wp_get_nav_menu_object( $menu_name );
	if ( ! $existing ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( is_wp_error( $menu_id ) ) {
			return;
		}

		$items = array(
			array( 'label' => __( 'Products', 's-prestige' ), 'url' => $products_id ? get_permalink( $products_id ) : home_url( '/products/' ) ),
			array( 'label' => __( 'About Us', 's-prestige' ), 'url' => $about_id ? get_permalink( $about_id ) : home_url( '/about/' ) ),
			array( 'label' => __( 'Services', 's-prestige' ), 'url' => ( $about_id ? get_permalink( $about_id ) : home_url( '/about/' ) ) . '#services' ),
			array( 'label' => __( 'Contact', 's-prestige' ), 'url' => spr_contact_url() ),
		);
		foreach ( $items as $item ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => $item['label'],
					'menu-item-url'    => $item['url'],
					'menu-item-status' => 'publish',
					'menu-item-type'   => 'custom',
				)
			);
		}
	} else {
		$menu_id = $existing->term_id;
	}

	$locations            = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

// ── Component: text / copy ──────────────────────────────────────────────────────
function spr_import_text() {
	// Apply every default only if the mod is currently empty/unset, so we never
	// clobber a value the user edited in the Customizer (Reset clears them first).
	foreach ( spr_content_defaults() as $key => $value ) {
		$mod = 'spr_' . $key;
		if ( '' === (string) get_theme_mod( $mod, '' ) ) {
			set_theme_mod( $mod, $value );
		}
	}
}
