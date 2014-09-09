=== SB Paginate ===
Contributors: skylarkcob
Donate link: http://hocwp.net/donate/
Tags: sb, paginate, pagination
Requires at least: 3.6
Tested up to: 4.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

SB Paginate is a pagination plugin that allows to set up navigation on WordPress site.

== Description ==

SB Paginate is a pagination plugin that allows to set up navigation on WordPress site. SB Paginate not only supports the default query but also it can be used to show navigation for the custom query on WordPress.

== Installation ==

Upload the SB Paginate plugin to your blog, activate it, then put the function sb_paginate into theme file.

1, 2, 3: You're done!

Examples:

For the default query:
	
	<?php if(function_exists("sb_paginate")) sb_paginate(); ?>
	
For the custom query usage with arguments:
	
	<?php $test_query = new WP_Query(array("posts_per_page" => 1, "paged" => get_query_var("paged"))); ?>
	<?php while ( $test_query->have_posts() ) : $test_query->the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; wp_reset_postdata(); ?>
	<?php if(function_exists("sb_paginate")) sb_paginate(array("query" => $test_query)); ?>
	
For basic usage, you can also have a look at the [plugin homepage](http://hocwp.net/).
	
== Screenshots ==

1. The pagination in default style.