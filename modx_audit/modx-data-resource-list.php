<?php
$dbConfig = include __DIR__.'/../script_config/db-config.php';

$host = $dbConfig['host'];
$db = $dbConfig['db'];
$user = $dbConfig['user'];
$pass = $dbConfig['pass'];

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    exit('Connection failed: '.$conn->connect_error);
}

$sqlCounts = '
    SELECT 
        SUM(CASE WHEN published = 1 THEN 1 ELSE 0 END) AS published_count,
        SUM(CASE WHEN published = 0 THEN 1 ELSE 0 END) AS unpublished_count
    FROM modx_site_content';
$resultCounts = $conn->query($sqlCounts);
if (!$resultCounts) {
    exit('Query failed: '.$conn->error);
}
$pageCounts = $resultCounts->fetch_assoc();

$sqlUsed = 'SELECT id FROM modx_site_content WHERE published = 1 ORDER BY id';
$resultUsed = $conn->query($sqlUsed);
$usedIds = [];
if ($resultUsed) {
    while ($row = $resultUsed->fetch_assoc()) {
        $usedIds[] = $row['id'];
    }
}

$sqlUnused = 'SELECT id FROM modx_site_content WHERE published = 0 ORDER BY id';
$resultUnused = $conn->query($sqlUnused);
$unusedIds = [];
if ($resultUnused) {
    while ($row = $resultUnused->fetch_assoc()) {
        $unusedIds[] = $row['id'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MODX Page and Content Blocks Report</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 2rem; }
        h1, h2 { margin-top: 2rem; }
        p, li, label { font-size: 1.1rem; }
        
        button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            background: #59c6e7;
            color: #fff;
            font-weight: 500;
            border-radius: 20px;
        }

        button:hover {
            background: #50b2cf;
        }

        #loading {
            display: none;
            margin-top: 1rem;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 1rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        select {
            width: 100%;
            max-width: 300px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
    <script>
        function showLoader() {
            document.getElementById('loading').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>MODX Report</h1>

    <h2>Page Counts</h2>
    <p><strong>Published Pages:</strong> <?php echo (int) $pageCounts['published_count']; ?></p>
    <p><strong>Unpublished Pages:</strong> <?php echo (int) $pageCounts['unpublished_count']; ?></p>

    <form method="get" onsubmit="showLoader()">
        <button type="submit">Refresh</button>
    </form>

    <div id="loading">
        <div class="spinner"></div>
        <p style="text-align: center;">Refreshing...</p>
    </div>

    <h2>Resource IDs</h2>

    <label for="used-resources"><strong>Used (Published) Resources:</strong></label><br>
    <select id="used-resources">
        <?php foreach ($usedIds as $id) { ?>
            <option value="<?php echo $id; ?>"><?php echo $id; ?></option>
        <?php } ?>
    </select>

    <br>

    <label for="unused-resources"><strong>Unused (Unpublished) Resources:</strong></label><br>
    <select id="unused-resources">
        <?php foreach ($unusedIds as $id) { ?>
            <option value="<?php echo $id; ?>"><?php echo $id; ?></option>
        <?php } ?>
    </select>
</body>
</html>
