<?php
require_once("modeles/acteur_modeles.php");

function actList() {
    global $twig, $base_url;
    $acteurs = bdd_actList();
    echo $twig->render('acteur.twig', array('acteurs' => $acteurs, "base_url" => $base_url));
}

function actDetail() {
    global $twig,$base_url, $id;
    if ($id !=0) {
        $details = bdd_actDetail($id);
    } elseif ($id < 1 || $id > 60) {
        $details = bdd_actDetail(1);
    }
    echo $twig->render('acteur.twig', array('details' => $details, "base_url" => $base_url));
}

switch ($action) {
    case 'list':
        actList();
        break;

    case 'detail':
        actDetail();
        break;

    default:
        actlList();
        break;
}