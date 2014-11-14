<?php
namespace core;

class DateHelper {

  public static function createDateRangeArray($strDateFrom,$strDateTo)
  {
      // takes two dates in format YYYY-MM-DD and creates an
      // array of the dates between the from and to dates.

      $aryRange=array();

      $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
      $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

      if ($iDateTo>=$iDateFrom)
      {
          array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
          while ($iDateFrom<$iDateTo)
          {
              $iDateFrom+=86400; // add 24 hours
              array_push($aryRange,date('Y-m-d',$iDateFrom));
          }
      }
      return $aryRange;
  }

  public static function createWeekRangeArray($strDateFrom, $strDateTo)
  {
      $aryRange=array();

      $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
      $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

      if ($iDateTo>=$iDateFrom)
      {
          array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
          while (abs($iDateFrom-$iDateTo)/60/60/24>=7)
          {
              $iDateFrom+=86400*7; // add 1 week
              array_push($aryRange,date('Y-m-d',$iDateFrom));
          }
      }
      return $aryRange;
  }

  public static function createMonthRangeArray($strDateFrom, $strDateTo)
  {
      $aryRange=array();

      $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
      $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

      if ($iDateTo>=$iDateFrom)
      {
          array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
          while (abs($iDateFrom-$iDateTo)/60/60/24>=30)
          {
              $iDateFrom+=86400*30; // add 1 month 
              array_push($aryRange,date('Y-m-d',$iDateFrom));
          }
      }
      return $aryRange;

  }
}
