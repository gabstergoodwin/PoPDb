<!DOCTYPE html>
<html>

<head>
    <!-- HTML style -->
    <style>
        body {background-color: #fffef2; 
	font: Arial, sans-serif;}
        h1   {color: #5ba300;  
	font: Arial, sans-serif;}
        p    {color: black;  
	font: Arial, sans-serif;}
    </style>
    <title>PoPDb</title>
</head>

<body>
    <!-- Website Style -->
    <h1 class="title">Welcome to PoPDb! </h1>

    <!-- Enter plantID to query -->

    <form method="post" action="<?php
echo $_SERVER['PHP_SELF'];
?>">

        Enter Plant ID Number: <input type="text" name="plants">
        <input type="submit">
    </form>

   <!-- table of PlantIDs and Names -->
    <table>
        <tbody>
            <tr>
                <td>&nbsp;<strong>Plant Name</strong></td>
                <td>&nbsp;<strong>PlantID</strong></td>
            </tr>
            <tr>
                <td>&nbsp;Arrowgrass</td>
                <td>&nbsp;10</td>
            </tr>
            <tr>
                <td>&nbsp;Deathcamas</td>
                <td>&nbsp;11</td>
            </tr>
            <tr>
                <td>&nbsp;Dwarf Milkweed</td>
                <td>&nbsp;12</td>
            </tr>
            <tr>
                <td>&nbsp;Lambert Crazyweed</td>
                <td>&nbsp;13</td>
            </tr>
            <tr>
                <td>&nbsp;Larkspurs</td>
                <td>&nbsp;14</td>
            </tr>
            <tr>
                <td>&nbsp;Nebraska Lupine</td>
                <td>&nbsp;15</td>
            </tr>
            <tr>
                <td>&nbsp;Nightshades</td>
                <td>&nbsp;16</td>
            </tr>
            <tr>
                <td>&nbsp;Poison Hemlock</td>
                <td>&nbsp;17</td>
            </tr>
            <tr>
                <td>&nbsp;Riddell Groundsel</td>
                <td>&nbsp;18</td>
            </tr>
            <tr>
                <td>&nbsp;Showy Milkweed</td>
                <td>&nbsp;19</td>
            </tr>
            <tr>
                <td>Water Hemlock</td>
                <td>&nbsp;20</td>
            </tr>
            <tr>
                <td>&nbsp;Chokecherry</td>
                <td>&nbsp;21</td>
            </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>

    <?php

    
    /* Connect to Database */
    
    $server   = "localhost";
    $username = "ggoodwin";
    $password = "";
    $database = "ggoodwin";
    
    $connect = mysqli_connect($server, $username, "", $database);
    
    if ($connect->connect_error) {
        echo "Something has gone terribly wrong";
        echo "Connection error:" . $connect->connect_error;
    } else {
        echo "<br>Let's look at some plants!<br>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $plant = $_POST['plants'];
        echo "<br>";
    
    /* Run Queries */
    
    if (!empty($plant)) {

    /* query PlantOverview */

        $queryPlantOverview = "SELECT PlantSpecies FROM PlantOverview WHERE PlantID = \"". $plant . "\"";
        
        $resultPlantOverview = $connect->query($queryPlantOverview);

        if ($resultPlantOverview ->num_rows > 0) {
            while ($row = $resultPlantOverview->fetch_assoc()) {
                echo "PLANTID: " . $row["PlantSpecies"]. "<br>";
            }
        } else {
            echo "No results";
        }
	
    /* query ExposureProtocol */

	$queryExposureProtocol = "SELECT Eyes, Respiratory, Skin, Ingestion FROM ExposureProtocol WHERE PlantID = \"" . $plant . "\"";

	$resultExposureProtocol = $connect->query($queryExposureProtocol);

	if ($resultExposureProtocol ->num_rows > 0) {
            while ($row = $resultExposureProtocol->fetch_assoc()) {
                echo "<br>EXPOSURE PROTOCOL: <br>Eyes: " . $row["Eyes"]. "<br> Respiratory: " . $row["Respiratory"]. "<br> Skin: " . $row["Skin"]. "<br> Ingestion: " . $row["Ingestion"]. "<br>";
            }
        } else {
            echo "No results";
        }

    /* query AreaFound */

	$queryAreaFoundStatewide = "SELECT Statewide, Central, East, West 
            FROM AreaFound WHERE PlantID = \"" . $plant . "\"";

	$resultAreaFoundStatewide = $connect->query($queryAreaFoundStatewide);

	if ($resultAreaFoundStatewide ->num_rows > 0) {
            while ($row = $resultAreaFoundStatewide->fetch_assoc()) {
                echo "<br>AREA FOUND (1 = found there, 0 = not found there): <br>Statewide:" . $row["Statewide"]. "<br>Central: " . $row["Central"]. "<br>East: " . $row["East"]. "<br>West: " . $row["West"]. "<br>";
            }
        } else {
            echo "No results";
        }
	
    /* query PoisonousCompound */

	$queryPoisonousCompound = "SELECT HydrocyanicAcid, ToxicAlkaloids, Locoine, Glycosides, Resinoids, Cicutoxin
            FROM PoisonousCompound WHERE PlantID = \"" . $plant . "\"";

	$resultPoisonousCompound = $connect->query($queryPoisonousCompound);

	if ($resultPoisonousCompound ->num_rows > 0) {
            while ($row = $resultPoisonousCompound->fetch_assoc()) {
                echo "<br>POISONOUS COMPOUND (1 = contains compound, 0 = does NOT contain compound): <br>Hydrocyanic Acid: " . $row["HydrocyanicAcid"]. "<br>Toxic Alkaloids: " . $row["ToxicAlkaloids"]. "<br>Locoine: " . $row["Locoine"]. "<br>Glycosides: " . $row["Glycosides"]. "<br>Resinoids: " . $row["Resinoids"]. "<br>Cicutoxin: " . $row["Cicutoxin"]. "<br>";
            }
        } else {
            echo "No results";
        }

    /* query Ecosystem */

	$queryEcosystem = "SELECT WetMeadows, DryMeadows, Marshes, Streams, Grassland, Fens, Bogs, Forest, Sand, Roadsides
            FROM Ecosystem WHERE PlantID = \"" . $plant . "\"";

	$resultEcosystem = $connect->query($queryEcosystem);

	if ($resultEcosystem ->num_rows > 0) {
            while ($row = $resultEcosystem->fetch_assoc()) {
                echo "<br>ECOSYSTEMS FOUND (1 = can grow there, 0 = can NOT grow there): <br>Wet Meadows: " . $row["WetMeadows"]. "<br>Dry Meadows: " . $row["DryMeadows"]. "<br>Marshes: " . $row["Marshes"]. "<br>Streams: " . $row["Streams"]. "<br>Grassland: " . $row["Grassland"]. "<br>Fens: " . $row["Fens"]. "<br>Bogs: " . $row["Bogs"]. "<br>Forest: " . $row["Forest"]. "<br>Sand: " . $row["Sand"]. "<br>Roadsides: " . $row["Roadsides"]. "<br>";
            }
        } else {
            echo "No results";
        }
	
    /* query ExposureDangerous */

	$queryExposureDangerous = "SELECT EyeContact, Respiratory, SkinContact, Ingestion FROM ExposureDangerous WHERE PlantID = \"" . $plant . "\"";

	$resultExposureDangerous = $connect->query($queryExposureDangerous);

	if ($resultExposureDangerous ->num_rows > 0) {
            while ($row = $resultExposureDangerous->fetch_assoc()) {
                echo "<br>EXPOSURE DANGEROUS (1 = not dangerous, 2 = sligntly dangerous, 3 = moderately dangerous, 4 = highly dangerous): <br>Eyes: " . $row["EyeContact"]. "<br> Respiratory: " . $row["Respiratory"]. "<br> Skin Contact: " . $row["SkinContact"]. "<br> Ingestion: " . $row["Ingestion"]. "<br>";
            }
        } else {

    /* If user inputs anything other than a plantID */

            echo "No results";
        }


    } else {
        echo "Hi, Thanks for visiting!";
    }
    
} /* Ending bracket for POST*/

mysqli_close($connect);
?>
</body>

</html>