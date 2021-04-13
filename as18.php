<?php
//test
//test2
//test3
main();

function main() {

    $apiCall = 'https://api.covid19api.com/summary';
    $json_string = curl_get_contents($apiCall);
    $obj = json_decode($json_string);

    $deaths_arr = Array();

    foreach($obj->Countries as $i){
        $deaths_arr[$i->Country] = $i->TotalDeaths;
    }

    arsort($deaths_arr);
    
    //echo html head section
    echo "<html>";
    echo "<head>";
    echo "<title>As18</title>";
    echo "<style>";
    echo "table {
            border-collapse:collapse;
            margin-left: auto; 
            margin-right: auto;
            }
            td,
            th {
            border:1px solid #4e95f4;
            text-align:center;
            padding:8px;
            }
            tr:nth-child(even) { background-color:#dae5f4;
            }
            tr:nth-child(odd) { background-color:#b8d1f3;
            }";
    echo "</style>";
    echo "</head>";

    // opening html section
	echo "<body>";
	
    //link to Github
    echo "<a target= '_blank' href ='https://github.com/turtlesmew/CIS355_AS18'>Github Repo</a> <br>";
    
    //Generates a JSON object from the array. The JSON object only contains those countries with the top 10 highest number of deaths
    $jsonStr=json_encode(array_slice($deaths_arr,0,10));
	$jsonObj = json_decode($jsonStr);
    //print_r($jsonObj);

    //creates the table
    echo "<div>";
    echo "<h4 style='text-align:center'>Top 10 Highest Covid19 Deaths</h4>";
    echo "<table>";
    echo "<tr>";
        echo "<th>Country Name</th>";
        echo "<th>Number of Deaths</th>";
        //populates the table with the jsonObj$jsonObj
        foreach($jsonObj as $country=>$deaths){
            echo "<tr>";
			echo "<td>{$country}</td>";
			echo "<td>{$deaths}</td>";
			echo "</tr>";   
        }
    // closing html section
    echo "</table>";
    echo "</div>";
	echo '</body>';
	echo '</html>';
}

function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>