<?php
/**
 * Template Name: About
 * Description: About + Services + CEO message.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<!-- HEADER -->
<header class="wrap" style="padding-top:clamp(56px,7vw,96px); padding-bottom:clamp(40px,5vw,56px);">
	<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:18px;">About Us</p>
	<h1 style="font-size:clamp(2.4rem,5vw,4.2rem); font-weight:700; letter-spacing:-0.03em; line-height:1.05; margin-bottom:22px; max-width:880px;"><?php spr_text( 'about_title', 'Shaping the future of trade in the Middle East' ); ?></h1>
	<p style="font-size:15px; color:var(--text-muted); line-height:1.75; max-width:620px;"><?php spr_text( 'about_intro', 'Since its establishment in 1992, Adnan International Trade & Export Group has evolved into a distinguished leader in the supply and export of minerals, petrochemicals, steel products, and construction materials. Our journey began in Kuwait and has steadily expanded across the Middle East, earning a solid reputation and strong presence in international markets.' ); ?></p>
</header>

<!-- STATS -->
<section class="wrap" style="padding-bottom:clamp(48px,6vw,80px);">
	<div class="stat-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:clamp(20px,3vw,40px); border-top:1px solid var(--border); padding-top:40px;">
		<?php
		$spr_about_stats = array(
			array( 'about_stat1', '30+', 'about_stat1_label', 'Years of experience' ),
			array( 'about_stat2', '9', 'about_stat2_label', 'Consecutive years as sample exporter' ),
			array( 'about_stat3', '96', 'about_stat3_label', 'Human resources' ),
			array( 'about_stat4', '936', 'about_stat4_label', 'Successful exports (direct & indirect)' ),
		);
		foreach ( $spr_about_stats as $s ) :
			?>
			<div>
				<h2 style="font-size:clamp(34px,4vw,52px); font-weight:700; letter-spacing:-0.02em;"><?php spr_text( $s[0], $s[1] ); ?></h2>
				<p style="font-size:13px; color:var(--text-muted); margin-top:8px;"><?php spr_text( $s[2], $s[3] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- SERVICES -->
<section id="services" class="wrap" style="padding-bottom:clamp(48px,6vw,80px);">
	<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:16px;">What we do</p>
	<h2 style="font-size:clamp(28px,3.4vw,44px); font-weight:700; letter-spacing:-0.03em; margin-bottom:44px;">Our Services</h2>

	<div class="svc-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px;">
		<?php
		$spr_services = array(
			array( 'Premium Commodity Sourcing', 'Sourcing directly from verified producers, factories, and mines — eliminating intermediaries while ensuring international quality standards, traceability, and accountability.' ),
			array( 'Seamless Global Logistics', 'Comprehensive land, sea, and air transport under DDP contracts — route optimization, cargo insurance, real-time tracking, and border coordination with minimal risk.' ),
			array( 'International Market Expertise', 'Over 30 years of experience in Gulf and regional markets — market entry, sales development, and business growth with deep knowledge of local regulations and trends.' ),
			array( 'Customs Clearance &amp; Compliance', 'Quick, accurate, and fully compliant customs clearance at major regional ports — all documentation and coordination with customs authorities handled for you.' ),
			array( 'Flexible Payment Solutions', 'Globally compliant payment solutions tailored for international trade — flexible, secure, and transparent options that support effortless long-term contracts.' ),
		);
		foreach ( $spr_services as $svc ) :
			?>
			<div class="svc-card card-lift">
				<?php spr_star( 22 ); ?>
				<h3 style="margin-top:18px;"><?php echo wp_kses_post( $svc[0] ); ?></h3>
				<p style="font-size:13.5px; color:var(--text-muted); line-height:1.65;"><?php echo esc_html( $svc[1] ); ?></p>
			</div>
		<?php endforeach; ?>

		<div class="svc-card card-lift" style="background:linear-gradient(150deg, #1a2230, #0e0e14); display:flex; flex-direction:column; justify-content:space-between;">
			<h3>Let's build a partnership</h3>
			<p style="font-size:13.5px; color:var(--text-muted); line-height:1.65; margin-bottom:20px;">We build bridges between industries and global markets.</p>
			<a href="<?php echo esc_url( spr_contact_url() ); ?>" class="btn-primary" style="align-self:flex-start;">Contact us
				<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>
	</div>
</section>

<!-- CEO MESSAGE -->
<section class="wrap" style="padding-bottom:clamp(56px,7vw,96px);">
	<div class="ceo-grid" style="display:grid; grid-template-columns:1fr 1.4fr; gap:clamp(28px,4vw,64px); align-items:center; background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:clamp(32px,4vw,56px);">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:14px;">Message from our CEO</p>
			<h2 style="font-size:clamp(24px,2.6vw,34px); font-weight:600; letter-spacing:-0.02em; line-height:1.2;">A personal pledge of excellence</h2>
		</div>
		<div>
			<p style="font-size:16px; color:rgba(255,255,255,0.82); line-height:1.8; font-weight:300;"><?php spr_text( 'ceo_quote', '"At Adnan International Trade & Export Group, our esteemed partners are the core of our success. You have shaped who we are today, and your satisfaction remains our highest priority. We deliver reliable products and tailored solutions that create value for your operations and drive your business forward. This is my personal pledge to you — ensuring excellence, dedication, and unwavering commitment."' ); ?></p>
			<div style="margin-top:24px;">
				<p style="font-size:15px; font-weight:600;"><?php spr_text( 'ceo_name', 'Adnan Mousapour' ); ?></p>
				<p style="font-size:13px; color:var(--text-muted);"><?php spr_text( 'ceo_role', 'Chief Executive Officer' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
