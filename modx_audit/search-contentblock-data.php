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

$name = isset($_GET['name']) ? trim($_GET['name']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MODX Content Block Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
        }
        form {
            margin-bottom: 2rem;
        }
        input[type="text"] {
            padding: 0.5rem;
            font-size: 1rem;
            width: 300px;
        }
        button {
            padding: .5rem;
            border: none;
            background: #59c6e7;
            font-size: 1rem;
            color: #fff;
            border-radius: 4px;
        }

        button:hover {
            border: none;
            background: #50b2cf;
        }
        .results {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1rem;
        }
        .block {
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .empty {
            font-style: italic;
            color: gray;
        }
    </style>
</head>
<body>

<h2>Search MODX Content Block</h2>
<p>Returns id of content block</p>

<form method="get">
    <label for="name">Field or Layout Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
    <button type="submit">Search</button>
</form>

<?php if ($name) { ?>
    <div class="results">
    <?php

        $stmt = $conn->prepare('SELECT id, name, description, category FROM modx_contentblocks_field WHERE name LIKE ?');
    $like = "%$name%";
    $stmt->bind_param('s', $like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='block'>";
            echo '<h3>Field: '.htmlspecialchars($row['name']).'</h3>';
            echo '<p><strong>ID:</strong> '.$row['id'].'</p>';
            echo '<p><strong>Category:</strong> '.htmlspecialchars($row['category']).'</p>';
            echo '<p><strong>Type:</strong> Field</p>';
            echo '</div>';
        }
    } else {
        echo "<p class='empty'>No matching fields found.</p>";
    }
    $stmt->close();

    $stmt = $conn->prepare('SELECT id, name, description FROM modx_contentblocks_layout WHERE name LIKE ?');
    $stmt->bind_param('s', $like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='block'>";
            echo '<h3>Layout: '.htmlspecialchars($row['name']).'</h3>';
            echo '<p><strong>ID:</strong> '.$row['id'].'</p>';
            echo '<p><strong>Type:</strong> Layout</p>';

            echo '</div>';
        }
    } else {
        echo "<p class='empty'>No matching layouts found.</p>";
    }
    $stmt->close();

    $conn->close();
    ?>
    </div>
<?php } ?>

</body>
</html>
