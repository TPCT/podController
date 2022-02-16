<?php

namespace helpers;

class Helper
{
  public static function logged()
  {
    return isset($_SESSION['user_info']['logged']) && $_SESSION['user_info']['logged'];
  }

  public static function arrayRecursiveDiff($aArray1, $aArray2): array
  {
      $aReturn = array();

      foreach ($aArray1 as $mKey => $mValue) {
          if (array_key_exists($mKey, $aArray2)) {
              if (is_array($mValue)) {
                  $aRecursiveDiff = self::arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                  if (count($aRecursiveDiff)) {
                      $aReturn[$mKey] = $aRecursiveDiff;
                  }
              } else {
                  if ($mValue != $aArray2[$mKey]) {
                      $aReturn[$mKey] = $mValue;
                  }
              }
          } else {
              $aReturn[$mKey] = $mValue;
          }
      }
      return $aReturn;
  }

}