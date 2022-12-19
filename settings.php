<?php
/**
 * Databáze
 */
    define("DB_SERVER","127.0.0.1");
    define("DB_NAME","semestralka");
    define("DB_USER","root");
    define("DB_PASS","");


/**
 * Kořenová složka
 */
    define("ROOT_DIR","edsa-semestralka/");

/**
 * Stránky webu a jejich přístupové úrovně
 */
    define("PAGES", [
        'uvod' => 0,
        'prihlaseni' => 0,
        'registrace' => 0,
        'odhlaseni' => 0,
        'pokrm' => 0,
        'recenze' => 1,
        'moje-recenze' => 1,
        'sprava-recenzi' => 2,
        'sprava-pokrmu' => 2,
        'uprava-pokrmu' => 2,
        'sprava-uzivatelu' => 3,
        'stranka-nenalezena' => 0,
        'error' => 0
    ]);

/** Systémové stránky */
    define("DEFAULT_PAGE", 'uvod');
    define("NOT_FOUND_PAGE", 'stranka-nenalezena');
    define("ERROR_PAGE", 'error');
    define("LOGIN_PAGE", 'prihlaseni');
