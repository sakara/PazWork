<?php
defined('_PAZLAB') or die;

// PAGINE
function page_show($id)
{
	// visualizza la pagina specifico con id = $id
	function get_page($id)
	{
		$id    = intval($id);
		$query = 'SELECT * FROM pages WHERE id = '.$id.' AND published = 1';
		$result = mysql_query($query) or die("Query non valida: " . mysql_error());
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	$post = get_page($id);
}
/*****/

// NEWS
function news_show($id)
{
	// visualizza la pagina specifico con id = $id
	function get_news($id)
	{
		$id    = intval($id);
		$query = 'SELECT * FROM news WHERE id = '.$id.' AND published = 1';
		$result = mysql_query($query) or die("Query non valida: " . mysql_error());
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	$post = get_news($id);
}

function news_list($num, $limit)
{
	$startpoint = ($num * $limit) - $limit;
	$statement = "news WHERE published = 1 AND private = 0";
	$url = BASE_URL.'news/';

	function get_all_news($num, $limit, $startpoint)
	{

		$query = "SELECT news.*, cat.id AS cid, cat.name AS catname FROM news INNER JOIN cat ON news.cat_id = cat.id WHERE news.published = 1 ORDER BY news.dataora DESC LIMIT $startpoint, $limit";
		$result= mysql_query($query) or die("Query non valida: " . mysql_error());

		$posts = array();
		while ($row = mysql_fetch_assoc($result)) {
			$posts[] = $row;
		}

		return $posts;
	}

	$pagination = pagination($statement, $limit, $num, $url);
	$posts      = get_all_news($userId, $userGroup, $num, $limit, $startpoint);
}

//#######################
function news_cat_show($catid, $num, $limit)
{
	$startpoint = ($num * $limit) - $limit;
	$statement = "news WHERE cat_id = $catid AND published = 1";
	$url = BASE_URL.'news/cat/'.$catid.'/';

	function get_news_by_cat_id($catid, $num, $limit, $startpoint, $statement)
	{
		$catid = intval($catid);
		$query = 'SELECT * FROM '.$statement.' ORDER BY dataora DESC LIMIT '.$startpoint.', '.$limit.'';
		$result= mysql_query($query) or die("Query non valida: " . mysql_error());

		$posts = array();
		while ($row = mysql_fetch_assoc($result)) {
			$posts[] = $row;
		}

		return $posts;
	}

	function get_cat_by_id($catid)
	{
		$catid = intval($catid);
		$query = 'SELECT * FROM cat WHERE id = '.$catid.' AND published = 1';
		$result= mysql_query($query) or die("Query non valida: " . mysql_error());
		$row = mysql_fetch_assoc($result);

		return $row;
	}

	$pagination = pagination($statement, $limit, $num, $url);
	$cat        = get_cat_by_id($catid);
	$posts      = get_news_by_cat_id($catid, $num, $limit, $startpoint, $statement);
}

function news_cat_list()
{
	function get_all_cat_news()
	{
		// TODO aggiungere slug alla query
		$query = 'SELECT id, name FROM cat WHERE published = 1 ORDER BY name ASC';
		$result= mysql_query($query) or die("Query non valida: " . mysql_error());
		//$totali = mysql_num_rows($result);
		$cats = array();
		while ($row = mysql_fetch_assoc($result)) {
			$cats[] = $row;
		}
		return $cats;
	}

	$cats = get_all_cat_news();

	echo '<h3>Categorie</h3>
	<ul class="categories">';
	foreach ($cats as $cat):
	echo '<li><a href="'.BASE_URL.'news/cat/'.$cat['id'].'">'.$cat['name'].'</a></li>';
	endforeach;
	echo '</ul>';
}

function latest_news($catid = NULL)
{
	function get_latest_news($catid)
	{
		$query = 'SELECT id, title, slug FROM news WHERE published = 1 AND private = 0 ORDER BY dataora DESC LIMIT 0, 10';
		$result= mysql_query($query) or die("Query non valida: " . mysql_error());
		//$totali = mysql_num_rows($result);
		$nLatests = array();
		while ($row = mysql_fetch_assoc($result)) {
			$nLatests[] = $row;
		}
		return $nLatests;
	}

	$nLatests = get_latest_news($catid);

	echo '<h3>Ultime News</h3>
	<ul class="recent-post">';
	foreach ($nLatests as $nLatest):
	echo '<li><a href="'.BASE_URL.'news/single/'.$nLatest['id'].'-'.$nLatest['slug'].'.html">'.$nLatest['title'].'</a></li>';
	endforeach;
	echo '</ul>';
}

// Questa funzione si occupa di controllare se un indirizzo
// email  stato scritto correttamente
function emailIsValid($email)
{
	if (false == preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $email)) {
		return false;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
		elseif (!checkdnsrr(array_pop(explode('@',$email)),'MX')) return false;
	}
	else {
		return true;
	}
}
function urlIsValid($url)
{
	if (!filter_var($url, FILTER_VALIDATE_URL)) {
		return false;
	}else {
		return true;
	}
}

// formatta la data ed esclude l orario
function data_it($data)
{
	// Creo una array dividendo la data dall ora
	$array_ = explode(" ", $data);
	$data_  = $array_[0];
	$ora_   = $array_[1];

	// Creo una array dividendo la data YYYY - MM - DD sulla base del trattino
	$array  = explode("-", $data_);

	// Riorganizzo gli elementi in stile DD / MM / YYYY
	$data_it= $array[2]."/".$array[1]."/".$array[0];

	// Restituisco il valore della data in formato italiano
	return $data_it;
}

// formatta la data e l ora
function dataora_it($data)
{
	// Creo una array dividendo la data dall ora
	$array_ = explode(" ", $data);
	$data_  = $array_[0];
	$ora    = $array_[1];

	// Creo una array dividendo la data YYYY - MM - DD sulla base del trattino
	$array  = explode("-", $data_);

	// Riorganizzo gli elementi in stile DD / MM / YYYY
	$data_it= $array[2]."/".$array[1]."/".$array[0];

	// Restituisco il valore della data in formato italiano
	return $data_it.' '.$ora;
}

/*****/

/**
* Sanitize only one variable .
* Returns the variable sanitized according to the desired type or true/false
* for certain data types if the variable does not correspond to the given data type.
*
* NOTE: True/False is returned only for telephone, pin, id_card data types
*
* @param mixed The variable itself
* @param string A string containing the desired variable type
* @return The sanitized variable or true/false
*/

function sanitizeOne($var, $type)
{

	switch ( $type ) {

		case 'int': // integer
		$var = (int) $var;
		break;

		case 'str': // trim string
		$var = trim ( $var );
		break;

		case 'nohtml': // trim string, no HTML allowed
		$var = htmlentities ( trim ( $var ), ENT_QUOTES );
		break;

		case 'plain': // trim string, no HTML allowed, plain text
		$var = htmlentities ( trim ( $var ) , ENT_NOQUOTES )  ;
		break;

		case 'upper_word': // trim string, upper case words
		$var = ucwords ( strtolower ( trim ( $var ) ) );
		break;

		case 'ucfirst': // trim string, upper case first word
		$var = ucfirst ( strtolower ( trim ( $var ) ) );
		break;

		case 'lower': // trim string, lower case words
		$var = strtolower ( trim ( $var ) );
		break;

		case 'urle': // trim string, url encoded
		$var = urlencode ( trim ( $var ) );
		break;

		case 'trim_urle': // trim string, url decoded
		$var = urldecode ( trim ( $var ) );
		break;

		case 'telephone': // True / False for a telephone number
		$size = strlen ($var) ;
		for ($x = 0;$x < $size;$x++) {
			if ( ! ( ( ctype_digit($var[$x] ) || ($var[$x] == '+') || ($var[$x] == '*') || ($var[$x] == 'p')) ) ) {
				return false;
			}
		}
		return true;
		break;

		case 'sql': // True / False if the given string is SQL injection safe
		//  insert code here, I usually use ADODB -> qstr() but depending on your needs you can use mysql_real_escape();
		return mysql_real_escape_string($var);
		break;

	}
	return $var;
}

/**
* Sanitize an array.
*
* sanitize($_POST, array('id'=>'int', 'name' => 'str'));
* sanitize($customArray, array('id'=>'int', 'name' => 'str'));
*
* @param array $data
* @param array $whatToKeep
*/

function sanitize( & $data, $whatToKeep )
{

	$data = array_intersect_key( $data, $whatToKeep );
	foreach ($data as $key => $value) {
		$data[$key] = sanitizeOne( $data[$key] , $whatToKeep[$key] );
	}
}
/*********************************/

// Questa funzione si occupa della paginazione
function pagination($query, $per_page = 5, $num = 1, $url = '&')
{
	$query     = "SELECT COUNT(*) as num FROM {$query}";
	$row       = mysql_fetch_array(mysql_query($query));
	$total     = $row['num'];
	$adjacents = "2";

	$num       = ($num == 0 ? 1 : $num);
	$start     = ($num - 1) * $per_page;

	$prev      = $num - 1;
	$next      = $num + 1;
	$lastpage  = ceil($total / $per_page);
	$lpm1      = $lastpage - 1;

	$pagination= "";
	if ($lastpage > 1) {
		$pagination .= "<div class='pagination'><div>Pagina $num di $lastpage</div>";

		if (($num == 1) || ($num == '')) {

		}else {
			$pagination .= "<a href='{$url}num/1'>Prima</a>";
			$pagination .= "<a href='{$url}num/$prev'>Prec.</a>";
		}

		//$pagination .= " < li class = 'details' > Pagina $num di $lastpage</li > ";
		if ($lastpage < 7 + ($adjacents * 2)) {
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $num)
					$pagination .= "<a class='active'>$counter</a>";
				else
					$pagination .= "<a href='{$url}num/$counter'>$counter</a>";
			}
		}
		elseif ($lastpage > 5 + ($adjacents * 2)) {
			if ($num < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $num)
						$pagination .= "<a class='active'>$counter</a>";
					else
						$pagination .= "<a href='{$url}num/$counter'>$counter</a>";
				}
				$pagination .= "...";
				$pagination .= "<a href='{$url}num/$lpm1'>$lpm1</a>";
				$pagination .= "<a href='{$url}num/$lastpage'>$lastpage</a>";
			}
			elseif ($lastpage - ($adjacents * 2) > $num && $num > ($adjacents * 2)) {
				$pagination .= "<a href='{$url}num/1'>1</a>";
				$pagination .= "<a href='{$url}num/2'>2</a>";
				$pagination .= "...";
				for ($counter = $num - $adjacents; $counter <= $num + $adjacents; $counter++) {
					if ($counter == $num)
						$pagination .= "<a class='active'>$counter</a>";
					else
						$pagination .= "<a href='{$url}num/$counter'>$counter</a>";
				}
				$pagination .= "...";
				$pagination .= "<a href='{$url}num/$lpm1'>$lpm1</a>";
				$pagination .= "<a href='{$url}num/$lastpage'>$lastpage</a>";
			}
			else {
				$pagination .= "<a href='{$url}num/1'>1</a>";
				$pagination .= "<a href='{$url}num/2'>2</a>";
				$pagination .= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $num)
						$pagination .= "<a class='active'>$counter</a>";
					else
						$pagination .= "<a href='{$url}num/$counter'>$counter</a>";
				}
			}
		}

		if ($num < $counter - 1) {
			$pagination .= "<a href='{$url}num/$next'>Pross.</a>";
			$pagination .= "<a href='{$url}num/$lastpage'>Ultima</a>";
		}else {

		}
		$pagination .= "</div>\n";
	}


	return $pagination;
}

/*######################### ADMIN ##############################*/

function remove_accent($str)
{
	$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
	$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
	return str_replace($a, $b, $str);
}

function make_slug($str)
{
	return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
								   array('', '-', ''), remove_accent($str)));
}
