<?php
/**
 * Header — opens the document and (for inner pages) renders the sticky nav.
 *
 * The HOME hero has its own transparent nav drawn over the video, so on the
 * front page we skip the sticky bar here and let front-page.php draw it.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
wp_body_open();

if ( ! is_front_page() ) :
	?>
	<!-- Sticky inner-page nav -->
	<nav style="position:sticky; top:0; z-index:50; background:rgba(6,6,8,0.85); backdrop-filter:blur(12px); border-bottom:1px solid var(--border);">
		<div class="wrap" style="display:flex; align-items:center; justify-content:space-between; padding:20px 0;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex; align-items:center; gap:10px; text-decoration:none; color:#fff;">
				<?php spr_star( 24 ); ?>
				<span style="font-size:14px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase;"><?php spr_text( 'brand_name', 'S-Prestige' ); ?></span>
			</a>
			<div class="nav-desktop" style="display:flex; align-items:center; gap:36px;">
				<?php spr_nav_links(); ?>
			</div>
			<a href="<?php echo esc_url( spr_contact_url() ); ?>" class="btn-primary"><?php spr_text( 'nav_cta_label', 'Get a Quote' ); ?>
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>
	</nav>
	<?php
endif;
