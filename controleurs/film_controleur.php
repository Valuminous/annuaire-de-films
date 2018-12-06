<?php
$maxFilm = 16;
$select = false;
$isGenre = false;
$isList = false;

require_once("modeles/film_modeles.php");

                    // Fonction qui liste tous les films
function filmList() {
    global $twig, $base_url, $tri, $select, $isList;
    $select = true;
    $isList = true;
    $tri === 1 ? $films = bdd_filmList('ASC') : $films = bdd_filmList('DESC');    
    echo $twig->render('film.twig',
    array('films' => $films, "base_url" => $base_url, "select" => $select, "isList" => $isList));
}
    
                    // Fonction qui détails par film
function filmDetail() {
    global $twig, $id, $base_url;
    $films = bdd_filmDetail();
    if ($id !=0) {
            $details = bdd_filmDetail($id);
        } elseif ($id < 1 || $id > $maxFilm) {
            $details = bdd_filmDetail(1);
        }
    echo $twig->render('film.twig', array('details' => $details, "base_url" => $base_url));
}

                    // Fonction qui lie les films à leurs genres
function filmGenre() {
    global $twig, $id, $base_url, $genres, $tri, $select, $isGenre;
    $select = true;
    $isGenre = true;
    if ($id !=0) {
        $tri === 1 ? $genres = bdd_filmGenre($id, 'ASC') : $genres = bdd_filmGenre($id, 'DESC');
    } elseif ($id < 1 || $id > 17) {
        $genres = bdd_filmList(0, 'DESC');
    }
    echo $twig->render('film.twig',
    array('genres' => $genres, "base_url" => $base_url, "select" => $select, "isGenre" => $isGenre, "idGenre" => $id));
}

switch ($action) {
    case 'list':
        filmList();
        break;

    case 'detail':
        filmDetail();
        break;
    
    case 'genre':
        filmGenre();
        break;

    default:
        filmList();
        break;
}