<?php
class TimeConversion
{
static public function ConvertGMTToLocalTimezone($gmttime,$timezoneRequired)
{
   $system_timezone = date_default_timezone_get();
   date_default_timezone_set("GMT");
   $gmt = date("Y-m-d h:i:s A");
   $local_timezone = $timezoneRequired;
   date_default_timezone_set($local_timezone);
   $local = date("Y-m-d h:i:s A");
   date_default_timezone_set($system_timezone);
   $diff = (strtotime($local) - strtotime($gmt));
   $date = new DateTime($gmttime);
   $date->modify("+$diff seconds");
   $timestamp = $date->format("Y-m-d H:i:s");
   return $timestamp;
}
static public function ConvertServerTimezoneToGMT($gmttime)
{
   $system_timezone = date_default_timezone_get();
 
   $local_timezone = $system_timezone;
   date_default_timezone_set($local_timezone);
   $local = date("Y-m-d h:i:s A");
 
   date_default_timezone_set("GMT");
   $gmt = date("Y-m-d h:i:s A");
 
   date_default_timezone_set($system_timezone);
   $diff = (strtotime($gmt) - strtotime($local));
 
   $date = new DateTime($gmttime);
   $date->modify("+$diff seconds");
   $timestamp = $date->format("Y-m-d H:i:s");
   return $timestamp;
}	
static public function ConvertServerTimezoneToLocalTimezone($time,$timezoneRequired)
{
   $system_timezone = date_default_timezone_get();
   $local_timezone = $system_timezone;
   date_default_timezone_set($local_timezone);
   $local = date("Y-m-d h:i:s A");
 
   date_default_timezone_set("GMT");
   $gmt = date("Y-m-d h:i:s A");
 
   $require_timezone = $timezoneRequired;
   date_default_timezone_set($require_timezone);
   $required = date("Y-m-d h:i:s A");
 
   date_default_timezone_set($system_timezone);
   $diff1 = (strtotime($gmt) - strtotime($local));
   $diff2 = (strtotime($required) - strtotime($gmt));
   $date = new DateTime($time);
   $date->modify("+$diff1 seconds");
   $date->modify("+$diff2 seconds");
   $timestamp = $date->format("Y-m-d H:i:s");
   return $timestamp;
}
}