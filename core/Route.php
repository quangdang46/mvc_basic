<?php
class Route
{
  public function handleRoute($url)
  {
    global $routers;
    unset($routers['default_controller']);
    $url = trim($url, "/");
    $handleUrl = $url;
    if (!empty($routers)) {
      foreach ($routers as $key => $value) {
        if (preg_match('~' . $key . '~is', $url)) {
          $handleUrl = $value;
          break;
        }
      }
    }
    return $handleUrl;
  }
}
