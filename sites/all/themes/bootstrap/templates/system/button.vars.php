<?php
/**
 * @file
 * Stub file for "button" theme hook [pre]process functions.
 */

/**
 * Pre-processes variables for the "button" theme hook.
 *
 * See theme function for list of available variables.
 *
 * @see bootstrap_button()
 * @see theme_button()
 *
 * @ingroup theme_preprocess
 */
function bootstrap_preprocess_button(&$vars) {
  $element = &$vars['element'];

  // Drupal buttons should be of type 'submit'.
  // @see https://www.drupal.org/node/2540452
  $element['#attributes']['type'] = 'submit';

  // Set the element's other attributes.
  element_set_attributes($element, array('id', 'name', 'value'));

  // Add the base Bootstrap button class.
  $element['#attributes']['class'][] = 'btn';

  // Add button size, if necessary.
  if ($size = bootstrap_setting('button_size')) {
    $element['#attributes']['class'][] = $size;
  }

  // Colorize button.
  _bootstrap_colorize_button($element);

  // Add in the button type class.
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];

  // Ensure that all classes are unique, no need for duplicates.
  $element['#attributes']['class'] = array_unique($element['#attributes']['class']);
}
