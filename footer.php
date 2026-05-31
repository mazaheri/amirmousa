<?php
/**
 * Footer — marquee + full footer grid, all dynamic.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$spr_products = spr_page_url( 'spr_products_page_id', 'products', '/products/' );
$spr_about    = spr_page_url( 'spr_about_page_id', 'about', '/about/' );
$spr_email    = spr_raw( 'contact_email', 's.prestige.international@gmail.com' );
$spr_phone    = spr_raw( 'contact_phone', '(+971) 56 922 2006' );
$spr_marquee  = spr_raw( 'marquee_text', 'S Prestige International' );

$spr_social = array(
	'twitter'  => spr_raw( 'social_twitter', '' ),
	'telegram' => spr_raw( 'social_telegram', '' ),
	'linkedin' => spr_raw( 'social_linkedin', '' ),
	'medium'   => spr_raw( 'social_medium', '' ),
);
?>

<!-- MARQUEE -->
<div style="background:var(--bg); overflow:hidden; padding:24px 0; border-top:1px solid rgba(255,255,255,0.05);">
	<div class="marquee-track">
		<?php for ( $i = 0; $i < 4; $i++ ) : ?>
			<span style="font-size:clamp(40px,5vw,64px); font-weight:700; letter-spacing:-0.03em; color:#7c84a8; padding:0 56px; white-space:nowrap;"<?php echo $i ? ' aria-hidden="true"' : ''; ?>><?php echo esc_html( $spr_marquee ); ?></span>
		<?php endfor; ?>
	</div>
</div>

<!-- FOOTER -->
<footer style="background:var(--bg); padding-top:clamp(32px,4vw,48px);">
<div class="wrap">
	<div class="footer-grid" style="border:1px solid var(--border); border-radius:20px; padding:clamp(32px,4vw,52px) clamp(24px,4vw,52px) 40px; display:grid; grid-template-columns:1.6fr 1fr 1fr 1fr; gap:clamp(28px,3vw,44px); align-items:start;">

		<!-- CTA col -->
		<div>
			<h3 style="font-size:clamp(22px,2.4vw,34px); font-weight:700; line-height:1.2; letter-spacing:-0.02em; margin-bottom:14px;">We would love to<br>hear from you.</h3>
			<p style="font-size:13px; color:var(--text-muted); line-height:1.65; margin-bottom:28px; max-width:260px;">Reach out to discuss your sourcing needs, request a quote, or collaborate with us.</p>
			<a href="<?php echo esc_url( 'mailto:' . $spr_email ); ?>" class="btn-primary" style="text-decoration:none;">
				Get in Touch
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>

		<!-- Contact info -->
		<div>
			<p style="font-size:12px; font-weight:600; color:#fff; letter-spacing:0.06em; margin-bottom:20px;">Contact us</p>
			<div style="display:flex; flex-direction:column; gap:14px;">
				<div>
					<p style="font-size:11px; color:var(--text-muted); margin-bottom:4px;">Our Email</p>
					<a href="<?php echo esc_url( 'mailto:' . $spr_email ); ?>" style="font-size:13px; color:rgba(255,255,255,0.75); text-decoration:none; word-break:break-all;"><?php echo esc_html( $spr_email ); ?></a>
				</div>
				<div>
					<p style="font-size:11px; color:var(--text-muted); margin-bottom:4px;">Our Phone</p>
					<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $spr_phone ) ); ?>" style="font-size:13px; color:rgba(255,255,255,0.75); text-decoration:none;"><?php echo esc_html( $spr_phone ); ?></a>
				</div>
				<div>
					<p style="font-size:11px; color:var(--text-muted); margin-bottom:4px;">Address</p>
					<p style="font-size:13px; color:rgba(255,255,255,0.75); line-height:1.55;"><?php spr_html( 'contact_address', 'Meydan Grandstand, 6th Floor,<br>Nad Al Sheba, Dubai, UAE' ); ?></p>
				</div>
			</div>
		</div>

		<!-- Site links -->
		<div>
			<p style="font-size:12px; font-weight:600; color:#fff; letter-spacing:0.06em; margin-bottom:20px;">Explore</p>
			<div style="display:flex; flex-direction:column; gap:14px;">
				<a href="<?php echo esc_url( $spr_products ); ?>" class="nav-link">Products</a>
				<a href="<?php echo esc_url( $spr_about ); ?>" class="nav-link">About Us</a>
				<a href="<?php echo esc_url( trailingslashit( $spr_about ) . '#services' ); ?>" class="nav-link">Services</a>
				<a href="<?php echo esc_url( spr_contact_url() ); ?>" class="nav-link">Contact</a>
			</div>
		</div>

		<!-- Social links -->
		<div>
			<p style="font-size:12px; font-weight:600; color:#fff; letter-spacing:0.06em; margin-bottom:20px;">Follow us</p>
			<div style="display:flex; flex-direction:column; gap:14px;">
				<?php
				$spr_social_labels = array(
					'twitter'  => 'Twitter',
					'telegram' => 'Telegram',
					'linkedin' => 'LinkedIn',
					'medium'   => 'Medium',
				);
				foreach ( $spr_social_labels as $key => $label ) :
					$url = $spr_social[ $key ] ? $spr_social[ $key ] : '#';
					?>
					<a href="<?php echo esc_url( $url ); ?>"<?php echo ( '#' !== $url ) ? ' target="_blank" rel="noopener"' : ''; ?> style="font-size:13px; color:rgba(255,255,255,0.6); text-decoration:none; display:flex; align-items:center; gap:7px; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.6)'"><?php echo esc_html( $label ); ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<!-- Bottom bar -->
	<div style="display:flex; justify-content:space-between; align-items:center; padding:18px 4px 24px; margin-top:4px; flex-wrap:wrap; gap:14px;">
		<div style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--text-muted); flex-wrap:wrap;">
			<span><?php spr_text( 'footer_copyright', '© S-Prestige International 2024' ); ?></span>
			<span style="color:rgba(255,255,255,0.12);">|</span>
			<a href="#" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--text-muted)'">Information Security Policy</a>
			<span style="color:rgba(255,255,255,0.12);">|</span>
			<a href="#" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--text-muted)'">Cookie Policy</a>
			<span style="color:rgba(255,255,255,0.12);">|</span>
			<a href="#" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--text-muted)'">Terms &amp; Conditions</a>
		</div>
		<a href="#" data-scroll-top style="font-size:12px; color:var(--text-muted); text-decoration:none; display:flex; align-items:center; gap:6px; letter-spacing:0.06em;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--text-muted)'">
			BACK TO THE TOP
			<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
		</a>
	</div>
</div></footer>

<?php wp_footer(); ?>
</body>
</html>
