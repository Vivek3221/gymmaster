<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FormHelper;
use Cake\Utility\Text;
use Cake\Network\Http\Client;
use Cake\Network\Response;
use Cake\Network\Request;
use Cake\I18n\Time;

class CommonHelper extends Helper {

    public $helpers = ['Form','Html','Time', 'Text'];
    
    /*
     * single level breadcrumb html for admin
     */
 

    /*
     * two level breadcrumb html for admin
     */

    
      public function getTime($created) {

        $now = date('Y-m-d H:i:s');
//        $created = $this->Time->nice($created);
        $time = new Time($created);
        $time->i18nFormat();
        $time->i18nFormat(\IntlDateFormatter::FULL); 
        $time->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::SHORT]); 
        $created =$time->i18nFormat('yyyy-MM-dd HH:mm:ss'); 
        
        $diff = strtotime($now) - strtotime($created);
        $diff_in_hrs = $diff / 3600;
        if ($diff_in_hrs > 24) {
            return $this->Time->format($created, 'd-MM-Y');
        } else {
            return $this->Time->timeAgoInWords($created, ['format' => 'F jS, Y', 'end' => '+1 year']);
            //return $this->Time->format($created,'Y-M-d');
            //echo $this->Time->format($created,'j M');
        }
    }
    
    public function getStatus() {
        return['1' => 'Active', '0' => 'Inactive'];
    }
    public function getSubStatus() {
        return['1' => 'Subscribed', '0' => 'Unsubscribed'];
    }
    
     public function getVisibility() {
        return['1' => 'Show', '0' => 'Hide'];
    }
    
     public function getLevel() {
        return['1' => 'one', '0' => 'two'];
    }
    
      public function getType() {
        return['1' => 'Admin', '0' => 'User'];
    }
    
     public function targetType() {
        return['1' => 'Achive', '0' => 'Fail'];
    }
    
    public function getCategorytype() {
        return['1' => 'News', '2' => 'Faqs'];
    }
    public function getNimbuzzCategorytype() {
        return['1' => 'News', '2' => 'Faqs','3'=>'Articles'];
    }
     public function getGender() {
        return['Male' => 'Male', 'Female' => 'Female'];
    }
    /*
     * Frequency options for news site
     */
    public function getfrequency() {
        return['1' => 'Frequency 1', '2' => 'Frequency 2', '3' => 'Frequency 3', '4' => 'Frequency 4'];
    }
    
    public function getLanguagenibuzzName() {
        return['en_US' => 'English', 'hi_IN' => 'Hindi', 'fr_FR' => 'French'];
    }
    
    /*
     * Limitation options for news site
     */
    public function getlimitation() {
        return['1' => 'Limitation 1', '2' => 'Limitation 2', '3' => 'Limitation 3', '4' => 'Limitation 4'];
    }

  
    
    
    /*
     * get the name in particular language
     */
    public function getLangValue($val, $lan){
        $value = json_decode($val);
        if(isset($value->$lan) && $value->$lan != ""){
            return $value->$lan;
        } else if(isset($value->en_US)){
            return $value->en_US;
        }
    }
    
    /*
     * truncate description
     */
    public function turnCatefun($text,$number)
    {
        return $this->Text->truncate(
                    $text,
                    $number,
                    [
                        'ellipsis' => '...',
                        'exact' => false
                    ]
                );
        
    }
    
    /*
     * get name from a row in a table
     */
    public function getName($id, $tableName, $lan) {
         //pr($lan);
        $nameData='';
        $tableEntity = TableRegistry::get($tableName);
        $data = $tableEntity->find()
                ->select(['id', 'name'])
                ->where(['id' => $id])
                ->first();
        if(!empty($data->name)){
      $dataNm = json_decode($data->name,TRUE);
        }
        if(!empty($dataNm[$lan])){
        
        
        //pr($dataNm);
         $nameData = $dataNm[$lan];
        // pr($nameData);
      }elseif(!empty($dataNm['en_US'])){
          $nameData = $dataNm['en_US'];
      } 
        return $nameData;
    }
    
      public function getCommonName($id, $tableName) {
        $tableEntity = TableRegistry::get($tableName);
        $data = $tableEntity->find()
                ->select(['id', 'name'])
                ->where(['id' => $id])
                ->first();
        return $data['name'];
    }    

    
    public function getNoOfRec() {
        return [10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
    }
    
  
 


    
    /*
     * Get breaking news
     */


    
    
}
