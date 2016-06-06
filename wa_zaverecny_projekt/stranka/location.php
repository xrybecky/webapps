<?php
session_start();
include 'config.php';

try {
    $connect = new PDO("mysql:host={$server}; dbname={$db}; charset=UTF8", $user, $pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExpception $e){
    echo $e->getMessage();
}


$query = $connect->prepare("SELECT DISTINCT country FROM location");
$query->execute();

$query->setFetchMode(PDO::FETCH_OBJ);

$array = array();

while($zaznam = $query->fetch()){
    $query1 = $connect->prepare("SELECT COUNT(country) as pocet FROM location WHERE country = :country");
    $query1->bindParam(":country", $zaznam->country);
    $query1->execute();
    $query1->setFetchMode(PDO::FETCH_OBJ);
    
    while($zaznam1 = $query1->fetch()){

        $array1 = array(
            'stat' => $zaznam->country,
            'pocet' => $zaznam1->pocet
        );
//        array_push($array, array($zaznam->country, $zaznam1->pocet));
        array_push($array, (object) $array1);
    }
}

$query = $connect->prepare("SELECT city, latitude, longitude FROM location");
$query->execute();

$query->setFetchMode(PDO::FETCH_OBJ);

$array1 = array();
while($zaznam2 = $query->fetch()){
    array_push($array1, array($zaznam2->city, (double) $zaznam2->latitude, (double) $zaznam2->longitude));
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Aktuality</title>
    <meta charset="UTF-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
    <link rel="stylesheet" href="css/style-menu.css">
    <link rel="stylesheet" href="css/style.css">
    <script>
        $(document).ready(function(){
           
            
            $(function () {
   var chart = new Highcharts.Chart({
        chart: {
            type: 'column',
            renderTo: 'container'
        },
        title: {
            text: 'Návštevnosť stránky podľa štátov'
        },
        
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Počet ľudí'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Počet ľudí: <b>{point.y}</b>'
        },
        series: [{
            name: 'Population',
            data: (function () {
                            // generate an array of random data
                            var obj = <?php echo json_encode($array); ?>;
                            var data = [];
                                
                            for (var n = 0; n < obj.length; n++) {

                                data.push([
                                    obj[n].stat,
                                    parseInt(obj[n].pocet)
                                ]);
                            }
                            return data;
                        }()),
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
        });
    </script>
    <style>
    #map {
            height: 60%;
            width: 80%;
        top: 10px;
        }
        #wrapper {
            width: 50%;
            margin-top: 100px;
            
            
        }
    </style>
</head>
<body class="inner">
    <?php include 'menu.php'; ?>
    <div id="wrapper" class="center-block">
        <div id="container" style="height: 400px; margin: 0 auto"></div>
    </div>

    <div id="map" class="center-block"></div>
<script>

    // The following example creates complex markers to indicate beaches near
    // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
    // to the base of the flagpole.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: -33.9, lng: 151.2}
        });

        setMarkers(map, <?php echo json_encode($array1);?>)
    }



    function setMarkers(map, beaches) {
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < beaches.length; i++) {
            var beach = beaches[i];
            var marker = new google.maps.Marker({
                position: {lat: beach[1], lng: beach[2]},
                map: map,
                title: beach[0],
                zIndex: beach[3]
            });


            bounds.extend(marker.position);


//now fit the map to the newly inclusive bounds
            map.fitBounds(bounds);

//(optional) restore the zoom level after the map is done scaling
            var listener = google.maps.event.addListener(map, "idle", function () {
                map.setZoom(3);
                google.maps.event.removeListener(listener);
            });
        }


    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDA5o6hEGQjmvJkG-CPU5qbSJ-8wmKr4uI&callback=initMap"
        async defer></script>
</body>
<html>