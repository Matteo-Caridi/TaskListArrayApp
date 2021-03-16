<?php

/**
 * Funzione di ordine superiore funzione che restituisce una funzione
 * Programmazione Funzionale - dichiarativo 
 */
function searchText($searchText)
{
    return function ($taskItem) use ($searchText) {
        $result = trim(filter_var($searchText, FILTER_SANITIZE_STRING));
        if ($result !== ""){
            return stripos($taskItem['taskName'],  $result) !== false;
        }else{
            return count($taskItem);
        }
    };
}

/**
 * @var string $status è la stringa che corrisponde allo status da cercare
 * (progress|done|todo)
 * @return callable La funzione che verrà utilizzata da array_filter
 */
function searchStatus(string $status)
{
    return function ($taskItem) use ($status) {
        if ($status !== 'all') {
            return strpos($taskItem['status'], $status) !== false;
        } else {
            return $taskItem;
        }
    };
}

function getColor($status)
{
    if ($status === 'todo') {
        return "danger";
    } elseif ($status === 'progress') {
        return "primary";
    } elseif ($status === 'done') {
        return "secondary";
    }
}
