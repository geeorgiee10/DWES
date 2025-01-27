<?php 

namespace Lib;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class Security{


    final public static function encryptPassw(string $passw){
        return password_hash($passw, PASSWORD_BCRYPT, ['cost' => 10]);
    }

    final public static function validatePassw(string $passw, string $passwhash){
        return password_verify($passw, $passwhash);
    }

    final public static function secretKey():string{
        return $_ENV['SECRET_KEY'];
    }

    final public static function createToken(string $key, array $data):string{
        $time = strtotime("now");
        $token = array(
            "iat" => $time,
            "exp" => $time + 3600,
            "data" => $data
        );

        return JWT::encode($token, $key, 'HS256');
    }

    public function validaToken(string $token): ?object {
        try {
            return JWT::decode($token, new Key(self::secretKey(), 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }

    public function generateEmailToken(): array {
        $token = bin2hex(random_bytes(32));
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hours'));

        return [
            'token' => $token,
            'expiration' => $expiration
        ];
    }

}