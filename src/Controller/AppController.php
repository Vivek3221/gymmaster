<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    
    public $captcha    = "6Lf_JygUAAAAALYOstCso54v8y3yu5hiw9hYpOUg";
    public $components = ['Flash', 'Auth', 'Cookie'/* , 'Security', 'Csrf' */];
   // public $helpers    = ['Usermgmt.UserAuth', 'Usermgmt.Image', 'Form'];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }
     
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
         //  $usersdetail          =      $this->Cookie->read('users');
         //  $this->usersdetail    =      $this->Cookie->read('users');
           
           $usersdetail          = $this->request->session()->read('users');
           //pr($usersdetail);exit;
           $this->usersdetail    = $this->request->session()->read('users');
        
        //Guest User ID
        $session_id      = session_id();
        $this->Cookie->write('session_id', $session_id);
        if ($this->Cookie->read('guest_id') == null || $this->Cookie->read('guest_id') == '') {
            $user_agent = $this->request->env('HTTP_USER_AGENT');
            $user_ip = $this->request->env('REMOTE_ADDR');
            $guest_id = md5($user_agent . $user_ip . $session_id);
            $this->Cookie->write('guest_id', $guest_id);
        }

        $this->set(compact('usersdetail','username'));
        $this->set('_serialize', ['cookie_value']);
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    
    public function slugify($text) {

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
