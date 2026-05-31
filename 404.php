<?php
/**
 * 404 — not found.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="wrap sec" style="text-align:center; min-height:50vh; display:flex; flex-direction:column; align-items:center; justify-content:center;">
	<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:18px;">Error 404</p>
	<h1 style="font-size:clamp(2.4rem,5vw,4rem); font-weight:700; letter-spacing:-0.03em; margin-bottom:18px;">Page not found</h1>
	<p style="font-size:15px; color:var(--text-muted); line-height:1.7; max-width:440px; margin-bottom:32px;"><?php esc_html_e( 'The page you are looking for may have moved. Let’s get you back on course.', 's-prestige' ); ?></p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">Back to home
		<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
	</a>
</main>
<?php
get_footer();
