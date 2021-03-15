<?php
/**
 * Funzione di ordine superiore funzione che restituisce una funzione
 * Programmazione Funzionale - dichiarativo 
 */
function searchText(string $searchText) {
    return function ($item) use ($searchText){
        return (strpos($item,  $searchText)!==false);
    };
}

/**
 * @var string $status è la stringa che corrisponde allo status da cercare
 * (progress|done|todo)
 * @return callable La funzione che verrà utilizzata da array_filter
 */
function searchStatus(string $status) : callable {
    return function ($taskItem) use ($status){
        return strpos($taskItem, $status)!==false;
    };
} 


