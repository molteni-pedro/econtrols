<?php
/**
 * @file
 * Stub file for bootstrap_menu_local_action().
 */

/**
 * Returns HTML for a single local action link.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: A render element containing:
 *     - #link: A menu link array with 'title', 'href', and 'localized_options'
 *       keys.
 *
 * @return string
 *   The constructed HTML.
 *
 * @see theme_menu_local_action()
 *
 * @ingroup theme_functions
 */
function bootstrap_menu_local_action($variables) {
  $link = $variables['element']['#link'];

  $options = isset($link['localized_options']) ? $link['localized_options'] : array();

  // If the title is not HTML, sanitize it.
  if (empty($options['html'])) {
    $link['title'] = check_plain($link['title']);
  }

  $icon = _bootstrap_iconize_text($link['title']);

  // Format the action link.
  $output = '';
  if (isset($link['href'])) {
    // Turn link into a mini-button and colorize based on title.
    if ($class = _bootstrap_colorize_text($link['title'])) {
      if (!isset($options['attributes']['class'])) {
        $options['attributes']['class'] = array();
      }
      $string = is_string($options['attributes']['class']);
      if ($string) {
        $options['attributes']['class'] = explode(' ', $options['attributes']['class']);
      }
      $options['attributes']['class'][] = 'btn';
      $options['attributes']['class'][] = 'btn-xs';
      $options['attributes']['class'][] = 'btn-' . $class;
      if ($string) {
        $options['attributes']['class'] = implode(' ', $options['attributes']['class']);
      }
    }
    // Force HTML so we can render any icon that may have been added.
    $options['html'] = !empty($options['html']) || !empty($icon) ? TRUE : FALSE;
    $output .= l($icon . $link['title'], $link['href'], $options);
  }
  else {
    $output .= $icon . $link['title'];
  }

  return $output;
}
