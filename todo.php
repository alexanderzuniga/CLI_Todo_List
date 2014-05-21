<?php

$items = array();
                         
                         //for $file use 'list.txt'
function import($File){
    $filename = $File;
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    $file_array = explode("\n", $contents);
    return $file_array;
    fclose($handle);
}
function save_file($filename, $data_to_save)
{
   $input = 'Y';

   if (file_exists($filename)) 
   {
       echo "This will overwrite the file. Are you sure? Y or N? ";
       $input = get_input(TRUE);
           if ($input == 'Y') 
           {
               $handle = fopen($filename, 'w');
               $contents = implode("\n", $data_to_save);
               fwrite($handle, $contents);
               fclose($handle);
           } 
   }
   else 
   {
       echo "No changes were made.\n";
   }
}
//////////
function list_items($list) 
{
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
function sort_menu($items)
{
    echo "How would you like to sort?\n";
    echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered : \n";
    $input = get_input(true);
    switch ($input){
        case 'A':
        asort($items, SORT_NATURAL | SORT_FLAG_CASE);
        break;
        case 'Z';
        arsort($items, SORT_NATURAL | SORT_FLAG_CASE);
        break;
        case 'O';
        ksort($items, SORT_NATURAL | SORT_FLAG_CASE);
        break;
        case 'R';
        krsort($items, SORT_NATURAL | SORT_FLAG_CASE);
        break;
    }
    return $items;
}
///////////
// When sort menu is opened, show the following options 
// "(A)-Z{sort($items)}, (Z)-A{rsort($items), (O)rder entered {else}, (R)everse order entered {krsort}".

do {
    echo list_items($items);  
    echo '(N)ew item, (R)emove item, (S)ort, (O)pen File, s(A)ve, (Q)uit : ';
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
        echo "Enter the name of your file: ";
        $File = get_input();
        $extfile_array = import($File);
        $items = array_merge($items, $extfile_array);
    }
    elseif ($input == 'A') {
        echo "Enter file name: ";
        $filename = get_input(true);
        save_file($filename, $items);
        echo "*** File was saved ***";     
    }
} while ($input != 'Q');
echo "Goodbye!\n";
exit(0);

?>