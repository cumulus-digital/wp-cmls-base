<?php
/**
 * CMLS Base Theme
 * Template part
 * Archive Header / Term Children
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );
?>

<!-- templates/archives/header-term_children -->
<div class="row">
	<div class="row-container tax-children-nav">
		<nav>
			<ul>
			<?php foreach ( $args['term_children'] as $child_term ): ?>
				<li class="tax-<?php echo $child_term->slug; ?>">
					<a href="<?php echo \get_term_link( $child_term ); ?>">
						<?php echo $child_term->name; ?>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</div>
<!-- /templates/archives/header-term_children -->