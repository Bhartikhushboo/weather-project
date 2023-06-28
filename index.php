<?php
$error="";
$city="delhi";
        $apiKey = "3529d77c91c5bfc167e8ab66aabee52b";
        $googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$apiKey."&units=metric";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        $currentTime = time();
if(isset($_GET['searchbutton'])){
  $city=$_GET['searchcity'];
  $apiKey = "3529d77c91c5bfc167e8ab66aabee52b";
  if(empty($city)){
    // $error="search city ";
  }else{
    $googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$apiKey."&units=metric";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $dataa = json_decode($response);
        $currentTime = time();
        if($dataa->cod=='404'){
            $error="searched city not found";
        }else{
            $data=$dataa;
        }
   }
        
}


   


?>
<!doctype html>
<html>
<head>
<title>Forecast Weather using OpenWeatherMap with PHP</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="report-container">
        <form action="index.php" method="GET">
            @csrf
        <input type="text" placeholder="enter city" name="searchcity" class="searchcity">
        <input type="submit" value="check weather" name="searchbutton" class="searchbutton">
        <br><p class="error"><?php echo $error;?></p>
        </form>
        <h2> <?php echo $data->name.",". $data->sys->country; ?></h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div><br>
           
        </div>
        <div class="weather-forecast">
            <img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"class="weather-icon" /> 
            <div class="weather-desc"><?php echo $data->weather[0]->main."<br>".$data->weather[0]->description; ?></div>
            <p class="temp"><?php echo $data->main->temp."°C"; ?></p>  
        </div><br>
        <div id="wnd">
            <div> <img src="images/humidity.png" alt="" class="icon"> <img src="images/wind.png" alt="" class="icon-left"></div>
            <div>  <p>Humidity: <?php echo $data->main->humidity."%"; ?> <span class="right"> Wind:  <?php echo $data->wind->speed."km/h"; ?></span></div>
        </div>
    </div>
</body>
</html>