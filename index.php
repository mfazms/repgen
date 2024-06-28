<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RepGen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php
        include 'function.php';
        include_once 'database.php';
    ?>
    
    <div class="mb-3" id='mynavbar'>
        <a class="" href="index.php">
            <h3>Report Generator</h3>
        </a>
        <a href="logout.php" class="btn btn-outline-danger" role="button" aria-disabled="false">LOGOUT</a>
    </div>
    
    <form method="POST" class="row g-3">
        <div class="input-group mb-3">
            <input type="text" id="query" name="query" class="form-control" placeholder="Insert your query here" aria-label="Insert your query here" aria-describedby="btn-exec">
            <input class="btn btn-primary" type="submit" value="Execute Query" id="btn-exec"></input>
        </div>
    </form>
        <?php
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $query = $_POST['query'];
                // echo "<p>INPUTTED QUERY: [$query]</p>";
                if("select" != strtolower(substr($query,0,6))){
                    echo "query not allowed";
                    die;
                }
                ExecuteQuery($conn,$query,$_SESSION['unpivoted'],$_SESSION['pivoted']);
                ParseQuery($query);
            }
            if($_SESSION['unpivoted'] && $_SESSION['pivoted']){
                ?>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Your submitted query</span>
                    <input type="text" readonly class="form-control" placeholder="<?php echo htmlspecialchars($_SESSION['submittedQuery']); ?>">
                </div>
                <div class="mb-3">
                <button type="button" class="btn btn-primary" onclick="toggleView()" id="btn-pivot">Pivot</button>
                <a href="groupby.php" class="btn btn-primary" role="button" aria-disabled="false">Group By</a>
                <a href="case.php" class="btn btn-primary" role="button" aria-disabled="false">Case</a>
                <button class="btn btn-primary" onclick="Export()">Export</button>
                </div>
                <?php
                table($_SESSION['unpivoted'],$_SESSION['pivoted']);
            }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="table2excel.js"></script>

</body>
</html>