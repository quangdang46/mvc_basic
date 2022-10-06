<?php
class Route
{
  public function handleRoute($url)
  {
    global $routers;
    unset($routers['default_controller']);
    $url = trim($url, "/");
    if (empty($url)) {
      $url = "/";
    }
    $handleUrl = $url;
    $active = false;
    if (!empty($routers)) {
      foreach ($routers as $key => $value) {
        if (preg_match('~' . $key . '~is', $url)) {
          $handleUrl = $value;
          $active = true;
          break;
        }
      }
    }
    return [
      "path" => $handleUrl,
      "active" => $active,
    ];
  }
}
