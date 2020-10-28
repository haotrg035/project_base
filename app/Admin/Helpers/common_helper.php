<?php
if (!function_exists('getBreadcrumb')) {
  function getBreadcrumb(array $breadcrumbData): array
  {
    $result = [];
    foreach ($breadcrumbData as $key => $value) {
      $result[] = [
        'path' => $value[0],
        'breadcrumbName' => $value[1]
      ];
    }
    return $result;
  }
}
