<?php

$items = array();

do {
    foreach ($items as $key => $item) {
        $key = ++$key;
        echo "[{$key}] {$item}\n";
    }
        echo '(N)ew item, (R)emove item, (Q)uit : ';
        $input = strtoupper(trim(fgets(STDIN)));

    if ($input == 'N') {
        echo 'Enter item: ';
        $items[] = trim(fgets(STDIN));
    } 
        elseif ($input == 'R') {
            echo 'Enter item number to remove: ';
            $key = trim(fgets(STDIN));
            $key -= 1;
            unset($items[$key]);
            $items = array_values($items);
    }
}   while ($input != 'Q');
echo "Goodbye!\n";


exit(0);

















?>