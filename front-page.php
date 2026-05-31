<?php
/**
 * Front page (Home) — pixel-perfect port of the prototype index.html.
 * Every string/image is dynamic via spr_* helpers; structure is unchanged.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$spr_products   = spr_page_url( 'spr_products_page_id', 'products', '/products/' );
$spr_about      = spr_page_url( 'spr_about_page_id', 'about', '/about/' );
$spr_video      = spr_img_url( 'hero_video_id', 'ship.mp4' );
$spr_img_steel  = spr_img_url( 'prod_steel_id', 'prod_steel.jpg' );
$spr_img_min    = spr_img_url( 'prod_minerals_id', 'prod_minerals.jpg' );
$spr_img_petro  = spr_img_url( 'prod_petrochemicals_id', 'prod_petrochemicals.jpg' );
$spr_img_chem   = spr_img_url( 'prod_chemicals_id', 'prod_chemicals.jpg' );
$spr_img_sea    = spr_img_url( 'ship_image_id', 'cta_sea.jpg' );
?>

<!-- ══════════ HERO ══════════ -->
<section style="position:relative; min-height:100vh; overflow:hidden; display:flex; flex-direction:column;">

	<!-- Video background -->
	<div style="position:absolute; inset:0; z-index:0; background:#050508;">
		<video autoplay muted loop playsinline style="width:100%; height:100%; object-fit:cover; opacity:0.85;">
			<source src="<?php echo esc_url( $spr_video ); ?>" type="video/mp4">
		</video>
		<div style="position:absolute; inset:0; background:linear-gradient(to right, rgba(5,5,8,0.72) 0%, rgba(5,5,8,0.45) 30%, rgba(5,5,8,0.10) 55%, rgba(5,5,8,0) 75%);"></div>
		<div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(5,5,8,0.60) 0%, transparent 35%);"></div>
	</div>

	<!-- Nav (transparent, over video) -->
	<nav style="position:relative; z-index:10;">
		<div style="display:flex; align-items:center; justify-content:space-between; padding: 28px clamp(28px,4vw,56px);">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex; align-items:center; gap:10px; text-decoration:none; color:#fff;">
				<?php spr_star( 26 ); ?>
				<span style="font-size:14px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase;"><?php spr_text( 'brand_name', 'S-Prestige' ); ?></span>
			</a>
			<div class="nav-desktop" style="display:flex; align-items:center; gap:36px;">
				<?php spr_nav_links(); ?>
			</div>
			<a href="<?php echo esc_url( spr_contact_url() ); ?>" class="btn-primary">
				<?php spr_text( 'nav_cta_label', 'Get a Quote' ); ?>
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>
	</nav>

	<div style="flex:1;"></div>

	<!-- Hero text -->
	<div style="position:relative; z-index:10; padding: 0 clamp(28px,4vw,56px) clamp(48px,7vh,80px);">
		<div style="max-width:560px;">
			<div style="display:flex; align-items:flex-start; gap:8px; margin-bottom:16px;">
				<svg style="flex-shrink:0; margin-top:3px; opacity:0.5;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
				<p style="font-size:13px; color:rgba(255,255,255,0.6); line-height:1.6; font-weight:300; max-width:400px;">
					<?php spr_text( 'hero_intro', 'For over three decades, S-Prestige International delivers excellence in minerals, petrochemicals, steel, and construction materials across global markets' ); ?>
				</p>
			</div>

			<h1 style="font-size:clamp(2.2rem,4.4vw,4rem); font-weight:700; line-height:1.05; letter-spacing:-0.03em; margin-bottom:32px;">
				<?php spr_html( 'hero_title', 'Global Trade in<br>Minerals, Steel &amp;<br>Petrochemicals' ); ?>
			</h1>

			<div style="display:flex; align-items:center; gap:16px;">
				<a href="<?php echo esc_url( spr_contact_url() ); ?>" style="white-space:nowrap; background:rgba(255,255,255,0.14); backdrop-filter:blur(14px); border:1px solid rgba(255,255,255,0.22); color:#fff; padding:13px 22px; border-radius:10px; font-size:14px; font-weight:500; cursor:pointer; display:inline-flex; align-items:center; gap:9px; text-decoration:none; font-family:'Inter',sans-serif; transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.24)'" onmouseout="this.style.background='rgba(255,255,255,0.14)'">
					<?php spr_text( 'hero_btn1_label', 'Mail Subscription' ); ?>
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
				</a>
				<a href="<?php echo esc_url( $spr_about ); ?>" style="white-space:nowrap; color:#fff; background:none; border:none; font-size:14px; font-weight:500; cursor:pointer; display:inline-flex; align-items:center; gap:11px; text-decoration:none; font-family:'Inter',sans-serif; opacity:0.85; transition:opacity 0.2s;" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='0.85'">
					<span style="width:34px; height:34px; border-radius:50%; border:1px solid rgba(255,255,255,0.35); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
						<svg width="10" height="10" viewBox="0 0 24 24" fill="white"><polygon points="5 3 19 12 5 21 5 3"/></svg>
					</span>
					<?php spr_text( 'hero_btn2_label', 'Learn More' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>


<!-- ══════════ WHY US ══════════ -->
<section class="sec" style="background:var(--bg);">
<div class="wrap">
	<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:48px; padding-bottom:18px; border-bottom:1px solid var(--border);">
		<span style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase;">Why Us</span>
		<span style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase;">Why S-Prestige?</span>
	</div>

	<div class="why-flex" style="display:flex; gap:clamp(40px,5vw,80px); align-items:stretch;">
		<div style="width:34%; min-width:300px;">
			<div class="feature-frame" style="height:100%; min-height:520px;">
				<div class="feature-inner">
					<div>
						<?php spr_star( 22 ); ?>
						<h2 style="font-size:clamp(20px,2.2vw,24px); font-weight:600; line-height:1.3; color:#fff; margin-top:20px;"><?php spr_html( 'why_feature_title', 'Three Decades of<br>Trade Excellence' ); ?></h2>
					</div>
					<div>
						<p style="font-size:10px; letter-spacing:0.2em; text-transform:uppercase; color:#9CA3AF; font-weight:600; margin-bottom:10px;"><?php spr_text( 'why_feature_kicker', 'Adnan International Trade & Export Group' ); ?></p>
						<p style="font-size:12.5px; color:#8b909c; line-height:1.7; font-weight:300; max-width:260px;"><?php spr_text( 'why_feature_body', 'Since 1992, a distinguished leader in the supply and export of minerals, petrochemicals, steel, and construction materials.' ); ?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="adv-grid" style="flex:1; display:grid; grid-template-columns:1fr 1fr; column-gap:clamp(40px,5vw,80px); row-gap:48px; align-content:start;">
			<?php
			$spr_stats = array(
				array( 'why_stat1_value', '30+ Years', 'why_stat1_body', 'Of proven expertise in international trade and export.' ),
				array( 'why_stat2_value', '936 Exports', 'why_stat2_body', 'Successful exports delivered, direct and indirect.' ),
				array( 'why_stat3_value', 'Direct Sourcing', 'why_stat3_body', 'Sourced directly from verified producers, factories, and mines — no intermediaries.' ),
				array( 'why_stat4_value', 'Global Logistics', 'why_stat4_body', 'End-to-end land, sea, and air transport under DDP contracts.' ),
			);
			foreach ( $spr_stats as $s ) :
				?>
				<div class="adv-cell">
					<span style="font-size:11px; color:var(--text-muted); letter-spacing:0.16em; text-transform:uppercase; display:block; margin-bottom:36px; padding-top:16px;">Our Strength</span>
					<h3 style="font-size:clamp(24px,2.4vw,34px); font-weight:500; color:#fff; margin-bottom:14px; line-height:1.1;"><?php spr_text( $s[0], $s[1] ); ?></h3>
					<p style="font-size:14px; color:var(--text-muted); line-height:1.55; max-width:280px;"><?php spr_text( $s[2], $s[3] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div></section>


<!-- ══════════ MARQUEE 1 ══════════ -->
<div style="background:var(--bg); overflow:hidden; padding:24px 0; border-top:1px solid rgba(255,255,255,0.05);">
	<div class="marquee-track">
		<?php for ( $i = 0; $i < 4; $i++ ) : ?>
			<span style="font-size:clamp(40px,5vw,64px); font-weight:700; letter-spacing:-0.03em; color:#7c84a8; padding:0 56px; white-space:nowrap;"<?php echo $i ? ' aria-hidden="true"' : ''; ?>><?php spr_text( 'marquee_text', 'S Prestige International' ); ?></span>
		<?php endfor; ?>
	</div>
</div>


<!-- ══════════ PRODUCT PORTFOLIO ══════════ -->
<section class="sec" style="background:var(--bg);">
<div class="wrap">
	<div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:44px;">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:14px;">Our Portfolio</p>
			<h2 style="font-size:clamp(32px,4vw,52px); font-weight:700; letter-spacing:-0.03em; line-height:1.08;">Our Product<br>Portfolio</h2>
		</div>
		<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.18em; text-transform:uppercase; max-width:280px; text-align:right;">Steel · Minerals · Petrochemicals · Chemicals</p>
	</div>

	<div class="bento prod-grid">
		<!-- Steel — tall -->
		<a href="<?php echo esc_url( $spr_products . '#steel' ); ?>" class="prod-card tall card-lift" style="text-decoration:none;">
			<img src="<?php echo esc_url( $spr_img_steel ); ?>" alt="Steel products" style="width:100%; height:100%; object-fit:cover;">
			<div class="prod-overlay"></div>
			<div class="prod-content">
				<div style="display:flex; align-items:center; gap:8px; font-size:12px; font-weight:500; color:rgba(255,255,255,0.75); letter-spacing:0.05em;"><?php spr_star( 11 ); ?> Steel</div>
				<div>
					<h3 style="font-size:clamp(26px,3vw,34px); font-weight:600; color:#fff; margin-bottom:10px;">Steel</h3>
					<p style="font-size:14px; color:rgba(255,255,255,0.75); line-height:1.6; max-width:360px;">Strength, precision, and durability delivered to global industries — billet, copper cathode, wire rod, ingots, and scrap.</p>
				</div>
			</div>
		</a>

		<!-- Minerals -->
		<a href="<?php echo esc_url( $spr_products . '#minerals' ); ?>" class="prod-card card-lift" style="text-decoration:none;">
			<img src="<?php echo esc_url( $spr_img_min ); ?>" alt="Mineral products" style="width:100%; height:100%; object-fit:cover;">
			<div class="prod-overlay"></div>
			<div class="prod-content">
				<div style="display:flex; align-items:center; gap:8px; font-size:12px; font-weight:500; color:rgba(255,255,255,0.75); letter-spacing:0.05em;"><?php spr_star( 11 ); ?> Minerals</div>
				<h3 style="font-size:clamp(20px,2.2vw,24px); font-weight:600; color:#fff;">Minerals</h3>
			</div>
		</a>

		<!-- Glass accent tile -->
		<a href="<?php echo esc_url( $spr_products ); ?>" class="glass-tile card-lift">
			<div style="display:flex; align-items:center; gap:8px; font-size:12px; font-weight:600; letter-spacing:0.05em;"><?php spr_star( 11, '#20283f' ); ?> 40+ Products</div>
			<div>
				<h3 style="font-size:clamp(18px,2vw,22px); font-weight:600; line-height:1.25; margin-bottom:6px;">Direct from verified producers</h3>
				<span style="font-size:13px; font-weight:600; display:inline-flex; align-items:center; gap:6px;">View all products
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
				</span>
			</div>
			<span class="gt-star"><?php spr_star( 34, '#20283f' ); ?></span>
		</a>

		<!-- Petrochemicals -->
		<a href="<?php echo esc_url( $spr_products . '#petrochemicals' ); ?>" class="prod-card card-lift" style="text-decoration:none;">
			<img src="<?php echo esc_url( $spr_img_petro ); ?>" alt="Petrochemical products" style="width:100%; height:100%; object-fit:cover;">
			<div class="prod-overlay"></div>
			<div class="prod-content">
				<div style="display:flex; align-items:center; gap:8px; font-size:12px; font-weight:500; color:rgba(255,255,255,0.75); letter-spacing:0.05em;"><?php spr_star( 11 ); ?> Petrochemicals</div>
				<h3 style="font-size:clamp(20px,2.2vw,24px); font-weight:600; color:#fff;">Petrochemicals</h3>
			</div>
		</a>

		<!-- Chemicals -->
		<a href="<?php echo esc_url( $spr_products . '#chemicals' ); ?>" class="prod-card card-lift" style="text-decoration:none;">
			<img src="<?php echo esc_url( $spr_img_chem ); ?>" alt="Chemical products" style="width:100%; height:100%; object-fit:cover;">
			<div class="prod-overlay"></div>
			<div class="prod-content">
				<div style="display:flex; align-items:center; gap:8px; font-size:12px; font-weight:500; color:rgba(255,255,255,0.75); letter-spacing:0.05em;"><?php spr_star( 11 ); ?> Chemicals</div>
				<h3 style="font-size:clamp(20px,2.2vw,24px); font-weight:600; color:#fff;">Chemicals</h3>
			</div>
		</a>
	</div>
</div></section>


<!-- ══════════ SHIPPING PROMO ══════════ -->
<section style="background:var(--bg); padding-bottom:clamp(40px,5vw,72px);">
<div class="wrap">
	<div class="ship-promo">
		<img src="<?php echo esc_url( $spr_img_sea ); ?>" alt="" class="ship-promo-bg">
		<div class="ship-play" aria-hidden="true">
			<svg width="13" height="13" viewBox="0 0 24 24" fill="#0F172A"><polygon points="5 3 19 12 5 21 5 3"/></svg>
		</div>
		<div class="ship-promo-inner">
			<p style="font-size:11px; color:#41506b; letter-spacing:0.2em; text-transform:uppercase; font-weight:600; margin-bottom:14px;">Global Logistics &amp; Shipping</p>
			<h2 style="font-size:clamp(26px,3.4vw,42px); font-weight:700; color:#0F172A; line-height:1.12; margin-bottom:16px; letter-spacing:-0.02em;"><?php spr_html( 'ship_title', 'Seamless shipping,<br>delivered worldwide.' ); ?></h2>
			<p style="font-size:14.5px; color:#465468; margin-bottom:30px; line-height:1.65; max-width:420px;"><?php spr_text( 'ship_body', 'We manage the entire logistics chain — land, sea, and air transport under DDP contracts — with route optimization, cargo insurance, and real-time tracking. On time, every time.' ); ?></p>
			<a href="<?php echo esc_url( trailingslashit( $spr_about ) . '#services' ); ?>" class="btn-primary" style="font-size:15px; padding:13px 26px;">
				Explore our service
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>
		<span class="ship-star"><?php spr_star( 34, '#0F172A' ); ?></span>
	</div>
</div></section>


<!-- ══════════ INDUSTRIES ══════════ -->
<section class="sec" style="background:var(--bg);">
<div class="wrap">
	<div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:44px; flex-wrap:wrap; gap:20px;">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:14px;">Industries</p>
			<h2 style="font-size:clamp(28px,3.6vw,46px); font-weight:700; letter-spacing:-0.03em; line-height:1.1; max-width:520px;">Trusted across global industries</h2>
		</div>
		<p style="font-size:14px; color:var(--text-muted); line-height:1.7; max-width:340px;">Our materials power the sectors that build and move the modern world — from construction sites to refineries.</p>
	</div>

	<div class="ind-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:48px;">
		<div class="ind-card card-lift">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:18px; opacity:0.9;"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/><path d="M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/></svg>
			<h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Construction</h3>
			<p style="font-size:13px; color:var(--text-muted); line-height:1.6;">Cement, clinker, steel, and aggregates for infrastructure worldwide.</p>
		</div>
		<div class="ind-card card-lift">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:18px; opacity:0.9;"><path d="M12 2v6m0 0l3-3m-3 3L9 5M4 12h16M6 12v8a1 1 0 001 1h10a1 1 0 001-1v-8"/></svg>
			<h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Oil &amp; Gas</h3>
			<p style="font-size:13px; color:var(--text-muted); line-height:1.6;">Barite, bentonite, and gilsonite for drilling fluids and pipelines.</p>
		</div>
		<div class="ind-card card-lift">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:18px; opacity:0.9;"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
			<h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Manufacturing</h3>
			<p style="font-size:13px; color:var(--text-muted); line-height:1.6;">Silica, feldspar, and copper for glass, ceramics, and electronics.</p>
		</div>
		<div class="ind-card card-lift">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:18px; opacity:0.9;"><path d="M12 2a9 9 0 00-9 9c0 5 9 11 9 11s9-6 9-11a9 9 0 00-9-9z"/><path d="M12 7v8M8 11h8"/></svg>
			<h3 style="font-size:16px; font-weight:600; margin-bottom:8px;">Agriculture</h3>
			<p style="font-size:13px; color:var(--text-muted); line-height:1.6;">Urea, humic acid, and dolomite for fertilizers and soil conditioning.</p>
		</div>
	</div>

	<div class="promo-banner" style="display:grid; grid-template-columns:1.2fr 1fr; gap:0; border-radius:20px; overflow:hidden; border:1px solid var(--border);">
		<div style="padding:clamp(32px,4vw,52px); display:flex; flex-direction:column; justify-content:center;">
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:16px;">Why choose S-Prestige</p>
			<h3 style="font-size:clamp(22px,2.6vw,32px); font-weight:600; letter-spacing:-0.02em; line-height:1.2; margin-bottom:24px;">Direct sourcing, certified quality, delivered worldwide.</h3>
			<div style="display:flex; flex-direction:column; gap:16px;">
				<?php
				$spr_promo_points = array(
					'Sourced directly from verified producers and mines — no intermediaries.',
					'Products that meet international quality benchmarks at competitive cost.',
					'End-to-end logistics and customs handled under DDP contracts.',
				);
				foreach ( $spr_promo_points as $pt ) :
					?>
					<div style="display:flex; gap:12px; align-items:flex-start;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
						<p style="font-size:14px; color:rgba(255,255,255,0.8); line-height:1.5;"><?php echo esc_html( $pt ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<a href="<?php echo esc_url( $spr_products ); ?>" class="btn-primary" style="align-self:flex-start; margin-top:30px;">Explore Products
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>
		<div class="promo-img" style="position:relative; min-height:300px;">
			<img src="<?php echo esc_url( $spr_img_petro ); ?>" alt="" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
			<div style="position:absolute; inset:0; background:linear-gradient(to right, var(--bg) 0%, rgba(6,6,8,0.2) 40%, transparent 100%);"></div>
		</div>
	</div>
</div></section>


<!-- ══════════ FAQ ══════════ -->
<section class="sec" style="background:var(--bg);">
<div class="wrap">
	<div class="faq-grid" style="display:grid; grid-template-columns:34% 66%; gap:64px;">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:18px;">FAQ</p>
			<h2 style="font-size:clamp(22px,2.8vw,34px); font-weight:700; letter-spacing:-0.02em; line-height:1.25; margin-bottom:40px;">Frequently Asked<br>Questions</h2>
			<a href="<?php echo esc_url( spr_contact_url() ); ?>" style="display:inline-flex; align-items:center; gap:10px; color:#fff; font-size:14px; font-weight:500; text-decoration:none; opacity:0.8;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
				<span style="width:30px; height:30px; border-radius:8px; background:rgba(255,255,255,0.07); border:1px solid var(--border); display:flex; align-items:center; justify-content:center;"><?php spr_star( 13 ); ?></span>
				Contact our team
			</a>
		</div>

		<div>
			<?php
			$spr_faqs = array(
				array( 'What products does S-Prestige supply?', 'We supply and export four main categories: Steel (billet, copper), Minerals (barite, bentonite, silica, dolomite, gilsonite, feldspar, calcium carbonate), Petrochemicals (urea, bitumen, PE, PP, PVC), and Chemicals (caustic soda, calcium chloride, micro silica, magnesium hydroxide, LABSA, microcement).' ),
				array( 'What regions do you export to?', 'Our journey began in Kuwait and has expanded across the Middle East and into international markets worldwide. We manage land, sea, and air transport under DDP contracts to deliver to most global destinations.' ),
				array( 'How do I request a quote or sample?', 'Reach us by phone at ' . spr_raw( 'contact_phone', '(+971) 56 922 2006' ) . ' or email ' . spr_raw( 'contact_email', 's.prestige.international@gmail.com' ) . ' with the product, grade, quantity, and destination. Our team responds within one business day.' ),
				array( 'What packaging options are available?', 'Depending on the product: 25–50 kg bags, 1 MT jumbo bags, steel drums, IBC totes / liquid tankers, and bulk vessel shipments. Custom packaging is available upon request.' ),
				array( 'Do you handle customs clearance?', 'Yes. Our offices and representatives at key regional ports manage all documentation, regulatory compliance, and coordination with customs authorities for smooth, on-time clearance.' ),
			);
			foreach ( $spr_faqs as $faq ) :
				?>
				<div class="faq-item" style="border-bottom:1px solid var(--border);">
					<div style="display:flex; justify-content:space-between; align-items:center; padding:20px 0; cursor:pointer;">
						<span style="font-size:15px; font-weight:500; color:#fff;"><?php echo esc_html( $faq[0] ); ?></span>
						<svg class="faq-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
					</div>
					<div class="faq-answer"><p style="font-size:14px; color:var(--text-muted); line-height:1.65; padding-bottom:20px;"><?php echo esc_html( $faq[1] ); ?></p></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div></section>


<!-- ══════════ CONTACT ══════════ -->
<section id="contact" class="sec" style="background:var(--bg);">
<div class="wrap">
	<div class="contact-grid">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:16px;">Contact</p>
			<h2 style="font-size:clamp(28px,3.6vw,46px); font-weight:700; letter-spacing:-0.03em; line-height:1.1; margin-bottom:18px;"><?php spr_html( 'contact_heading', "Let's talk about<br>your next shipment." ); ?></h2>
			<p style="font-size:15px; color:var(--text-muted); line-height:1.7; margin-bottom:36px; max-width:420px;">Tell us the product, grade, quantity, and destination — our team responds within one business day.</p>

			<div style="display:flex; flex-direction:column; gap:22px;">
				<div style="display:flex; align-items:flex-start; gap:14px;">
					<span style="width:38px; height:38px; flex-shrink:0; border-radius:10px; background:rgba(255,255,255,0.05); border:1px solid var(--border); display:flex; align-items:center; justify-content:center;">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent-2)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
					</span>
					<div>
						<p style="font-size:11px; color:var(--text-muted); margin-bottom:3px;">Phone</p>
						<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', spr_raw( 'contact_phone', '(+971) 56 922 2006' ) ) ); ?>" style="font-size:14px; color:rgba(255,255,255,0.85); text-decoration:none;"><?php spr_text( 'contact_phone', '(+971) 56 922 2006' ); ?></a>
					</div>
				</div>
				<div style="display:flex; align-items:flex-start; gap:14px;">
					<span style="width:38px; height:38px; flex-shrink:0; border-radius:10px; background:rgba(255,255,255,0.05); border:1px solid var(--border); display:flex; align-items:center; justify-content:center;">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent-2)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg>
					</span>
					<div>
						<p style="font-size:11px; color:var(--text-muted); margin-bottom:3px;">Email</p>
						<a href="<?php echo esc_url( 'mailto:' . spr_raw( 'contact_email', 's.prestige.international@gmail.com' ) ); ?>" style="font-size:14px; color:rgba(255,255,255,0.85); text-decoration:none; word-break:break-all;"><?php spr_text( 'contact_email', 's.prestige.international@gmail.com' ); ?></a>
					</div>
				</div>
				<div style="display:flex; align-items:flex-start; gap:14px;">
					<span style="width:38px; height:38px; flex-shrink:0; border-radius:10px; background:rgba(255,255,255,0.05); border:1px solid var(--border); display:flex; align-items:center; justify-content:center;">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent-2)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
					</span>
					<div>
						<p style="font-size:11px; color:var(--text-muted); margin-bottom:3px;">Office</p>
						<p style="font-size:14px; color:rgba(255,255,255,0.85); line-height:1.5;"><?php spr_html( 'contact_address', 'Meydan Grandstand, 6th Floor,<br>Nad Al Sheba, Dubai, UAE' ); ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- Form panel — Contact Form 7 (or styled fallback) -->
		<div style="background:var(--surface); border:1px solid var(--border); border-radius:18px; padding:clamp(24px,3vw,38px);">
			<?php spr_contact_form(); ?>
		</div>
	</div>
</div></section>

<?php
get_footer();
