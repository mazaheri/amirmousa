<?php
/**
 * Main index fallback (blog / archives / search).
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="wrap sec">
	<?php if ( have_posts() ) : ?>
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1 style="font-size:clamp(2rem,4vw,3.2rem); font-weight:700; letter-spacing:-0.03em; margin-bottom:40px;"><?php single_post_title(); ?></h1>
		<?php endif; ?>

		<div style="display:flex; flex-direction:column; gap:40px;">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?> style="border-bottom:1px solid var(--border); padding-bottom:32px;">
					<h2 style="font-size:clamp(1.4rem,2.4vw,2rem); font-weight:600; margin-bottom:12px;">
						<a href="<?php the_permalink(); ?>" style="color:#fff; text-decoration:none;"><?php the_title(); ?></a>
					</h2>
					<p style="font-size:12px; color:var(--text-muted); margin-bottom:16px;"><?php echo esc_html( get_the_date() ); ?></p>
					<div style="font-size:15px; color:rgba(255,255,255,0.8); line-height:1.7;"><?php the_excerpt(); ?></div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<div style="margin-top:40px;">
			<?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
		</div>
	<?php else : ?>
		<p style="font-size:15px; color:var(--text-muted);"><?php esc_html_e( 'Nothing found.', 's-prestige' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
