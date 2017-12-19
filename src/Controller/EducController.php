<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Network\Http\Client;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 *
 * @method \App\Model\Entity\News[] paginate($object = null, array $settings = [])
 */
class EducController extends AppController {

    public function initialize() {
        //$this->loadComponent('Messages');
       // $this->loadComponent('Common');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
                  
                     $news = 'heloo demo';
        $this->set(compact('news','name','status','norec','source','get_source_lists'));
        $this->set('_serialize', ['news']);
    }

  
    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Edu');

//        if($this->Cookie->read('apiUser')==null){
//            return $this->redirect('/');
//        }
    }

//    public function beforeFilter(\Cake\Event\Event $event) {
//        parent::beforeFilter($event);
//        $this->Auth->allow(['Edu']);
//    }

}
