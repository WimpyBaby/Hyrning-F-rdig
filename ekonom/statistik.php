<?php

session_start();
include "../connection.php";

if($_SESSION['staffLogin'] != true || ($_SESSION['staffLogin'] == true && $_SESSION['grupp'] != 'Ekonom')){
    header("location: ../Kundmottagning/index.php");
}

error_reporting(0);
ini_set('display_errors', 0);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
    <a href="home.php">Return</a>
    <a href="index.php">Logout</a>
    <div class="allusers">
        <h2 style="margin-top:3rem;" class="heading">New <span>Users</span></h2></br>
</div>
    <section class="container7">
    <div class="motUI2">
        <form class="newUser" method="post" action="">
            <div class="box">
                <p>Start Date</p>
                <input type="date" name="start">
            </div>
            <div class="box">
                <p>En Date</p>
                <input type="date" name="end">
            </div>
            <input type="submit" name="calculate" value="Calculate" class="button2">
        </form>
</div>

<h1 class="heading">Income</h1>

<div style="margin-top: 3rem;">
            <table class="car-data">
                <thead>
                    <tr>
                        <th>Sum</th>
                        <th>Average</th>
                        <th>Rented cars</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_POST['calculate'])){
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $incomesql = "SELECT SUM(`Kostnad`) as summa, CAST(avg(`Kostnad`) AS decimal(38,0)) as medel, COUNT(*) AS antal
                        FROM hyr WHERE indatum BETWEEN '$start' AND '$end'";
                        $res = mysqli_query($conn, $incomesql);
                        $kostander = mysqli_fetch_assoc($res);
                        if($kostander){
                            echo '<tr>
                                    <td>'.$kostander['summa'].'</td>
                                    <td>'.$kostander['medel'].'</td>
                                    <td>'.$kostander['antal'].'</td>
                                </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div style="margin-top: 3rem;">
            <h1 class="heading">Income per car</h1>
            <table class="car-data">
                <thead>
                    <tr>
                        <th>Regnr</th>
                        <th>Sum</th>
                        <th>Average</th>
                        <th>Rented cars</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_POST['calculate'])){
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $costsArr = array();
                        $everyCar = "SELECT Regnr, SUM(`Kostnad`) as summa, CAST(avg(`Kostnad`) AS decimal(38,0)) as medel, COUNT(*) AS antal FROM hyr WHERE indatum BETWEEN '$start' AND '$end' GROUP BY `Regnr`";
                        $result = mysqli_query($conn, $everyCar);
                        while($cost = mysqli_fetch_assoc($result)){
                            // $costsArr[] = $cost['summa'];
                            $costsArr[] = array('reg'=>$cost['Regnr'], 'sum'=>$cost['summa']);
                            echo '<tr>
                                    <td>'.$cost['Regnr'].'</td>
                                    <td>'.$cost['summa'].'</td>
                                    <td>'.$cost['medel'].'</td>
                                    <td>'.$cost['antal'].'</td>
                                </tr>';
                            $json1[] = $cost['Regnr'];
                            $json2[] = $cost['summa'];
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    </head>
<body>

<?php

include "../connection.php";

// $sql = "SELECT * FROM hyr WHERE Indatum and Utdatum BETWEEN '$start' and '$end'";
// $result = mysqli_query($conn, $sql);
// while($row = mysqli_fetch_assoc($result))
// {
//     $json1[] = $row['Regnr'];
//     $json2[] = $row['Kostnad'];
// }

// echo json_encode($json1);
// echo json_encode($json2);
?>

<div class="diagram">
<h2>Revenue Between <?php echo $_POST['start'];?> and <?php echo $_POST['end'];?></h2>

<div class="chart">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>


<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($json1)?>,
        datasets: [{
            label: 'Revenue (kr)' ,
            data: <?php echo json_encode($json2)?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

<h2>Cars</h2>
</div>
</body>
</html>