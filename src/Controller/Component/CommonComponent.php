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
        $query    = "INSERT INTO " . $DBPrefix . "requests 
                    (sender,  merchant, nimbuzz_id, nimbucks, status, type, seller, created, modified) VALUES
                    (:sender, :merchant, :nimbuzz_id, :nimbucks, :status, :type, :seller, :created,:modified)";
        $params   = [];
        $params[] = [':sender', $_SESSION['NIMBUZZ_ID'], 'str'];
        $params[] = [':merchant', $data['merchant'], 'str'];
        $params[] = [':nimbuzz_id', $data['nimbuzzid'], 'str'];
        $params[] = [':nimbucks', $data['price'], 'int'];
        $params[] = [':status', $data['status'], 'str'];
        $params[] = [':type', $data['type'], 'str'];
        $params[] = [':seller', $data['seller'], 'str'];
        $params[] = [':created', $now, 'int'];
        $params[] = [':modified', $now, 'int'];
        $db->query($query, $params);
        if($db->lastInsertId()){
            return ['created'=>$now, 'requestid'=>$db->lastInsertId()];
        } else {
            return [];
        }
    }
    
}
