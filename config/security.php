<?php

    class Security{

        private $passwordKey;
        private $msgKey;
        
        public function __construct(){
            $this->passwordKey = '$5$3$';
            $this->msgKey = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
        }
        
        //Encrypting Password
        public function encryptPassword($password){
            try{
                $newPassword = crypt($password, $this->passwordKey);
                return $newPassword;
            } catch(Exception $e){
                echo 'Error:' . $e->getMessage();
            }
        }

        // Encrypting URL Parameter
        public function encryptURLParam($urlParam){
            return urlencode(base64_encode($urlParam));
        }

        // Decrypting URL Parameter
        public function decryptURLParam($urlParam){
            return base64_decode(urldecode($urlParam));
        }

        // Encoding Message
        public function encodeMsg($data){
            $encryption_key = base64_decode($this->msgKey);
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
            return base64_encode($encrypted . '::' . $iv);
        }

        // Decoding Message
        public function decodeMsg($data){
            $encryption_key = base64_decode($this->msgKey);
            list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
            return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        }
            
    }

?>
