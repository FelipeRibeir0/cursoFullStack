<?php

function read(string $table, string $fields = '*')
{
    global $query;
    $query = [];

    $query['read'] = true;
    $query['table'] = $table;
    $query['execute'] = [];
    $query['sql'] = "SELECT {$fields} FROM {$table}";
}

?>