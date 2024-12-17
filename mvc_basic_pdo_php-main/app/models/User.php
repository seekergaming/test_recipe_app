<?php
namespace App\Models;

use App\Core\Model;
use Exception;

class User extends Model
{
    public function all() 
    {
        $stmt = $this->getConnection()->query("SELECT * FROM users"); // Use query() for SELECT statements
        return $stmt->fetchAll(); // Use fetchAll() to get all records
    }

    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT); // Use bindParam() to bind variables
        $stmt->execute(); // Use execute() to run the query
        return $stmt->fetch(); // Use fetch() to get a single record
    }

    public function create($data)
    {
        $stmt = $this->getConnection()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)"); // Use prepare() for SQL statements with variables
        $stmt->execute([ // Use execute() to run the query
            ':name' => $data['name'], // Use named placeholders to prevent SQL injection
            ':email' => $data['email'], // Use named placeholders to prevent SQL injection
        ]);
        return $stmt; // Return the PDOStatement object
    }

    public function update($id, $data)
    {
        $stmt = $this->getConnection()->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->execute([ // Use execute() to run the query
            ':name' => $data['name'], // Use named placeholders to prevent SQL injection
            ':email' => $data['email'], // Use named placeholders to prevent SQL injection
            ':id' => $id, // Use named placeholders to prevent SQL injection
        ]);
        return $stmt; // Return the PDOStatement object
    }

    public function delete($id)
    {
        $stmt = $this->getConnection()->prepare("DELETE FROM users WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT); // Use bindParam() to bind variables
        $stmt->execute(); // Use execute() to run the query
        return $stmt; // Return the PDOStatement object
    }

    public function checkLogin($data)
{
    $stmt = $this->getConnection()->prepare("SELECT * FROM accounts WHERE username = :name");
    $stmt->execute([':name' => $data['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($data['password'], $user['password'])) {
        return $user; // Return the user if credentials are correct
    }
    return false; // Return false if credentials are incorrect
}

public function register($data)
{
    $stmt = $this->getConnection()->prepare("INSERT INTO accounts (username, email, password) VALUES (:name, :email, :password)");
    $stmt->execute([
        ':name' => $data['username'],
        ':email' => $data['email'],
        ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
    ]);
    return $stmt;
}

public function loan($data){

    if (!isset($data['payslip_file']) || !isset($data['bank_statement_file'])) {
        throw new Exception("Files are missing. Please upload required documents.");
    }

    // Define target directory
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Create 'uploads' folder if it doesn't exist
    }

    // File paths
    $payslipFile = $data['payslip_file'];
    $bankStatementFile = $data['bank_statement_file'];

    $payslipFilePath = $targetDir . basename($payslipFile['name']);
    $bankStatementFilePath = $targetDir . basename($bankStatementFile['name']);

    // Move uploaded files to target directory
    if (!move_uploaded_file($payslipFile['tmp_name'], $payslipFilePath)) {
        throw new Exception("Error uploading Payslip file.");
    }
    if (!move_uploaded_file($bankStatementFile['tmp_name'], $bankStatementFilePath)) {
        throw new Exception("Error uploading Bank Statement file.");
    }

    //statement prep and execution
    $stmt = $this->getConnection()->prepare(
        "INSERT INTO loan_applications (name, ic_number, email, phone_number, postcode, address, loan_type, loan_amount, loan_duration, payslip_file, bank_statement_file) VALUES (:name, :ic_number, :email, :phone_number, :postcode, :address, :loan_type, :loan_amount, :loan_duration, :payslip_file, :bank_statement_file)"
    );

    $stmt->execute([
        ':name' => $data['name'],
        ':ic_number' => $data['ic_number'],
        ':email' => $data['email'],
        ':phone_number' => $data['phone_number'],
        ':postcode' => $data['postcode'],
        ':address' => $data['address'],
        ':loan_type' => $data['loan_type'],
        ':loan_amount' => $data['loan_amount'],
        ':loan_duration' => $data['loan_duration'],
        ':payslip_file' => $payslipFilePath,
        ':bank_statement_file' => $bankStatementFilePath,
    ]);

    return $stmt;
}

}


