<?php
// For this application, we will use openweathermap. Get your key !
$apiKey = "YOUR KEY";
$cityId = "2988507"; // ID for Paris, France
$cityName = "Paris";

// U can use research with Id, i prefer use with Name!
// $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

// we will use cityName from now
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityName . "&lang=en&units=metric&appid=" . $apiKey;


// Initialize curl.
$ch = curl_init();

// using curl, documentation here : https://www.php.net/manual/en/function.curl-setopt.php
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);

// our data are in json, we have to decode our response
$data = json_decode($response);
$currentTime = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon application météo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
    <h1>Welcome to weatherAPP !</h1>
    <table class="table">
        <h2>You are in : <?php echo $data->name; ?></h2>
        <thead>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Weather</th>
            <th scope="col">Temperature</th>
            <th scope="col">Humidity</th>
            <th scope="col">Wind Speed</th>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?php echo date("jS F, Y", $currentTime); ?></td>
                <td scope="row"><?php echo date("l g:i a", $currentTime); ?></td>
                <td scope="row"><?php echo ucwords($data->weather[0]->description); ?> <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" /> </td>
                <td scope="row"> <?php echo $data->main->temp_min; ?>°C - <span class="max-temperature"> <?php echo $data->main->temp_max; ?>°C</span></td>
                <td scope="row"><?php echo $data->main->humidity; ?> %</td>
                <td scope="row"><?php echo $data->wind->speed; ?> km/h</td>
            </tr>
        </tbody>
    </table>
    <!-- our scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>