<?php

/**
 * Funzione di ordine superiore funzione che restituisce una funzione
 * Programmazione Funzionale - dichiarativo 
 */
function searchText($searchText)
{
    return function ($taskItem) use ($searchText) {
        return strpos($taskItem['taskName'],  $searchText) !== false;
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
