<?php

$items = array();

function sort_menu($items){
    echo "How would you like to sort?\n";
    echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered : \n";
    $input = get_input(true);
    switch ($input){
        case 'A':
            asort($items);
            break;
        case 'Z';
            arsort($items);
            break;
        case 'O';
            ksort($items);
            break;
        case 'Z';
            krsort($items);
            break;
    }
    return $items;
}
// When sort menu is opened, show the following options 
// "(A)-Z{sort($items)}, (Z)-A{rsort($items), (O)rder entered {else}, (R)everse order entered {krsort}".

function get_input($upper = false)
{
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result; // if ? true : false (layout for if then statement)
}

do {
    foreach ($items as $key => $item) {
        $key = ++$key;
        echo "[{$key}] {$item}\n";
    }
        echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';
        $input = get_input(true); 

    if ($input == 'N') {
        echo 'Enter item: ';
        $items[] = get_input();
    } 
        elseif ($input == 'R') {
            echo 'Enter item number to remove: ';
            $key = get_input();
            --$key;
            unset($items[$key]);
            //$items = array_values($items);
        }
        elseif ($input == 'S') {
            $items = sort_menu($items);
        }
}   while ($input != 'Q');
echo "Goodbye!\n";
exit(0);



?>