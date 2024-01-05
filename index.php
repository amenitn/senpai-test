<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */

get_header();
if (have_posts()) {
	// Load posts loop.
	while (have_posts()) {
		the_post();
		the_content();

?>
		<fieldset style="text-align: center;">
			<style>
				input,
				textarea {
					border: 1px solid;
					width: 400px;
					margin: auto;
				}
			</style>

				<h2> Sign In : </h2>
				<form id="myForm_public">
					Name: <input type="input" id="name" value="">
					<br><br>
					E-mail: <input type="text" id="email" value="">
					<br><br>
					Phone: <input type="tel" id="phone" value="">
					<br><br>
					Message: <textarea style="vertical-align: middle;" id="message" rows="5" cols="40"></textarea>
					<br><br>

					<input type="submit" style=" vertical-align: middle; width: 100px; color:aliceblue;
					border:#FF0000; background:#28a745 ; margin:auto;" id="submit" value="Submit">
				</form>
		</fieldset>



<?php

	}
} else {
	echo "<h1 style='text-align:center;margin-top:150px;'>Silence is golden...</h1>";
}

get_footer();
