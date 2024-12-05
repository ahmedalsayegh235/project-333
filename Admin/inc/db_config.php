<?php
$dsn = "mysql:host=localhost;dbname=Roomyweb";
$dbusername= "root";
$dbpassword = "";
try{
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException)
{
echo "Connection failed: " . $e->getMessage();
}
function filteration($data)
{
    foreach($data as $key => $value)
    {
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);

    }
    return $data;
}
function select($sql,$values,$datatypes)
{
    $con= $GLOBALS['pdo'];
    try {
        // Prepare the SQL statement
        $stmt = $con->prepare($sql);

        // Dynamically bind values to the placeholders in the query
        foreach ($values as $index => $value) {
            // Bind values with appropriate data types (1-based indexing for PDO)
            $stmt->bindValue($index + 1, $value, $datatypes[$index]);
        }

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Fetch all results as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            die("Query execution failed.");
        }
    } catch (PDOException $e) {
        // Handle query errors
        die("Error executing query: " . $e->getMessage());
    }
}
