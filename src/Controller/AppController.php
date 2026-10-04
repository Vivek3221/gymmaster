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
        
         $this->loadComponent('Auth', [
        'loginAction' => [
            'controller' => 'Users',
            'action' => 'login'
        ],
        'authError' => 'Without login you can not be access any action.',
        'authenticate' => [
            'Form' => [
                'fields' => ['username' => 'username','password'=>'password'], 'userModel' => 'Users'
            ]
        ],
        'storage' => 'Session'
        ]);

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
        if ($this->Cookie->read('users')) {
            $this->request->session()->write('users', $this->Cookie->read('users'));
        }
        $usersdetail       = $this->request->session()->read('users');
        $this->usersdetail = $usersdetail;
        if (empty($this->usersdetail) && $this->Cookie->read('users')) {
            $this->usersdetail = $this->Cookie->read('users');
            $usersdetail = $this->usersdetail;
        }

        // Fallback to Auth component if session users is still empty
        if (empty($this->usersdetail) && !empty($this->Auth->user())) {
            $authUser = $this->Auth->user();
            $this->usersdetail = [
                'users_id' => $authUser['id'] ?? null,
                'users_name' => $authUser['name'] ?? '',
                'users_email' => $authUser['email'] ?? '',
                'users_type' => $authUser['user_type'] ?? null,
                'partner_id' => $authUser['partner_id'] ?? null,
            ];
            $usersdetail = $this->usersdetail;
            $this->request->session()->write('users', $this->usersdetail);
        }
        
        //Guest User ID
        $session_id      = session_id();
        $this->Cookie->write('session_id', $session_id);
        if ($this->Cookie->read('guest_id') == null || $this->Cookie->read('guest_id') == '') {
            $user_agent = $this->request->env('HTTP_USER_AGENT');
            $user_ip = $this->request->env('REMOTE_ADDR');
            $guest_id = md5($user_agent . $user_ip . $session_id);
            $this->Cookie->write('guest_id', $guest_id);
        }

        if($this->Cookie->read('user_email')){
            $this->request->session()->write('Auth.User.email', $this->Cookie->read('user_email'));
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

    /**
     * Safely parse date string into Y-m-d format regardless of separator or locale format
     */
    public function parsePaymentDate($dateStr)
    {
        if (empty($dateStr) || trim($dateStr) === '') {
            return date('Y-m-d');
        }
        $dateStr = trim($dateStr);
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateStr)) {
            return $dateStr;
        }
        $normalized = str_replace('/', '-', $dateStr);
        $ts = strtotime($normalized);
        if ($ts !== false && $ts > 0) {
            return date('Y-m-d', $ts);
        }
        foreach (['Y-m-d', 'd-m-Y', 'd/m/Y', 'm/d/Y', 'Y/m/d'] as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $dateStr);
            if ($dt !== false) {
                return $dt->format('Y-m-d');
            }
        }
        return date('Y-m-d');
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

    /**
     * Privileged root emails for sensitive operations
     */
    public function getPrivilegedRootEmails()
    {
        return ['mukeshkr3221@gmail.com', 'ad1234@yopmail.com'];
    }

    /**
     * Check if current user is one of the permanent privileged root emails or super admin
     */
    public function isPaymentDeleteRoot($email = null)
    {
        if ($email === null) {
            $email = $this->usersdetail['users_email'] ?? '';
        }
        $email = strtolower(trim($email));
        $isRoot = in_array($email, $this->getPrivilegedRootEmails());
        if (!$isRoot && !empty($this->usersdetail['users_type']) && (int)$this->usersdetail['users_type'] === 1) {
            $isRoot = true;
        }
        return $isRoot;
    }

    /**
     * Check if current user can delete payments or payouts (either privileged root or active delegated permission)
     */
    public function canDeletePayment($email = null)
    {
        if ($email === null) {
            $email = $this->usersdetail['users_email'] ?? '';
        }
        $email = strtolower(trim($email));

        if ($this->isPaymentDeleteRoot($email)) {
            return true;
        }

        if (!empty($this->usersdetail['users_type']) && (int)$this->usersdetail['users_type'] === 1) {
            return true;
        }

        if (empty($email)) {
            return false;
        }

        try {
            $db = \Cake\Datasource\ConnectionManager::get('default');
            $row = $db->execute(
                "SELECT id FROM payment_delete_permissions WHERE LOWER(email) = ? AND is_active = 1 LIMIT 1",
                [$email]
            )->fetch('assoc');
            return !empty($row);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if user is an admin (Super Admin user_type 1 or root emails)
     */
    public function isAdminUser($userType = null, $email = null)
    {
        if ($userType === null) {
            $userType = $this->usersdetail['users_type'] ?? 0;
        }
        if ($email === null) {
            $email = $this->usersdetail['users_email'] ?? '';
        }
        $email = strtolower(trim($email));

        if ((int)$userType === 1 || in_array($email, $this->getPrivilegedRootEmails())) {
            return true;
        }
        return false;
    }

    /**
     * Check if user can duplicate sessions (Partner users, privileged root emails, or active delegated duplicate permissions)
     */
    public function canDuplicateSession($userType = null, $email = null)
    {
        if ($userType === null) {
            $userType = $this->usersdetail['users_type'] ?? 0;
        }
        if ($email === null) {
            $email = $this->usersdetail['users_email'] ?? '';
        }
        $email = strtolower(trim($email));

        if ($userType == 2 || $this->isAdminUser($userType, $email)) {
            return true;
        }

        if (empty($email)) {
            return false;
        }

        try {
            $db = \Cake\Datasource\ConnectionManager::get('default');
            $row = $db->execute(
                "SELECT id FROM session_duplicate_permissions WHERE LOWER(email) = ? AND is_active = 1 LIMIT 1",
                [$email]
            )->fetch('assoc');
            return !empty($row);
        } catch (\Exception $e) {
            return false;
        }
    }
}

