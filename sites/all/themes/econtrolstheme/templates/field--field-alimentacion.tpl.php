<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $language;
print '<div><b>'.$element['#title'].'</b>: ';
$idi_trad = translation_node_get_translations($element['#object']->field_alimentacion['und'][0]['entity']->tnid);
$trad_node = node_load($idi_trad[$language->language]->nid);
print $trad_node->title.'</div>';
