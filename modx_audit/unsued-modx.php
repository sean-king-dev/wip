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

$sqlUnusedFields = "
    SELECT cbf.*
    FROM modx_contentblocks_field cbf
    LEFT JOIN modx_site_content sc
        ON sc.content LIKE CONCAT('%', cbf.id, '%')
    WHERE sc.id IS NULL";
$unusedFieldsResult = $conn->query($sqlUnusedFields);
$unusedFields = [];
if ($unusedFieldsResult && $unusedFieldsResult->num_rows > 0) {
    while ($row = $unusedFieldsResult->fetch_assoc()) {
        $unusedFields[] = $row;
    }
}

$sqlUnusedLayouts = "
    SELECT cbl.*
    FROM modx_contentblocks_layout cbl
    LEFT JOIN modx_site_content sc
        ON sc.content LIKE CONCAT('%', cbl.id, '%')
    WHERE sc.id IS NULL";
$unusedLayoutsResult = $conn->query($sqlUnusedLayouts);
$unusedLayouts = [];
if ($unusedLayoutsResult && $unusedLayoutsResult->num_rows > 0) {
    while ($row = $unusedLayoutsResult->fetch_assoc()) {
        $unusedLayouts[] = $row;
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
        h2 { margin-top: 2rem; }
        p, li { font-size: 1.1rem; }
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
            border: none;
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

        ul { padding-left: 1.5rem; }
        .empty { color: gray; font-style: italic; }
    </style>
    <script>
        function showLoader() {
            document.getElementById('loading').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Unused Modx</h1>

    <h2>Unused Content Block Fields</h2>
    <?php if (count($unusedFields) === 0) { ?>
        <p class="empty">No unused fields found.</p>
    <?php } else { ?>
        <ul>
            <?php foreach ($unusedFields as $field) { ?>
                <li><?php echo htmlspecialchars($field['name'] ?? 'Unnamed Field'); ?> (ID: <?php echo $field['id']; ?>)</li>
            <?php } ?>
        </ul>
    <?php } ?>

    <h2>Unused Content Block Layouts</h2>
    <?php if (count($unusedLayouts) === 0) { ?>
        <p class="empty">No unused layouts found.</p>
    <?php } else { ?>
        <ul>
            <?php foreach ($unusedLayouts as $layout) { ?>
                <li><?php echo htmlspecialchars($layout['name'] ?? 'Unnamed Layout'); ?> (ID: <?php echo $layout['id']; ?>)</li>
            <?php } ?>
        </ul>
    <?php } ?>

        <form method="get" onsubmit="showLoader()">
        <button type="submit">Refresh</button>
    </form>

    <div id="loading">
        <div class="spinner"></div>
        <p style="text-align: center;">Refreshing...</p>
    </div>
</body>
</html>
