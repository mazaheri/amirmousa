<?php
/**
 * Template Name: Products
 * Description: Products page — 4 category sections (Steel / Minerals / Petrochemicals / Chemicals).
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * Render a comma-separated chip list.
 *
 * @param string $raw Comma-separated values.
 * @return void
 */
function spr_render_chips( $raw ) {
	$items = array_filter( array_map( 'trim', explode( ',', (string) $raw ) ) );
	foreach ( $items as $item ) {
		echo '<span class="chip">' . esc_html( $item ) . '</span>';
	}
}

$spr_img_steel = spr_img_url( 'prod_steel_id', 'prod_steel.jpg' );
$spr_img_min   = spr_img_url( 'prod_minerals_id', 'prod_minerals.jpg' );
$spr_img_petro = spr_img_url( 'prod_petrochemicals_id', 'prod_petrochemicals.jpg' );
$spr_img_chem  = spr_img_url( 'prod_chemicals_id', 'prod_chemicals.jpg' );
?>

<!-- PAGE HEADER -->
<header class="wrap" style="padding-top:clamp(56px,7vw,96px); padding-bottom:clamp(40px,5vw,64px);">
	<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.22em; text-transform:uppercase; margin-bottom:18px;">Our Portfolio</p>
	<h1 style="font-size:clamp(2.4rem,5vw,4.2rem); font-weight:700; letter-spacing:-0.03em; line-height:1.05; margin-bottom:20px; max-width:780px;">Products built for the world's industries</h1>
	<p style="font-size:15px; color:var(--text-muted); line-height:1.7; max-width:560px;">With expertise across Steel, Petrochemicals, Chemicals, and Minerals, we provide authentic products, tailored logistics, and unmatched reliability for industries worldwide.</p>
	<div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:28px;">
		<a href="#steel" class="chip" style="text-decoration:none;">Steel</a>
		<a href="#minerals" class="chip" style="text-decoration:none;">Minerals</a>
		<a href="#petrochemicals" class="chip" style="text-decoration:none;">Petrochemicals</a>
		<a href="#chemicals" class="chip" style="text-decoration:none;">Chemicals</a>
	</div>
</header>

<main class="wrap" style="display:flex; flex-direction:column; gap:clamp(48px,7vw,96px); padding-bottom:clamp(56px,7vw,96px);">

	<!-- STEEL -->
	<section id="steel" class="prod-row" style="display:grid; grid-template-columns:1fr 1fr; gap:clamp(28px,4vw,56px); align-items:center;">
		<div class="prod-img card-lift" style="border-radius:18px; overflow:hidden; aspect-ratio:4/3;">
			<img src="<?php echo esc_url( $spr_img_steel ); ?>" alt="Steel" style="width:100%; height:100%; object-fit:cover;">
		</div>
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:14px;">Steel</p>
			<h2 style="font-size:clamp(28px,3.4vw,40px); font-weight:600; letter-spacing:-0.02em; margin-bottom:16px;">Steel</h2>
			<p style="font-size:15px; color:var(--text-muted); line-height:1.7; margin-bottom:24px;"><?php spr_text( 'prod_steel_desc', 'Strength, precision, and durability delivered to global industries. We supply semi-finished and refined steel products essential for downstream mills and manufacturing.' ); ?></p>
			<div style="display:flex; gap:10px; flex-wrap:wrap;"><?php spr_render_chips( spr_raw( 'prod_steel_chips', 'Billet, Copper Cathode, Copper Wire Rod, Copper Ingots, Copper Scrap' ) ); ?></div>
		</div>
	</section>

	<!-- MINERALS -->
	<section id="minerals" class="prod-row rev" style="display:grid; grid-template-columns:1fr 1fr; gap:clamp(28px,4vw,56px); align-items:center;">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:14px;">Minerals</p>
			<h2 style="font-size:clamp(28px,3.4vw,40px); font-weight:600; letter-spacing:-0.02em; margin-bottom:16px;">Minerals</h2>
			<p style="font-size:15px; color:var(--text-muted); line-height:1.7; margin-bottom:24px;"><?php spr_text( 'prod_minerals_desc', "From the earth's richness to the world's industries. With exclusive mining agreements, we export high-quality minerals meeting international benchmarks at competitive cost." ); ?></p>
			<div style="display:flex; gap:10px; flex-wrap:wrap;"><?php spr_render_chips( spr_raw( 'prod_minerals_chips', 'Barite, Bentonite, Clay, Dolomite, Silica, Feldspar, Calcium Carbonate, Gilsonite' ) ); ?></div>
		</div>
		<div class="prod-img card-lift" style="border-radius:18px; overflow:hidden; aspect-ratio:4/3;">
			<img src="<?php echo esc_url( $spr_img_min ); ?>" alt="Minerals" style="width:100%; height:100%; object-fit:cover;">
		</div>
	</section>

	<!-- PETROCHEMICALS -->
	<section id="petrochemicals" class="prod-row" style="display:grid; grid-template-columns:1fr 1fr; gap:clamp(28px,4vw,56px); align-items:center;">
		<div class="prod-img card-lift" style="border-radius:18px; overflow:hidden; aspect-ratio:4/3;">
			<img src="<?php echo esc_url( $spr_img_petro ); ?>" alt="Petrochemicals" style="width:100%; height:100%; object-fit:cover;">
		</div>
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:14px;">Petrochemicals</p>
			<h2 style="font-size:clamp(28px,3.4vw,40px); font-weight:600; letter-spacing:-0.02em; margin-bottom:16px;">Petrochemicals</h2>
			<p style="font-size:15px; color:var(--text-muted); line-height:1.7; margin-bottom:24px;"><?php spr_text( 'prod_petrochemicals_desc', 'Fueling global industries with innovation and reliability. Vital across construction, automotive, agriculture, textiles, and packaging — backed by robust supply chains.' ); ?></p>
			<div style="display:flex; gap:10px; flex-wrap:wrap;"><?php spr_render_chips( spr_raw( 'prod_petrochemicals_chips', 'Urea, Bitumen, Methanol, Polyethylene (PE), Polypropylene (PP), PVC' ) ); ?></div>
		</div>
	</section>

	<!-- CHEMICALS -->
	<section id="chemicals" class="prod-row rev" style="display:grid; grid-template-columns:1fr 1fr; gap:clamp(28px,4vw,56px); align-items:center;">
		<div>
			<p style="font-size:11px; color:var(--text-muted); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:14px;">Chemicals</p>
			<h2 style="font-size:clamp(28px,3.4vw,40px); font-weight:600; letter-spacing:-0.02em; margin-bottom:16px;">Chemicals</h2>
			<p style="font-size:15px; color:var(--text-muted); line-height:1.7; margin-bottom:24px;"><?php spr_text( 'prod_chemicals_desc', 'Essential compounds powering progress and innovation. We focus on purity, sustainability, and packaging excellence for partners in manufacturing, mining, water treatment, and agriculture.' ); ?></p>
			<div style="display:flex; gap:10px; flex-wrap:wrap;"><?php spr_render_chips( spr_raw( 'prod_chemicals_chips', 'Caustic Soda, Calcium Chloride, Clinker, Micro Silica, Magnesium Hydroxide, Sulfonic Acid (LABSA), Humic Acid, Microcement' ) ); ?></div>
		</div>
		<div class="prod-img card-lift" style="border-radius:18px; overflow:hidden; aspect-ratio:4/3;">
			<img src="<?php echo esc_url( $spr_img_chem ); ?>" alt="Chemicals" style="width:100%; height:100%; object-fit:cover;">
		</div>
	</section>

</main>

<!-- CTA -->
<section class="wrap" style="padding-bottom:clamp(56px,7vw,96px);">
	<div style="background:#DDE3EE; border-radius:20px; padding:clamp(36px,5vw,56px); text-align:center;">
		<h2 style="font-size:clamp(24px,3vw,38px); font-weight:700; color:#0F172A; letter-spacing:-0.02em; margin-bottom:12px;">Need a specific grade or volume?</h2>
		<p style="font-size:14px; color:#64748B; margin-bottom:26px;">Tell us the product, grade, quantity, and destination — we'll respond within one business day.</p>
		<a href="<?php echo esc_url( spr_contact_url() ); ?>" class="btn-primary" style="background:#0F172A; color:#fff;">Request a Quote
			<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
		</a>
	</div>
</section>

<?php
get_footer();
