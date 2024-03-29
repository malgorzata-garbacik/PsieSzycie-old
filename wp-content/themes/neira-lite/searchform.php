<?php
/**
 * The template for displaying search forms in Neira
 *
 * @package Neira lite
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Wyszukaj na stronie...', 'placeholder', 'neira-lite' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( '&nbsp;', 'submit button', 'neira-lite' ); ?>" />
</form>