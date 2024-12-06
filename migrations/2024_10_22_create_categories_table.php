<?php

class CreateCategoriesTable
{
    public function up()
    {
        return "CREATE TABLE categories(
        id INT AUTO_INCREMENT PRIMARY KEY ,
        name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    }

    public function down()
    {
        $sql = "DROP TABLE categories";
        return $sql;
    }
}
