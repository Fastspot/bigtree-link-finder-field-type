<?
	/*
		When drawing a field type you are provided with the $field array with the following keys:
			"title" — The title given by the developer to draw as the label (drawn automatically)
			"subtitle" — The subtitle given by the developer to draw as the smaller part of the label (drawn automatically)
			"key" — The value you should use for the "name" attribute of your form field
			"value" — The existing value for this form field
			"id" — A unique ID you can assign to your form field for use in JavaScript
			"tabindex" — The current tab index you can use for the "tabindex" attribute of your form field
			"options" — An array of options provided by the developer
			"required" — A boolean value of whether this form field is required or not
	*/
?>
<style>
	#<?=$field["id"]?>_lf { position: relative; }
	#<?=$field["id"]?>_lf_output { background: #FFF; border: 1px solid #AAA; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15); max-height: 200px; overflow-y: auto; margin: -2px 0 0 0; position: absolute; width: 896px; z-index: 3; }
	#<?=$field["id"]?>_lf_output div { background: #59A8E9; color: #FFF; font-size: 13px; height: auto; line-height: 20px; padding: 4px 10px 3px; }
	#<?=$field["id"]?>_lf_output a { border-bottom: 1px solid #DDD; color: #333; display: block; font-size: 10px; height: auto; line-height: 14px; padding: 3px 10px; }
	#<?=$field["id"]?>_lf_output a:nth-child(odd) { background: #FAFAFA; }
	#<?=$field["id"]?>_lf_output a:last-child { border-bottom: none; }
	#<?=$field["id"]?>_lf_output a:hover { background: #EEE; }
</style>
<div class="text_input" id="<?=$field["id"]?>_lf">
	<input class="<?=$field["options"]["validation"]?>" type="text" tabindex="<?=$field["tabindex"]?>" name="<?=$field["key"]?>" value="<?=$field["value"]?>" id="<?=$field["id"]?>" />
	<div id="<?=$field["id"]?>_lf_output" style="display: none;"></div>
</div>
<script>
	(function() {
		var $field = $("#<?=$field["id"]?>");
		var $output = $("#<?=$field["id"]?>_lf_output");

		$field.on("keyup",function() {
			var query = $field.val().trim(),
				width = $field.outerWidth(true) - 2;

			$output.css({ width: width }).scrollTop(0);

			if (!query.length) {
				$output.hide().html("");
			} else {
				$output.load("<?=ADMIN_ROOT?>*/com.fastspot.link-finder-field-type/ajax/search/", { query: query }, function() {
					$output.show().children("a").click(function(e) {
						e.preventDefault();
						e.stopPropagation();

						$field.val($(this).attr("href"));
						$output.hide().html("");
					});
				});
			}
		});
	})();
</script>
