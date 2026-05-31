<?php
/**
 * Generic page fallback — renders standard page content inside the theme chrome.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="wrap sec">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?>>
			<h1 style="font-size:clamp(2rem,4vw,3.2rem); font-weight:700; letter-spacing:-0.03em; margin-bottom:32px;"><?php the_title(); ?></h1>
			<div class="spr-content" style="font-size:15px; color:rgba(255,255,255,0.82); line-height:1.8;">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
