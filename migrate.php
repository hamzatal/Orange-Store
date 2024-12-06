<?php

require 'database.php';

$db = new Database();

$pdo = $db->getConnection();

$executedMigrations = $pdo->query("SELECT * FROM migrations")->fetchAll(PDO::FETCH_ASSOC);
$migrationFiles = scandir(__DIR__ . '/migrations');

$batch = (int) $pdo->query("SELECT MAX(batch)FROM migrations")->fetchColumn() + 1;

foreach ($migrationFiles as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }
    $className = convertToClassName(pathinfo($file, PATHINFO_FILENAME));

    if (!in_array($className, array_column($executedMigrations, 'migration'))) {
        require __DIR__ . '/migrations/' . $file;
        $migrations = new $className();
        var_dump($migrations);

        $pdo->exec($migrations->up());
        $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (:migration, :batch)");
        $stmt->bindParam(':migration', $className); // Bind the migration class name
        $stmt->bindParam(':batch', $batch);         // Bind the batch number
        $stmt->execute();

        echo "migration $className has been executed successfully";
    }
}


function convertToClassName($file)
{
    $fileNameWithoutDate = preg_replace('/^\d{4}_\d{2}_\d{2}_/', '', $file);
    $parts = explode('_', $fileNameWithoutDate);
    $className = '';
    foreach ($parts as $part) {
        $className .= ucfirst($part);
    }
    return $className;
}
