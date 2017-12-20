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

    public function getInputHtml($title, $arrayval, $lang = 'default', $value = '') {
        $controller = $this->request->controller;
        $count = 0;
        $inputField = "";
        $commonConstant = Configure::read('language');
        $placeholder = Configure::read($controller);
      

        $inputField .= '<div class="MoreLang"><div class="form-group form-float">';
        foreach ($commonConstant as $cm) {

            //set placeHolder in input field.
            $label = '';
            if (isset($placeholder[$title][$cm])) {
//                $arrayval['placeholder'] = $placeholder[$title][$cm];
                $label = $placeholder[$title][$cm];
            }

            //set values for edit
            if ($value != '') {
                $valueArray = json_decode($value, true);
                if (isset($valueArray[$cm])) {
                    if(is_array($valueArray[$cm])){
                        $arrayval['value'] = implode(',',$valueArray[$cm]);
                    }else{
                        $arrayval['value'] = $valueArray[$cm];
                    }
                }
            }

            if ($count == 0) {
                $inputField .= "<div class='form-line'>";
                     $inputField .= "<div class='clearfix'></div>";
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<div class="clearfix"></div><label class="form-label">'.$label.'</label>';
                $inputField .= '</div> <div class="pull-right tooltipHelpDv"><a href="javascript:void(0);" data-toggle="popover" data-placement="bottom" class="tooltipHelp" title="' . __('Post in another language') . '" data-content="' . __('Your post will be shown to users in a language that is most relevant to them.') . '"> <i class="material-iconsj"></i></a></div> <div class="addLangDv"><i class="material-icons open">add</i><span>' . __('Post in another language') . '</span> </div>';
                $arrayval['required'] = false;
                $inputField .= "";
    
            } elseif ($count == 1) {
                $inputField .= ' <div class="LangContent">';
                $inputField .= "<div class='form-group'>";
                $inputField .= "<div class='form-line'>";
                $arrayval['label'] = false;
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="form-label">'.$label.'</label>';
                $inputField .= "</div>";
                $inputField .= "</div>";
            } else {

                $inputField .= "<div class='form-line'>";
                $arrayval['label'] = false;
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="form-label">'.$label.'</label>';
                $inputField .= "</div>";
            }

//            if ($cm != $lang) {

            $count = $count + 1;
        }


        $inputField .= "</div></div></div> ";
        return $inputField;

        // print_r($commonConstant);
    }
    
    // for hybrid multi lang
    
        public function getInputHtmlHybrid($title, $arrayval, $lang = 'default', $value = '') {
        $controller = $this->request->controller;
        $count = 0;
        $inputField = "";
        $commonConstant = Configure::read('language');
        $placeholder = Configure::read($controller);
      

        $inputField .= '<div class="MoreLang"><div class="">';
        foreach ($commonConstant as $cm) {

            //set placeHolder in input field.
            $label = '';
            if (isset($placeholder[$title][$cm])) {
//                $arrayval['placeholder'] = $placeholder[$title][$cm];
                $label = $placeholder[$title][$cm];
            }

            //set values for edit
            if ($value != '') {
                $valueArray = json_decode($value, true);
                if (isset($valueArray[$cm])) {
                    if(is_array($valueArray[$cm])){
                        $arrayval['value'] = implode(',',$valueArray[$cm]);
                    }else{
                        $arrayval['value'] = $valueArray[$cm];
                    }
                }
            }

            if ($count == 0) {
                $inputField .= "<div class='clearfix'>";
//                     $inputField .= "<div class='clearfix'></div>";  <div class="clearfix"></div>
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="form-label" for='.$title.'-'.strtolower(str_replace('_', '-', $cm)).'>'.$label.'</label>';
                $inputField .= '</div> <div class="pull-right tooltipHelpDv"><a href="javascript:void(0);" data-toggle="popover" data-placement="bottom" class="tooltipHelp" title="' . __('Post in another language') . '" data-content="' . __('Your post will be shown to users in a language that is most relevant to them.') . '"> <i class="material-iconsj"></i></a></div> <div class="addLangDv"><i class="material-icons">add</i><span>' . __('Post in another language') . '</span> </div>';
                $arrayval['required'] = false;
                $inputField .= "";
    
            } elseif ($count == 1) {
                $inputField .= ' <div class="LangContent">';
                $inputField .= "<div class='input-field'>";
                $inputField .= "<div class=''>";
                $arrayval['label'] = false;
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="" for='.$title.'-'.strtolower(str_replace('_', '-', $cm)).'>'.$label.'</label>';
                $inputField .= "</div>";
                $inputField .= "</div>";
            } else {

                $inputField .= "<div class='input-field'>";
                $arrayval['label'] = false;
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="" for='.$title.'-'.strtolower(str_replace('_', '-', $cm)).'>'.$label.'</label>';
                $inputField .= "</div>";
            }

//            if ($cm != $lang) {

            $count = $count + 1;
        }


        $inputField .= "</div></div></div> ";
        return $inputField;

        // print_r($commonConstant);
    }
    
    
    public function getInputHtmlfront($title, $arrayval, $lang = 'default', $value = '') {
        $controller = $this->request->controller;
        $count = 0;
        $inputField = "";
        $commonConstant = Configure::read('language');
        $placeholder = Configure::read($controller);
      

        $inputField .= '<div class="MoreLang"><div class="form-group form-float">';
        foreach ($commonConstant as $cm) {

            //set placeHolder in input field.
            $label = '';
            if (isset($placeholder[$title][$cm])) {
//                $arrayval['placeholder'] = $placeholder[$title][$cm];
                $label = $placeholder[$title][$cm];
            }

            //set values for edit
            if ($value != '') {
                $valueArray = json_decode($value, true);
                if (isset($valueArray[$cm])) {
                    if(is_array($valueArray[$cm])){
                        $arrayval['value'] = implode(',',$valueArray[$cm]);
                    }else{
                        $arrayval['value'] = $valueArray[$cm];
                    }
                }
            }

            if ($count == 0) {
                $inputField .= "<div class='form-line'>";
                     $inputField .= "<div class='clearfix'></div>";
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<div class="clearfix"></div><label class="form-label">'.$label.'</label>';
                $inputField .= '</div> <div class="pull-right tooltipHelpDv"><a href="javascript:void(0);" data-toggle="popover" data-placement="bottom" class="tooltipHelp" title="' . __('Post in another language') . '" data-content="' . __('Your post will be shown to users in a language that is most relevant to them.') . '"> <i class="material-iconsj"></i></a></div> <div class="addLangDv"><i class="fa fa-plus"></i><span>' . __('Post in another language') . '</span> </div>';
                $arrayval['required'] = false;
                $inputField .= "";
    
            } elseif ($count == 1) {
                $inputField .= ' <div class="LangContent">';
                $inputField .= "<div class='form-group'>";
                $inputField .= "<div class='form-line'>";
                $arrayval['label'] = false;
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="form-label">'.$label.'</label>';
                $inputField .= "</div>";
                $inputField .= "</div>";
            } else {

                $inputField .= "<div class='form-line'>";
                $arrayval['label'] = false;
                $inputField .= $this->Form->input($title . "[" . $cm . "]", $arrayval);
                $inputField .= '<label class="form-label">'.$label.'</label>';
                $inputField .= "</div>";
            }

//            if ($cm != $lang) {

            $count = $count + 1;
        }


        $inputField .= "</div></div></div> ";
        return $inputField;

        // print_r($commonConstant);
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
    
    public function getCategory()
    {
        
        $get_category = TableRegistry::get('Categories');
        $cat_lists = $get_category->find('all')->select(['name', 'slug'])->where(['category_type' => 1, 'status' => 1])->toArray();
        return $cat_lists;
    }
    
    
      public function getCategoryNimbuzz()
    {
        
        $get_category = TableRegistry::get('Nimbuzz.Categories');
        $cat_lists = $get_category->find()->select(['name', 'slug' ,'id','position'])->where(['category_type' => 1, 'status' => 1])
                                ->order(['position Is Null','position Asc'])->toArray();
        return $cat_lists;
    }
    
     public function getCategoryNimbuzzLimt()
    {
        
        $get_category = TableRegistry::get('Nimbuzz.Categories');
        $cat_lists = $get_category->find()->select(['name', 'slug' ,'id','position'])->where(['category_type' => 1, 'status' => 1])
                                ->order(['position Is Null','position Asc'])->limit(8)->toArray();
        return $cat_lists;
    }
    
     public function getwebnextCategoryNim()
    {
          $get_category = TableRegistry::get('Nimbuzz.Categories');
         $cat_lists_more = $get_category->find('all', ['offset' => 8, 'limit' => 100])
                ->select(['name', 'slug' ,'id','position'])
                ->where(['category_type' => 1, 'status' => 1])
                 ->order(['position Is Null','position Asc'])
                ->toArray();
        return $cat_lists_more;
    }
    
    
      public function getNewsByCategory($category_id,$location,$lan)
    {
        $data = [];
        $data['category']='';
        if (!empty($category_id)) {
            $data['category'] = $category_id;
        }
        
          if (!preg_match("{world}", $data['category'])) {
             
            $data['country']     = $location;;
        }
        
        $data['limit'] = 5;
        $data['lang']  = $lan;  
        $apiUrl = Configure::read('apiurl');
        $http = new Client();
        if ($this->request->env('HTTP_HOST') == '127.0.0.1' || $this->request->env('HTTP_HOST') == 'localhost')  {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_local_nim'];
        } elseif ($this->request->env('HTTP_HOST') == 'newsportal.mjsit.ga') {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_staging_nim'];
        } elseif ($this->request->env('HTTP_HOST') == 'www.albuzzer.com') {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_live_nim'];
        }
        elseif($this->request->env('HTTP_HOST') == 'localhost:8888')
        {
           $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_local_mac_nim']; 
        } else {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_local_nim'];
        }
        
        $response    = $http->get($apiNews, $data);
         $newsbycategory = json_decode($response->body());
          
          return $newsbycategory;
          
    }
    
    
     public function getwebCategory()
    {
          $get_category = TableRegistry::get('Categories');
       $cat_lists = $get_category->find('all')
                ->select(['name', 'slug','id'])
                ->where(['category_type' => 1, 'status' => 1])
                ->limit(7)
                ->toArray();
        return $cat_lists;
    }
     public function gethybridCategory()
    {
          $get_category = TableRegistry::get('Categories');
       $cat_lists = $get_category->find('all')
                ->select(['name', 'slug','id'])
                ->where(['category_type' => 1, 'status' => 1])
                //->limit(7)
                ->toArray();
        return $cat_lists;
    }
    
     public function getwebTags()
    {
       $get_tags = TableRegistry::get('Tags');
       $tag_lists = $get_tags->find('all')
                ->select(['name','id'])
                ->where(['status' => 1])
                ->limit(7)
                ->toArray();
        return $tag_lists;
    }
    
      public function getwebTagsNimbuzz()
    {
       $get_tags = TableRegistry::get('Nimbuzz.Tags');
       $tag_lists = $get_tags->find('all')
                ->select(['name','id'])
                ->where(['status' => 1])
                ->limit(7)
                ->toArray();
        return $tag_lists;
    }
    
     public function getwebnextCategory()
    {
          $get_category = TableRegistry::get('Categories');
         $cat_lists_more = $get_category->find('all', ['offset' => 7, 'limit' => 100])
                ->select(['name', 'slug'])
                ->where(['category_type' => 1, 'status' => 1])
                ->toArray();
        return $cat_lists_more;
    }
   
    
    /*
     * country list for changing country on web news home page
     */
    public function getCountry() {
        $countryTable = TableRegistry::get('Countries');
        $countryList = $countryTable->find('list',['keyField' => 'iso', 'dispalyField' => 'name'])
                                    ->where(['status' => 1, 'iso IS NOT NULL', 'iso3 IS NOT NULL']);
        
        return $countryList;
        
    }
    public function getNimbuzzCountry() {
        $countryTable = TableRegistry::get('Nimbuzz.Countries');
        $countryList = $countryTable->find('list',['keyField' => 'iso', 'dispalyField' => 'name'])
                                    ->where(['status' => 1, 'iso IS NOT NULL', 'iso3 IS NOT NULL'])
                                    ->order(['name']);
        
        return $countryList;
        
    }
        
    /*
     * get the iso3 code of the selected country
     */
    public function getIsoCode($country) {
        $countryTable = TableRegistry::get('Countries');
        $countryData = $countryTable->find()
                                    ->select(['iso3','name'])
                                    ->where(['iso' => strtoupper($country),'status' => 1, 'iso IS NOT NULL', 'iso3 IS NOT NULL'])
                                    ->first();
      
        return $countryData->iso3;
    }
    
    public function getIsoCodeName($country) {
        $countryTable = TableRegistry::get('Countries');
        $countryData = $countryTable->find()
                                    ->select(['name'])
                                    ->where(['iso' => strtoupper($country),'status' => 1, 'iso IS NOT NULL', 'iso3 IS NOT NULL'])
                                    ->first();
        
        return $countryData->name;
    }
    
    /*
     * language list for changing language on web news home page
     */
    public function getLanguage() {
        $langTable = TableRegistry::get('Languages');
        $langList = $langTable->find('list',['keyField' => 'code', 'dispalyField' => 'name'])
                              ->where(['status' => 1]);
        return $langList;
    }
    
    /*
     * language name using languagecode on web news home page
     */
    public function getLanguageName($code) {
        $langTable = TableRegistry::get('Languages');
        $langData = $langTable->find()
                              ->select(['name'])
                              ->where(['code' => $code, 'status' => 1])
                              ->first();
        return $langData->name;
    }
    
    public function getNoOfRec() {
        return [10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100];
    }
    
    /*
     * Get api access type
     */
    public function apiAccess() {
        return['1' => 'Full', '2' => 'Self'];
    }
    
    /*
     * Get api access type
     */
    public function apiAccessData($dc,$category) {
        $apiAccessTable = TableRegistry::get('ApiAccesses');
        $apiData = $apiAccessTable->find()
                              ->select(['access_type','status'])
                              ->where(['distribution_channel_id' => $dc, 'category' => $category])
                              ->first();
        if($apiData) {
            return $apiData;
        }else{
            return NULL;
        }
    }
    
    /*
     * Get location with city country
     */
    public function location($location,$city,$country) {
        $array=[];
        if(!empty($location)){
            $array[] = $location;
        }
        if(!empty($city)){
            $array[] = $city;
        }
        if(!empty($country)){
            $array[] = $country;
        }
        
        if(!empty($array)){
            return implode(', ', $array);
        }else{
            return FALSE;
        }
        
    }
    
    /*
     * Get city and country
     */
    public function cityCountry($city,$country) {
        $array=[];
        if(!empty($city)){
            $array[] = $city;
        }
        if(!empty($country)){
            $array[] = $country;
        }
        
        if(!empty($array)){
            return implode(', ', $array);
        }else{
            return FALSE;
        }
        
    }
    
    /*
     * Get breaking news
     */
    public function breakingNews() {
        $data['news_type'] = 2;
        $data['limit'] = 3;
        
        $apiUrl = Configure::read('apiurl');
        $http = new Client();
        if ($this->request->env('HTTP_HOST') == '127.0.0.1' || $this->request->env('HTTP_HOST') == 'localhost' || $this->request->env('HTTP_HOST') == 'localhost:8888') {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_local'];
        } elseif ($this->request->env('HTTP_HOST') == 'newsportal.mjsit.ga') {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_staging'];
        } elseif ($this->request->env('HTTP_HOST') == 'www.albuzzer.com') {
            $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_live'];
        }
        else
        {
           $apiNews = WEB_URL_HOST_ROOT.$apiUrl['newsapi_local'];  
        }
        
        
        $response = $http->get($apiNews, $data);
        $res = json_decode($response->body(),TRUE);
        return $res['data'];
    }
    
    public function profileView() {
        $this->Users = TableRegistry::get('Users');
        $userId = $this->request->session()->read('Auth.User.id');
        if(!isset($userId) || $userId == ""){
            return $this->redirect('/');
         }
   
        
        $user = $this->Users->get($userId);
        return $user;
        //$this->set(compact('user'));

    }
    
    public function getlatest() {
        return [1 => 1, 3 => 3, 5 => 5, 7 => 7, 10 => 10];
    }
    
     public function gettoptrading() {
        return [1 => 1, 3 => 3, 5 => 5, 7 => 7, 10 => 10];
    }
    
     public function getlocation() {
        return [1 => 1, 3 => 3, 5 => 5, 7 => 7, 10 => 10];
    }
    
    
}
