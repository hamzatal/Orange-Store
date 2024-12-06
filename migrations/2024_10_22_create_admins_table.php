<?php class CreateAdminsTable
{

    public function up()
    {
        return "CREATE TABLE admins(
id INT AUTO_INCREMENT PRIMARY KEY ,
name VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
    }

    public function down()
    {
        $sql = "DROP TABLE admins";
        return $sql;
    }
}