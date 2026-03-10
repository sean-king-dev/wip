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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MODX Resource Field Finder</title>
        <style>
            html, body {
                font-family: Arial, Helvetica, sans-serif;
                padding: 20px;
            }

            .grid-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 12px;
                margin-top: 20px;
            }

            .grid-container p {
                padding: 5px;
                /* border: 1px solid #ccc; */
                background-color: #e8e8e8;
                margin: 0;
                text-align: center;
                border-radius: 4px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
                
            button {
                padding: .25rem .5rem;
                border: none;
                background: #59c6e7;
                color: #fff;
                border-radius: 4px;
            }

            button:hover {
                border: none;
                background: #50b2cf;
            }
    </style>
</head>
<body>
        <main>
        <h2>Resource/ Content Block Fields</h2>
    </main>
    <form method="get">
        <label for="id">Enter Resource ID:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">Check</button>
    </form>

<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $resourceId = (int) $_GET['id'];

    $result = $conn->query("SELECT content FROM modx_site_content WHERE id = $resourceId");
    if ($result && $result->num_rows > 0) {
        $content = $result->fetch_assoc()['content'];

        $fieldResult = $conn->query('SELECT id, name FROM modx_contentblocks_field');

        if ($fieldResult && $fieldResult->num_rows > 0) {
            echo "<h2>Fields found in resource $resourceId:</h2><div class='grid-container'>";
            $foundAny = false;
            while ($field = $fieldResult->fetch_assoc()) {
                if (strpos($content, (string) $field['id']) !== false) {
                    echo '<p>'.htmlspecialchars($field['name']).'</p>';
                    $foundAny = true;
                }
            }
            if (!$foundAny) {
                echo "(No content block fields found)\n";
            }
            echo '</div>';
        } else {
            echo '<p>No fields found in modx_contentblocks_field.</p>';
        }
    } else {
        echo "<p>No resource found with ID $resourceId.</p>";
    }
}

$conn->close();
?>

</body>
</html>
