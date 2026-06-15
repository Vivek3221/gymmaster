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
    public function getUserStatus() {
        return['1' => 'Active', '0' => 'Inactive','2'=>'Enquiry'];
    }
    public function getModPayment() {
        return['0' => 'By Cash', '1' => 'By Check', '2' => 'By Online'];
    }
    
     public function getPayDuration() {
        return['0' => '1 Month', '1' => '3 month', '2' => '6 month'];
    }
    
     public function getLevel() {
        return['1' => 'one', '0' => 'two'];
    }
    
      public function getType() {
        return['2' => 'Partner', '3' => 'User'];
    }
    
   
     public function getGender() {
        return['Male' => 'Male', 'Female' => 'Female'];
    }
    /*
     * Frequency options for news site
     */
    
    
    
    /*
     * get the name in particular language
   
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
    
    
    
    public function getNoOfRec() {
        return [10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
    }
    
     public function getExercises($id)
    {
        $get_exercises = TableRegistry::get('Exercises');
        $exer_lists = $get_exercises->find()->select(['name', 'description','id'])->where(['body_id'=>$id,'status' => 1])->toArray();
        return $exer_lists;
    }
     public function getExrciseDirectories($users_id)
    {
         
        $get_exrcisedirectories = TableRegistry::get('ExrciseDirectories');
        $get_exrcisedirectorie_lists = $get_exrcisedirectories->find('list')->where(['status' => 1,'user_id'=>$users_id])->toArray();
        return $get_exrcisedirectorie_lists;
    }
     public function getExrciseDirectoriesm()
    {
         
        $get_exrcisedirectories = TableRegistry::get('ExrciseDirectories');
        $get_exrcisedirectorie_lists = $get_exrcisedirectories->find('list')->where(['status' => 1])->toArray();
        return $get_exrcisedirectorie_lists;
    }
     public function getExrciseDirectoriesedit($users_id,$addexc)
    {
         
        $get_exrcisedirectories = TableRegistry::get('ExrciseDirectories');
        $get_exrcisedirectorie_lists = $get_exrcisedirectories->find('list')->where(['status' => 1,'user_id'=>$users_id,'ExrciseDirectories.id NOT IN'=>$addexc])->toArray();
        return $get_exrcisedirectorie_lists;
    }
     public function getExrciseDirectoriesname($id)
    {
        $get_exrcisedirectories = TableRegistry::get('ExrciseDirectories');
        $get_exrcisedirectorie_lists = $get_exrcisedirectories->find()->select(['name','id','tecnical1','tecnical2','tecnical3','tecnical4'])->where(['status' => 1,'id'=>$id])->first();
        return $get_exrcisedirectorie_lists;
    }
    
     public function getBodies()
    {
        $get_exercises = TableRegistry::get('Exercises');
        $get_body_ids = $get_exercises->find()
                                    ->select(['Exercises.body_id'])
                                    ->where(['status' => 1])
                                    ->distinct(['body_id'])
                                    ->toArray(); 
        foreach ($get_body_ids as $get_body_id)
                            {
                                $body_id[] = $get_body_id->body_id;
                            }
                           // pr($body_id); die;
         
        $get_bodies = TableRegistry::get('Bodies');
        $bodies_lists = $get_bodies->find()->select(['name', 'description','id'])->where(['status' => 1,'id IN'=>$body_id])->toArray();
        return $bodies_lists;
    }
     public function getUsers()
    {
        $users_type = $this->request->session()->read('users'); 
        // pr($users_type);die();
        if($users_type['users_type'] == 4)
        {
        $partner_id = $users_type['users_id'];
        $get_users = TableRegistry::get('Users');
        $get_users_name = $get_users->find('list')
                                    ->where(['active' => 1,'user_type' =>3,'Users.trainer_userid'=>$partner_id])
                                    ->toArray(); 
        }else{
            $partner_id = $users_type['users_id'];
            $get_users = TableRegistry::get('Users');
            $get_users_name = $get_users->find('list')
                                    ->where(['active' => 1,'user_type' =>3,'Users.partner_id'=>$partner_id])
                                    ->toArray(); 
        }
        return $get_users_name;
    }
  
    public function getSession(){
         $users_type = $this->request->session()->read('users');
         $users_id = $users_type['users_id'];
        $get_sessions = TableRegistry::get('Sessions');
        $session  = $get_sessions->find()
                                 ->where(['date <' => date('Y-m-d') ,'user_detail Is Null','partner_id'=>$users_id])
                                 ->count();
        return $session;
        
    }

    public function getBirthday(){
         $users_type = $this->request->session()->read('users');
         $users_id = $users_type['users_id'];
         $get_user = TableRegistry::get('Users');
         $session  = $get_user->find()
                             ->select('dob')
                             ->where(['dob =' => date('Y-m-d') ,'partner_id'=>$users_id])
                             ->count();
        return $session;
        
    }

    public function getPaymentDue(){
         $users_type = $this->request->session()->read('users');
         $users_id = $users_type['users_id'];
         $get_user = TableRegistry::get('PlanSubscribers');
         $session  = $get_user->find()
                             ->select('user_id')
                             ->where(['payment_due_date <' => date('Y-m-d') ,'partner_id'=>$users_id])
                             ->count();
        return $session;
        
    }

     public function getPlanexpire(){
         $users_type = $this->request->session()->read('users');
         $users_id = $users_type['users_id'];
         $get_user = TableRegistry::get('PlanSubscribers');
         $session  = $get_user->find()
                             ->select('user_id')
                             ->where(['plan_expire_date <' => date('Y-m-d') ,'partner_id'=>$users_id])
                             ->count();
        return $session;
        
    }




    public function getpartner(){
        $get_users = TableRegistry::get('Users');
        $get_users_name = $get_users->find('list')
                                    ->where(['active' => 1,'user_type' =>2])
                                    ->toArray(); 
        return $get_users_name;
        
    }
 
    public function getAdmin() {
        return['1' => 'Admin'];
    }

    public function getSimpleName($id){
        $get_users = TableRegistry::get('Users');
        $get_users_name = $get_users->find()->select(['name'])
                                    ->where(['id' => $id])
                                    ->first(); 
        return $get_users_name['name'];
        
    }

     public function getDietsDirectories($users_id)
    {
         
        $get_dietdirectories = TableRegistry::get('DietDirectories');
        $get_dietdirectories_lists = $get_dietdirectories->find('list')->where(['status' => 1,'user_id'=>$users_id])->toArray();
        return $get_dietdirectories_lists;
    }

     public function getDietsDirectoriesm()
    {
         
        $get_dietdirectories = TableRegistry::get('DietDirectories');
        $get_dietdirectories_lists = $get_dietdirectories->find('list')->where(['status' => 1])->toArray();
        return $get_dietdirectories_lists;
    }

      public function getDietDirectoriesname($id)
    {
        $get_dietirectories = TableRegistry::get('DietDirectories');
        $get_dietirectories_lists = $get_dietirectories->find()->select(['name','id','technical1','technical2','technical3','technical4','technical5','technical6','technical7'])->where(['status' => 1,'id'=>$id])->first();
        return $get_dietirectories_lists;
    }


    
    
}
