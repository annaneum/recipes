<?php
function array_delete_row(&$array, $id) {
	unset($array[$id]);
	$array = array_values($array);
}

function number_to_word($num, $lang = "en-US") {
	$numFormat = new NumberFormatter($lang, NumberFormatter::SPELLOUT);
	return $numFormat->format($num);
}
?>