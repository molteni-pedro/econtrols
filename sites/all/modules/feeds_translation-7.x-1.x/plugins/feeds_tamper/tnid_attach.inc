<?php

/**
 * @file
 * Attach a TNID based on GUID
 */

$plugin = array(
  'form' => 'feeds_translation_tamper_tnid_attach_form',
  'callback' => 'feeds_translation_tamper_tnid_attach_callback',
  'name' => 'Get TNID based on GUID',
  'multi' => 'loop',
  'category' => 'Text',
);

/**
 * Form callback
 */
function feeds_translation_tamper_tnid_attach_form($importer, $element_key, $settings) {
  $form = array();
  $form['html'] = array(
    '#markup' => t('This will take a string containing a Feed Item GUID and convert it into a Node Translation TNID.')
  );
  return $form;
}

/**
 * Callback method for the tnid attach tamper plugin
 */
function feeds_translation_tamper_tnid_attach_callback($result, $item_key, $element_key, &$field, $settings) {
  // We want to replace the field value with the node id so it can be set by tamper.
  $result = db_query_range("SELECT entity_id FROM {feeds_item} WHERE guid = :guid", 0, 1, array(':guid' => $field));
  foreach ($result as $record) {
     $field = $record->entity_id;
  }
    
  // Update the original node with the translation information
  $node = node_load($field);
  if (isset($node->nid)) {
    $node->tnid = $field;
    node_save($node);
  }
}

