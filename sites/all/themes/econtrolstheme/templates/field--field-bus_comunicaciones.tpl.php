<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $language;
print '<div><b>' . $element['#title'] . '</b>: ';
//print_r($element['#object']->field_bus_comunicaciones);
if ($element['#object']->field_bus_comunicaciones['und'][0]['entity']->tnid > 0) {
    $idi_trad = translation_node_get_translations($element['#object']->field_bus_comunicaciones['und'][0]['entity']->tnid);
    $trad_node = node_load($idi_trad[$language->language]->nid);
    print $trad_node->title;
} else {
    print $element['#object']->field_bus_comunicaciones['und'][0]['entity']->title;
}
print '</div>';
