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

$searchTerm = isset($_GET['query']) ? trim($_GET['query']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search ContentBlock Text in MODX Resources</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 2rem; }
        input, button {
            padding: .5rem;
            font-size: 1rem;
            margin-right: .5rem;
        }
        .result { 
            margin-top: 2rem;
            display: grid;
            /* width: 25%; */
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem; /* space between grid items */ 
        }
        .resource {
            padding: .5rem;
            background: #f0f0f0;
            margin-bottom: .5rem;
            border-radius: 4px;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            /* width: 100%; */
        }
    </style>
</head>
<body>
    <h2>MODX ContentBlock Resource Search</h2>

    <form method="get">
        <label for="query">Enter content block key word to search:</label>
        <input type="text" name="query" id="query" value="<?php echo htmlspecialchars($searchTerm); ?>" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($searchTerm) { ?>
          <h2>Resources containing all words in "<?php echo htmlspecialchars($searchTerm); ?>"</h2>
        <div class="result">
          

            <?php
            $words = preg_split('/\s+/', $searchTerm);

        $sql = 'SELECT id, pagetitle FROM modx_site_content WHERE ';
        $params = [];
        $types = '';
        $likes = [];

        foreach ($words as $word) {
            $likes[] = 'content LIKE ?';
            $params[] = '%'.$word.'%';
            $types .= 's';
        }

        $sql .= implode(' AND ', $likes);

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo '<p>Failed to prepare statement: '.htmlspecialchars($conn->error).'</p>';
        } else {
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='resource'><strong>ID:</strong> {$row['id']} &nbsp;&nbsp; <strong>Title:</strong> ".htmlspecialchars($row['pagetitle']).'</div>';
                }
            } else {
                echo '<p>No resources found with all those words in content.</p>';
            }

            $stmt->close();
        }
        ?>
        </div>
    <?php } ?>

</body>
</html>

<?php $conn->close(); ?>
