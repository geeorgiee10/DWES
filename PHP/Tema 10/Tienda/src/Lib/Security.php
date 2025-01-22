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

    final public static function validaToken($token): bool {
        try {
            // Decodificar el token con la clave secreta y el algoritmo HS256
            $info = JWT::decode($token, new Key(Security::secretKey(), 'HS256'));
    
            $id = $info->data->id; 
            $exp = $info->exp;     
            $email = $info->data->mail; 
    
            
            if ($exp < time()) {
                return false; 
            }
    
            return true;
    
        } catch (Exception $e) {
            return false;
        }
    }

}