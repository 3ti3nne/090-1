<?php


namespace SYRADEV\Utils\Php;


class Outils {

    /* Nettoie les données postées avant stockage */
    static public function cleanUpValues($allValues) {
        foreach ($allValues as $key => $value) {
            if (is_array($value)) {
                $allValues[$key] = self::cleanUpValues($value);
            } else {
                $allValues[$key] = addslashes(htmlspecialchars(trim(strip_tags($value))));
            }
        }
        return $allValues;
    }

    /* Fonction qui s'assure qu'un appel de page PHP est bien effectué en AJAX */
    static public function ajaxCheck() {
        $check=false;
        $requestedWith = $_SERVER['HTTP_X_REQUESTED_WITH'];

        if(!empty($requestedWith) && strtolower($requestedWith) == 'xmlhttprequest') {
            $check = true;
        }
        return $check;
    }

    /* Fonction qui s'assure qu'un appel de page PHP est bien effectué depuis le nom de domaine référencé */
    static public function domainCheck() {
        global $domain;
        $check=false;
        $referer = substr($_SERVER['HTTP_REFERER'],0,strlen($domain));
        if( $referer == $domain ) {
            $check = true;
        }
        return $check;
    }
}