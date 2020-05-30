<div class="entry-content">
	<div class="content-inner">
		<?php the_content( sprintf(
				esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kipso' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		?>
	</div>
</div>