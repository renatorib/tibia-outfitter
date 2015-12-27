<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit(array(
    'query' => true,
    'hexmount' => true,
    'queries' => array(
        'looktype' => 'a',
        'addons' => 'b',
        'head' => 'c',
        'body' => 'd',
        'legs' => 'e',
        'feet' => 'f',
        'mount' => 'g',
        'direction' => 'h',
        'movement' => 'i'
    )
));
$outfit->render();
