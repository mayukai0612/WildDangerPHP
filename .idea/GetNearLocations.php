<?php


include_once("db_connect.php");
define(EARTH_RADIUS, 6371);//地球半径，平均半径为6371km


if (isset($_POST['latitude'])  && isset($_POST['longitude']) && isset($_POST['animalName'])
    && isset($_POST['distance'])&& isset($_POST['time']))
{
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    $aniamlName = $_POST['animalName'];
    $distancePara = $_POST['distance'];
    $time = $_POST['time'];

    $comparedString = "all";
        /**
         *计算某个经纬度的周围某段距离的正方形的四个点
         *
         *@param lng float 经度
         *@param lat float 纬度
         *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
         *@return array 正方形的四个点的经纬度坐标
         */

        function returnSquarePoint($lng, $lat,$distance = 10){


            $dlng =  2 * asin(sin($distance / (2 * EARTH_RADIUS)) / cos(deg2rad($lat)));
            $dlng = rad2deg($dlng);

            $dlat = $distance/EARTH_RADIUS;
            $dlat = rad2deg($dlat);

            return array(
                'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
                'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
                'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
                'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
            );
        }


//使用此函数计算得到结果后，带入sql查询
$squares = returnSquarePoint($lng, $lat,$distancePara);

    if(strcmp($aniamlName,$comparedString) == 0 && strcmp($time,$comparedString) == 0) {
        $info_sql = "select VernacularName,Latitude,Longitude,EventDate from Animals where 
Latitude <> 0 and
Latitude>{$squares['right-bottom']['lat']} and
Latitude<{$squares['left-top']['lat']} and
Longitude>{$squares['left-top']['lng']} and
Longitude<{$squares['right-bottom']['lng']} ";
    }
    else if (strcmp($aniamlName,$comparedString) == 0 && strcmp($time,$comparedString) != 0)
    {
        $intOfTime = (int)$time;
        $info_sql = "select VernacularName,Latitude,Longitude,EventDate from Animals where 
Latitude <> 0 and
eventYear >= '$intOfTime' and 
Latitude>{$squares['right-bottom']['lat']} and
Latitude<{$squares['left-top']['lat']} and
Longitude>{$squares['left-top']['lng']} and
Longitude<{$squares['right-bottom']['lng']} ";
    }
    else if($aniamlName != "all" && strcmp($time,$comparedString) == 0)
    {
        $info_sql = "select VernacularName,Latitude,Longitude,EventDate from Animals where Latitude <> 0 and
 VernacularName LIKE '%$aniamlName%' and
Latitude>{$squares['right-bottom']['lat']} and
Latitude<{$squares['left-top']['lat']} and
Longitude>{$squares['left-top']['lng']} and
Longitude<{$squares['right-bottom']['lng']} ";

    }
    else if($aniamlName != "all" && strcmp($time,$comparedString) != 0)
    {
        $intOfTime = (int)$time;
        $info_sql = "select VernacularName,Latitude,Longitude,EventDate from Animals where Latitude <> 0 and
eventYear >= '$intOfTime' and 
 VernacularName LIKE '%$aniamlName%' and
Latitude>{$squares['right-bottom']['lat']} and
Latitude<{$squares['left-top']['lat']} and
Longitude>{$squares['left-top']['lng']} and
Longitude<{$squares['right-bottom']['lng']} ";


    }


        $result = mysqli_query($conn,$info_sql);

    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;

    }

    echo json_encode($rows);


    $conn->close();
}
?>



