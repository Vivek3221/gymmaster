<?php

 namespace App\Controller\Component;
 
 use Cake\Controller\Component;
 use Cake\ORM\TableRegistry;
 

class CommonComponent  extends Component {

    public $config = null;
	
    public function initialize(array $config){
        parent::initialize($config);
    }
    
    /*
     * url safe base64 encode data
     */
    function base64url_encode( $data ){
        return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
    }

    /*
     * url safe base64 decode data
     */
    function base64url_decode( $data ){
        return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }
    
    /*
     * create id request to merchant
     */
    function createToken($data) {
        $this->Tokens    = TableRegistry::get('Tokens');
        $token = $this->Tokens->newEntity();
        $token = $this->Tokens->patchEntity($token, $data);
        if ($this->Tokens->save($token)) {
            return true;
        } else {
            return false;
        }
    }
    
}
