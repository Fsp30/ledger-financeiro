<?php
namespace App\Domain\Accounts;

class AccountService
{
    public function __construct(private \PDO $db) {}

    public function createAccountRequest(array $requestData): array
    {
        $username = trim($requestData['username'] ?? '');
        $email = filter_var(trim($requestData['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $password = trim($requestData['password'] ?? '');

        if (empty($username) || empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email format.'];
        }
        if (strlen($password) < 8) {
            return ['success' => false, 'message' => 'Password must be at least 8 characters long.'];
        }

        try {
            $checkStmt = $this->db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
            $checkStmt->execute([':email' => $email]);
            if ($checkStmt->fetch()) {
                return ['success' => false, 'message' => 'This email is already in use.'];
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertStmt = $this->db->prepare("
                INSERT INTO users (username, email, password, created_at)
                VALUES (:username, :email, :password, NOW())
            ");
            $success = $insertStmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword,
            ]);

            return [
                'success' => $success,
                'message' => $success ? 'Account created successfully!' : 'Error registering user.'
            ];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Internal server error.'];
        }
    }
}