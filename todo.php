<?php

$items = array();

function import($File){
    $filename = $File;
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    echo $contents;
}
//////////
function list_items($list) {
    $result = '';
    foreach ($list as $key => $values) {
        $result .= "[" . ($key + 1) . "] {$values}\n";
    }
    return $result;
}

////////////
function get_input($upper = false)
{
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result; // if ? true : false (layout for if then statement)
}
///////////

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
        case 'R';
        krsort($items);
        break;
    }
    return $items;
}
///////////
// When sort menu is opened, show the following options 
// "(A)-Z{sort($items)}, (Z)-A{rsort($items), (O)rder entered {else}, (R)everse order entered {krsort}".

do {
    echo list_items($items);  
    echo '(N)ew item, (R)emove item, (S)ort, (O)pen File, (Q)uit : ';
    $input = get_input(true);
    if ($input == 'N') {
        //Would you like your item to be at the (B)eginning or (E)nd of your list?
        echo 'Enter item: ';
        $item = get_input();
        echo 'Would you like your item to be at the (B)eginning or (E)nd of your list? ';
        $b_or_e = get_input(true);

        if ($b_or_e == 'B') 
        {
            array_unshift($items, $item);
        }   elseif ($b_or_e == 'E') 
        {
            array_push($items, $item);
        }
    }   
    elseif ($input == 'R') {
        echo 'Enter item number to remove: ';
        $key = get_input();
        --$key;
        unset($items[$key]);
        $items = array_values($items);
    }
    elseif ($input == 'F') {
        echo 'Power User Function.\n'; 
        array_shift($items);
    }
    elseif ($input == 'L') {
        echo "Power User function.\n";
        array_pop($items);
    }
    elseif ($input == 'S') {
        $items = sort_menu($items);
    }
    elseif ($input == 'O') {
        echo "Enter the name of your file.\n";
        $File = get_input();
        $extfile = import($File);
        echo $extfile . PHP_EOL;
    }
}   while ($input != 'Q');
echo "Goodbye!\n";
exit(0);



?>