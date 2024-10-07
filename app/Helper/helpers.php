<?php

function setLinkActivator(array $route)
{
  if (is_array($route)) {
    foreach ($route as $item) {
      if (request()->routeIs($item)) {
        return 'active';
      }
    }
  }
}
