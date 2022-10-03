<?php

namespace App\Helpers;

class Helper{

public static function upload_image($image, $default = null)
{
  if ($image) {
    if (strpos($image, 'https://') !== false || strpos($image, 'http://') !== false) {
      return $image;
    }
    return url('storage/uploads/images/' . $image);
  }

  if ($default) return asset($default);

  return '';
}

public static function upload_video($video, $default = null)
{
  if ($video) {
    if (strpos($video, 'https://') !== false || strpos($video, 'http://') !== false) {
      return $video;
    }
    return url('storage/uploads/videos/' . $video);
  }

  if ($default) return asset($default);

  return '';
}

}

?>