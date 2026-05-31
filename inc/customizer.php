<?php
/**
 * Customizer — every editable string and image for the site.
 *
 * Organised under one panel ("S-Prestige Content") with a section per page area.
 * Text settings sanitize with sanitize_text_field; multi-line/HTML use wp_kses_post;
 * images use the media control and store the attachment ID (matched by the importer).
 *
 * Defaults here MUST equal the prototype text so the live site is identical until edited.
 *
 * @package S_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The full field map. Keyed by setting key (without spr_ prefix).
 * type: 'text' | 'textarea' | 'html' | 'url' | 'image' | 'email'
 *
 * Kept in one array so the Customizer AND the importer's "Site Text" component
 * read from a single source of truth (see spr_content_defaults()).
 *
 * @return array
 */
function spr_field_map() {
	return array(

		// ── Brand / Nav ───────────────────────────────────────────────
		'brand'   => array(
			'title'  => __( 'Brand & Navigation', 's-prestige' ),
			'fields' => array(
				'brand_name'   => array( 'type' => 'text', 'label' => 'Brand name', 'default' => 'S-Prestige' ),
				'nav_cta_label' => array( 'type' => 'text', 'label' => 'Nav button label', 'default' => 'Get a Quote' ),
			),
		),

		// ── Hero ──────────────────────────────────────────────────────
		'hero'    => array(
			'title'  => __( 'Home — Hero', 's-prestige' ),
			'fields' => array(
				'hero_intro'      => array( 'type' => 'textarea', 'label' => 'Intro paragraph', 'default' => 'For over three decades, S-Prestige International delivers excellence in minerals, petrochemicals, steel, and construction materials across global markets' ),
				'hero_title'      => array( 'type' => 'html', 'label' => 'Headline (HTML, <br> allowed)', 'default' => 'Global Trade in<br>Minerals, Steel &amp;<br>Petrochemicals' ),
				'hero_btn1_label' => array( 'type' => 'text', 'label' => 'Primary button label', 'default' => 'Mail Subscription' ),
				'hero_btn2_label' => array( 'type' => 'text', 'label' => 'Secondary button label', 'default' => 'Learn More' ),
				'hero_video_id'   => array( 'type' => 'image', 'label' => 'Hero background video/poster', 'default' => 0 ),
			),
		),

		// ── Why Us ────────────────────────────────────────────────────
		'why'     => array(
			'title'  => __( 'Home — Why Us', 's-prestige' ),
			'fields' => array(
				'why_feature_title' => array( 'type' => 'html', 'label' => 'Feature card title', 'default' => 'Three Decades of<br>Trade Excellence' ),
				'why_feature_kicker' => array( 'type' => 'text', 'label' => 'Feature card kicker', 'default' => 'Adnan International Trade & Export Group' ),
				'why_feature_body'  => array( 'type' => 'textarea', 'label' => 'Feature card body', 'default' => 'Since 1992, a distinguished leader in the supply and export of minerals, petrochemicals, steel, and construction materials.' ),
				'why_stat1_value'   => array( 'type' => 'text', 'label' => 'Stat 1 value', 'default' => '30+ Years' ),
				'why_stat1_body'    => array( 'type' => 'text', 'label' => 'Stat 1 body', 'default' => 'Of proven expertise in international trade and export.' ),
				'why_stat2_value'   => array( 'type' => 'text', 'label' => 'Stat 2 value', 'default' => '936 Exports' ),
				'why_stat2_body'    => array( 'type' => 'text', 'label' => 'Stat 2 body', 'default' => 'Successful exports delivered, direct and indirect.' ),
				'why_stat3_value'   => array( 'type' => 'text', 'label' => 'Stat 3 value', 'default' => 'Direct Sourcing' ),
				'why_stat3_body'    => array( 'type' => 'text', 'label' => 'Stat 3 body', 'default' => 'Sourced directly from verified producers, factories, and mines — no intermediaries.' ),
				'why_stat4_value'   => array( 'type' => 'text', 'label' => 'Stat 4 value', 'default' => 'Global Logistics' ),
				'why_stat4_body'    => array( 'type' => 'text', 'label' => 'Stat 4 body', 'default' => 'End-to-end land, sea, and air transport under DDP contracts.' ),
			),
		),

		// ── Products (home + products page share these category images & copy) ─
		'products' => array(
			'title'  => __( 'Products — Categories', 's-prestige' ),
			'fields' => array(
				'prod_steel_id'           => array( 'type' => 'image', 'label' => 'Steel image', 'default' => 0 ),
				'prod_minerals_id'        => array( 'type' => 'image', 'label' => 'Minerals image', 'default' => 0 ),
				'prod_petrochemicals_id'  => array( 'type' => 'image', 'label' => 'Petrochemicals image', 'default' => 0 ),
				'prod_chemicals_id'       => array( 'type' => 'image', 'label' => 'Chemicals image', 'default' => 0 ),
				'prod_steel_desc'         => array( 'type' => 'textarea', 'label' => 'Steel description', 'default' => 'Strength, precision, and durability delivered to global industries. We supply semi-finished and refined steel products essential for downstream mills and manufacturing.' ),
				'prod_steel_chips'        => array( 'type' => 'text', 'label' => 'Steel chips (comma-separated)', 'default' => 'Billet, Copper Cathode, Copper Wire Rod, Copper Ingots, Copper Scrap' ),
				'prod_minerals_desc'      => array( 'type' => 'textarea', 'label' => 'Minerals description', 'default' => "From the earth's richness to the world's industries. With exclusive mining agreements, we export high-quality minerals meeting international benchmarks at competitive cost." ),
				'prod_minerals_chips'     => array( 'type' => 'text', 'label' => 'Minerals chips', 'default' => 'Barite, Bentonite, Clay, Dolomite, Silica, Feldspar, Calcium Carbonate, Gilsonite' ),
				'prod_petrochemicals_desc' => array( 'type' => 'textarea', 'label' => 'Petrochemicals description', 'default' => 'Fueling global industries with innovation and reliability. Vital across construction, automotive, agriculture, textiles, and packaging — backed by robust supply chains.' ),
				'prod_petrochemicals_chips' => array( 'type' => 'text', 'label' => 'Petrochemicals chips', 'default' => 'Urea, Bitumen, Methanol, Polyethylene (PE), Polypropylene (PP), PVC' ),
				'prod_chemicals_desc'     => array( 'type' => 'textarea', 'label' => 'Chemicals description', 'default' => 'Essential compounds powering progress and innovation. We focus on purity, sustainability, and packaging excellence for partners in manufacturing, mining, water treatment, and agriculture.' ),
				'prod_chemicals_chips'    => array( 'type' => 'text', 'label' => 'Chemicals chips', 'default' => 'Caustic Soda, Calcium Chloride, Clinker, Micro Silica, Magnesium Hydroxide, Sulfonic Acid (LABSA), Humic Acid, Microcement' ),
			),
		),

		// ── Shipping promo (home) ─────────────────────────────────────
		'shipping' => array(
			'title'  => __( 'Home — Shipping Promo', 's-prestige' ),
			'fields' => array(
				'ship_image_id' => array( 'type' => 'image', 'label' => 'Shipping background image', 'default' => 0 ),
				'ship_title'    => array( 'type' => 'html', 'label' => 'Title', 'default' => 'Seamless shipping,<br>delivered worldwide.' ),
				'ship_body'     => array( 'type' => 'textarea', 'label' => 'Body', 'default' => 'We manage the entire logistics chain — land, sea, and air transport under DDP contracts — with route optimization, cargo insurance, and real-time tracking. On time, every time.' ),
			),
		),

		// ── About page ────────────────────────────────────────────────
		'about'   => array(
			'title'  => __( 'About Page', 's-prestige' ),
			'fields' => array(
				'about_title' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Shaping the future of trade in the Middle East' ),
				'about_intro' => array( 'type' => 'textarea', 'label' => 'Intro', 'default' => 'Since its establishment in 1992, Adnan International Trade & Export Group has evolved into a distinguished leader in the supply and export of minerals, petrochemicals, steel products, and construction materials. Our journey began in Kuwait and has steadily expanded across the Middle East, earning a solid reputation and strong presence in international markets.' ),
				'about_stat1' => array( 'type' => 'text', 'label' => 'Stat 1 number', 'default' => '30+' ),
				'about_stat1_label' => array( 'type' => 'text', 'label' => 'Stat 1 label', 'default' => 'Years of experience' ),
				'about_stat2' => array( 'type' => 'text', 'label' => 'Stat 2 number', 'default' => '9' ),
				'about_stat2_label' => array( 'type' => 'text', 'label' => 'Stat 2 label', 'default' => 'Consecutive years as sample exporter' ),
				'about_stat3' => array( 'type' => 'text', 'label' => 'Stat 3 number', 'default' => '96' ),
				'about_stat3_label' => array( 'type' => 'text', 'label' => 'Stat 3 label', 'default' => 'Human resources' ),
				'about_stat4' => array( 'type' => 'text', 'label' => 'Stat 4 number', 'default' => '936' ),
				'about_stat4_label' => array( 'type' => 'text', 'label' => 'Stat 4 label', 'default' => 'Successful exports (direct & indirect)' ),
				'ceo_quote'   => array( 'type' => 'textarea', 'label' => 'CEO quote', 'default' => '"At Adnan International Trade & Export Group, our esteemed partners are the core of our success. You have shaped who we are today, and your satisfaction remains our highest priority. We deliver reliable products and tailored solutions that create value for your operations and drive your business forward. This is my personal pledge to you — ensuring excellence, dedication, and unwavering commitment."' ),
				'ceo_name'    => array( 'type' => 'text', 'label' => 'CEO name', 'default' => 'Adnan Mousapour' ),
				'ceo_role'    => array( 'type' => 'text', 'label' => 'CEO role', 'default' => 'Chief Executive Officer' ),
			),
		),

		// ── Contact ───────────────────────────────────────────────────
		'contact' => array(
			'title'  => __( 'Contact & Footer', 's-prestige' ),
			'fields' => array(
				'contact_heading'  => array( 'type' => 'html', 'label' => 'Contact heading', 'default' => "Let's talk about<br>your next shipment." ),
				'contact_phone'    => array( 'type' => 'text', 'label' => 'Phone', 'default' => '(+971) 56 922 2006' ),
				'contact_email'    => array( 'type' => 'email', 'label' => 'Email', 'default' => 's.prestige.international@gmail.com' ),
				'contact_address'  => array( 'type' => 'html', 'label' => 'Address (HTML)', 'default' => 'Meydan Grandstand, 6th Floor,<br>Nad Al Sheba, Dubai, UAE' ),
				'footer_tagline'   => array( 'type' => 'textarea', 'label' => 'Footer tagline', 'default' => 'Adnan International Trade & Export Group — delivering excellence in minerals, petrochemicals, steel, and construction materials since 1992.' ),
				'footer_copyright' => array( 'type' => 'text', 'label' => 'Copyright line', 'default' => '© S-Prestige International 2024' ),
				'marquee_text'     => array( 'type' => 'text', 'label' => 'Marquee text', 'default' => 'S Prestige International' ),
			),
		),

		// ── Social ────────────────────────────────────────────────────
		'social'  => array(
			'title'  => __( 'Social Links', 's-prestige' ),
			'fields' => array(
				'social_twitter'  => array( 'type' => 'url', 'label' => 'Twitter URL', 'default' => '' ),
				'social_telegram' => array( 'type' => 'url', 'label' => 'Telegram URL', 'default' => '' ),
				'social_linkedin' => array( 'type' => 'url', 'label' => 'LinkedIn URL', 'default' => '' ),
				'social_medium'   => array( 'type' => 'url', 'label' => 'Medium URL', 'default' => '' ),
			),
		),
	);
}

/**
 * Flatten the field map into key => default for the importer's "Site Text" sync.
 *
 * @return array
 */
function spr_content_defaults() {
	$out = array();
	foreach ( spr_field_map() as $section ) {
		foreach ( $section['fields'] as $key => $field ) {
			if ( 'image' !== $field['type'] ) {
				$out[ $key ] = $field['default'];
			}
		}
	}
	return $out;
}

/**
 * Register everything with the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function spr_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'spr_content',
		array(
			'title'    => __( 'S-Prestige Content', 's-prestige' ),
			'priority' => 20,
		)
	);

	foreach ( spr_field_map() as $section_key => $section ) {
		$section_id = 'spr_section_' . $section_key;
		$wp_customize->add_section(
			$section_id,
			array(
				'title' => $section['title'],
				'panel' => 'spr_content',
			)
		);

		foreach ( $section['fields'] as $key => $field ) {
			$setting_id = 'spr_' . $key;

			switch ( $field['type'] ) {
				case 'image':
					$wp_customize->add_setting(
						$setting_id,
						array(
							'default'           => $field['default'],
							'sanitize_callback' => 'absint',
						)
					);
					$wp_customize->add_control(
						new WP_Customize_Media_Control(
							$wp_customize,
							$setting_id,
							array(
								'label'     => $field['label'],
								'section'   => $section_id,
								'mime_type' => ( false !== strpos( $key, 'video' ) ) ? 'video' : 'image',
							)
						)
					);
					break;

				case 'url':
					$wp_customize->add_setting(
						$setting_id,
						array(
							'default'           => $field['default'],
							'sanitize_callback' => 'esc_url_raw',
						)
					);
					$wp_customize->add_control(
						$setting_id,
						array(
							'label'   => $field['label'],
							'section' => $section_id,
							'type'    => 'url',
						)
					);
					break;

				case 'email':
					$wp_customize->add_setting(
						$setting_id,
						array(
							'default'           => $field['default'],
							'sanitize_callback' => 'sanitize_email',
						)
					);
					$wp_customize->add_control(
						$setting_id,
						array(
							'label'   => $field['label'],
							'section' => $section_id,
							'type'    => 'text',
						)
					);
					break;

				case 'textarea':
				case 'html':
					$wp_customize->add_setting(
						$setting_id,
						array(
							'default'           => $field['default'],
							'sanitize_callback' => 'wp_kses_post',
						)
					);
					$wp_customize->add_control(
						$setting_id,
						array(
							'label'   => $field['label'],
							'section' => $section_id,
							'type'    => 'textarea',
						)
					);
					break;

				default: // text
					$wp_customize->add_setting(
						$setting_id,
						array(
							'default'           => $field['default'],
							'sanitize_callback' => 'sanitize_text_field',
						)
					);
					$wp_customize->add_control(
						$setting_id,
						array(
							'label'   => $field['label'],
							'section' => $section_id,
							'type'    => 'text',
						)
					);
			}
		}
	}
}
add_action( 'customize_register', 'spr_customize_register' );
