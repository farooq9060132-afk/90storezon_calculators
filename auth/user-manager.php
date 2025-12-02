<?php
// Simple file-based user management system

class UserManager {
    private $usersFile;
    private $tokensFile;
    
    public function __construct() {
        $this->usersFile = __DIR__ . '/../data/users.json';
        $this->tokensFile = __DIR__ . '/../data/tokens.json';
        
        // Create data directory if it doesn't exist
        $dataDir = __DIR__ . '/../data';
        if (!file_exists($dataDir)) {
            mkdir($dataDir, 0777, true);
        }
        
        // Create users file if it doesn't exist
        if (!file_exists($this->usersFile)) {
            file_put_contents($this->usersFile, json_encode([]));
            chmod($this->usersFile, 0666); // Ensure file is writable
        }
        
        // Create tokens file if it doesn't exist
        if (!file_exists($this->tokensFile)) {
            file_put_contents($this->tokensFile, json_encode([]));
            chmod($this->tokensFile, 0666); // Ensure file is writable
        }
    }
    
    public function getUserByEmail($email) {
        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if (isset($user['email']) && $user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }
    
    public function getUserById($id) {
        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if (isset($user['id']) && $user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }
    
    public function emailExists($email) {
        return $this->getUserByEmail($email) !== null;
    }
    
    public function createUser($name, $email, $password, $newsletter = false) {
        $users = $this->getAllUsers();
        
        // Check if email already exists
        if ($this->emailExists($email)) {
            return false;
        }
        
        // Create new user
        $userId = uniqid();
        $newUser = [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'newsletter' => $newsletter,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $users[] = $newUser;
        
        // Save users to file
        $result = file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
        if ($result !== false) {
            return $newUser;
        }
        
        return false;
    }
    
    public function verifyUserCredentials($email, $password) {
        $user = $this->getUserByEmail($email);
        
        if ($user && isset($user['password_hash']) && password_verify($password, $user['password_hash'])) {
            // Remove password hash from returned user data
            unset($user['password_hash']);
            return $user;
        }
        
        return false;
    }
    
    public function storeRememberToken($userId, $token, $expiry) {
        $tokens = $this->getAllTokens();
        
        $tokens[$token] = [
            'user_id' => $userId,
            'expiry' => $expiry
        ];
        
        return file_put_contents($this->tokensFile, json_encode($tokens, JSON_PRETTY_PRINT));
    }
    
    public function getRememberToken($token) {
        $tokens = $this->getAllTokens();
        return isset($tokens[$token]) ? $tokens[$token] : null;
    }
    
    private function getAllUsers() {
        if (!file_exists($this->usersFile)) {
            return [];
        }
        
        $content = file_get_contents($this->usersFile);
        if ($content === false) {
            return [];
        }
        
        $users = json_decode($content, true);
        
        return is_array($users) ? $users : [];
    }
    
    private function getAllTokens() {
        if (!file_exists($this->tokensFile)) {
            return [];
        }
        
        $content = file_get_contents($this->tokensFile);
        if ($content === false) {
            return [];
        }
        
        $tokens = json_decode($content, true);
        
        return is_array($tokens) ? $tokens : [];
    }
}
?>