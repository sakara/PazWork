<?php
// imposto la definizione _PAZLAB a 1 (se non è presente e il file non è incluso in questo index restituisce errore, questo evita a chiunque di aprire gli includes vari)
define('_PAZLAB', 1);

// includo il framework
require_once 'admin/core/pazwork.php';

// inizio controllando che cosa passa il browser (section, view, etc) e se il GET è vuoto redirigo alla home o ad una pagina di errore 404
if(isset($_GET['section'])):
	$section = sanitizeOne($_GET['section'], 'str');
else:
	$section = 'home';
endif; 

// switch tra le varie sezioni (home, pagine, contatti, etc)
// le varie sezioni e funzionalità vanno inserite qui (es.: news, portfolio, agenda, etc)
switch ($section) {
	
	// HOME
	
	case "home":
		//layout('default', 'view', 'home');
		layout();
	break;
	//#################
	
	// PAGINE
	
	case "pages":
		if(isset($_GET['view'])): $action = sanitizeOne($_GET['view'], 'str'); else: $action = 'error'; endif;
		switch ($action){
			case "single":
				if(isset($_GET['id'])):
					if ($_GET['id'] != ''):
						layout('default', 'view', 'pages');
					else:
						layout('default', 'error', '');
					endif;
				else: 
						layout('default', 'error', '');
				endif;
			break; // fine visualizza pagina con id

			case "error":
				layout('default', 'error', '');
			break;

			default:
				layout('default', 'error', '');
		}
	break;
	//#################
	
	// NEWS
	
	case "news":
		if(isset($_GET['view'])): $action = sanitizeOne($_GET['view'], 'str'); else: $action = 'all'; endif;
		switch ($action){
			case "single":
				if(isset($_GET['id'])):
					if ($_GET['id'] != ''):
						layout('default', 'view', 'news');
					else:
						layout('default', 'error', '');
					endif;
				else: 
					layout('default', 'error', '');
				endif;
			break; // fine visualizza pagina con id

			case "cat":
				if(isset($_GET['catid'])):
					if ($_GET['catid'] != ''):
						layout('default', 'list', 'news');
					else:
						layout('default', 'error', '');
					endif;
				else: 
					layout('default', 'list', 'news'); // se non c'è un catid lista tutte le news
				endif;
			break; // fine visualizza news con id categoria (catid)
			
			case "all":
				// TODO FARE unica funzione all? con variabile $type = news, portfolio, private etc???
				news_list_action($num, $limit);
			break; // fine lista tutte le news di tutte le categorie

			default:
				layout('default', 'list', 'news'); // lista tutte le news per default
		}
	break;
	//#################

	// CONTATTI
	
	case "contacts":
		if(isset($_GET['view'])): $view = sanitizeOne($_GET['view'], 'str'); else: $view = '';  endif;
		switch ($view){
			case "confirm":
				layout('default', 'confirm', 'contact');
			break;

			default:
				layout('default', 'view', 'contact'); // visualizza il form di contatto per default
	}
	break;
	//#################

	default:
		layout(); // visualizza la home come default
}