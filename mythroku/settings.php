<?php

//EDIT-HERE: Weather Forecaset location
$City = 'District of Columbia';
$State = '';
$Country = 'USA';

//EDIT-HERE: Addresses of systems needed to use MythRokuPlayer
$WebHostIP = "192.168.1.130";  // web server IP address
$MysqlServer  = $WebHostIP;     // mysql server ip/name
$MythTVdb     = "mythconverg";  // mythtv database name
$MythTVdbuser = "mythtv";       // mythtv database user
$MythTVdbpass = "mythtv";       // mythtv database password
$MythBackendIP = $WebHostIP;   // Myth Backend server IP
$MythBackendPort = "6544";     // Myth Backend services port   

//EDIT-HERE: set to the number of upcoming to show in the Top Upcoming and Weather Forecaset display
$UpcomingListLimit = 5;     

//EDIT-HERE: set to the number of New Shows query rows to return
$NewShowsQueryLimit = 500;     

//EDIT-HERE: set to the type of Sports New-Shows to include.  Uncomment only the type you desire
//$NewSportsQueryType = 'Sports%';  //Note: this selection return everything! It is limited though by $NewShowsQueryLimit setting     
//$NewSportsQueryType = 'Sports talk';
//$NewSportsQueryType = 'Sports non-event';
$NewSportsQueryType = 'Sports event';

// EDITs are not normally needed below.  Note:  SD works for heterogenous households (for both HD and SD televisions)
$WebServer = "http://" . $WebHostIP . "/mythweb";
$MythRokuDir = "mythroku";
$localSvcDir = '';

$MythContentSvc = "http://" . $MythBackendIP . ":" . $MythBackendPort . "/Content/";
$MythDvrSvc = "http://" . $MythBackendIP . ":" . $MythBackendPort . "/Dvr/";
$localSvc = "$WebServer/$MythRokuDir/$localSvcDir/";

$RokuDisplayType = "SD";	// set to the same as your Roku player under display type, HD or SD  
$BitRate = "1500";			// bit rate of endcoded streams

$PWS=false;  //use local user stations for reporting  see http://www.wunderground.com/weather/api
$NWS=false;  //use wunderground N.W.S. data instead of its Best Forecast option
$RADIUS='50';  //default for radar map is 100. adjust this to zoom in or out.
$API_KEY='8d114d04cff24445';  //NOTE: wunderground limits use velocity so this may become obsolete without warning.

?>