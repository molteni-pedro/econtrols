<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $language;
print '<br />';
if($element['#object']->field_receptor_infrarrojo['und'][0]['value'] == 'SI'){
    print '<div><b>'.$element['#title'].'</b>: ';
    if($language->language == 'es') print 'SI';
    else print 'YES';
}
