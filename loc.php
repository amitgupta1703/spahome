<?php    
 
     function visitor_country()
     {
         $client  = $_SERVER['HTTP_CLIENT_IP'];
         $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
         $remote  = $_SERVER['REMOTE_ADDR'];
         $result  = "Unknown";
         if(filter_var($client, FILTER_VALIDATE_IP))
         {
             $ip = $client;
         }
         elseif(filter_var($forward, FILTER_VALIDATE_IP))
         {
             $ip = $forward;
         }
         else
         {
             $ip = $remote;
         }
         echo "ip: ";
         echo $ip;
         $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=47.8.62.225"));

         echo "ip add<br>";
         echo $ip_data->geoplugin_countryName."<br>";

         if($ip_data)
         {
             $result = array('continentCode' => $ip_data->geoplugin_continentCode,
                             'countryCode' => $ip_data->geoplugin_countryCode,
                             'countryName' => $ip_data->geoplugin_countryName,
                             );
         }
         return $result;
     }

     //echo visitor_country();
     $visitor_details = visitor_country(); // Output Country name [Ex: United States]
     echo $visitor_details['countryName'];
     
?>

<?php
     $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
     if ($query && $query['status'] == 'success') {
     echo 'Hey user from ' . $query['country'] . ', ' . $query['city'] . '!';
     }
     foreach ($query as $data) {
         echo $data . "<br>";
     }
     ?>

     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>Document</title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
         <script>
             $.getJSON("http://api.ipify.org/?format=json", function(e) {
                    alert(e.ip);
                });

         </script>
     </head>
   
        
<body onload="initialize()">
<div ng-controller="geoCtrl">
  <p ng-bind="ip"></p>
  <p ng-bind="hostname"></p>
  <p ng-bind="loc"></p>
  <p ng-bind="org"></p>
  <p ng-bind="city"></p>
  <p ng-bind="region"></p>
  <p ng-bind="country"></p>
  <p ng-bind="phone"></p>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.angularjs.org/1.2.12/angular.min.js"></script>
<script src="http://code.angularjs.org/1.2.12/angular-route.min.js"></script>
<script>
'use strict';
var geo = angular.module('geo', [])
.controller('geoCtrl', ['$scope', '$http', function($scope, $http) {
  $http.jsonp('http://ipinfo.io/?callback=JSON_CALLBACK')
    .success(function(data) {
    $scope.ip = data.ip;
    $scope.hostname = data.hostname;
    $scope.loc = data.loc; //Latitude and Longitude
    $scope.org = data.org; //organization
    $scope.city = data.city;
    $scope.region = data.region; //state
    $scope.country = data.country;
    $scope.phone = data.phone; //city area code
  });
}]);
</script>
</body>
</html>