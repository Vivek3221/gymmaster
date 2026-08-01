<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * PtPayrolls Controller
 *
 * @property \App\Model\Table\PtPayrollsTable $PtPayrolls
 * @property \App\Model\Table\PtRatesTable $PtRates
 * @property \App\Model\Table\PtClassEntriesTable $PtClassEntries
 * @property \App\Model\Table\UsersTable $Users
 */
class PtPayrollsController extends AppController
{
    /**
     * Check if the current logged-in user has access to this module.
     */
    private function checkAccess()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        
        if ($userType == 1 || $userType == 2 || in_array($email, $allowedEmails)) {
            return null;
        }

        $this->Flash->error(__('You do not have permission to access this module.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PtPayrolls');
        $this->loadModel('PtRates');
        $this->loadModel('PtClassEntries');
        $this->loadModel('Users');
    }

    /**
     * Index / Dashboard method
     */
    public function index()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        // Auto-sync any orphaned class entries into pt_payrolls
        $orphanedClassEntries = $this->PtClassEntries->find()
            ->leftJoinWith('PtPayrolls')
            ->where(['PtPayrolls.id IS' => null])
            ->all();

        foreach ($orphanedClassEntries as $ce) {
            $this->calculateAndSavePayroll($ce);
        }

        $search = [];
        if (!$isGlobal) {
            $search['PtPayrolls.partner_id'] = $userId;
        }

        $trainerId = $this->request->getQuery('trainer_id');
        $partnerId = $this->request->getQuery('partner_id');
        $month = $this->request->getQuery('month');
        $year = $this->request->getQuery('year');
        $status = $this->request->getQuery('status');

        if (!empty($trainerId)) {
            $search['PtPayrolls.trainer_id'] = $trainerId;
        }
        if ($isGlobal && !empty($partnerId)) {
            $search['PtPayrolls.partner_id'] = $partnerId;
        }
        if (!empty($month)) {
            $search['PtClassEntries.month'] = $month;
        }
        if (!empty($year)) {
            $search['PtClassEntries.year'] = $year;
        }
        if (!empty($status)) {
            $search['PtPayrolls.status'] = $status;
        }

        // Summary Calculations (current month & year)
        $currentMonth = (int)date('m');
        $currentYear = (int)date('Y');

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
        }
        $totalTrainers = $this->Users->find()->where($trainerConditions)->count();

        $classConditions = ['PtClassEntries.month' => $currentMonth, 'PtClassEntries.year' => $currentYear];
        if (!$isGlobal) {
            $classConditions['PtClassEntries.partner_id'] = $userId;
        }
        $totalClasses = $this->PtClassEntries->find()->where($classConditions)->sumOf('total_classes') ?: 0;

        $payrollConditions = ['PtClassEntries.month' => $currentMonth, 'PtClassEntries.year' => $currentYear];
        if (!$isGlobal) {
            $payrollConditions['PtPayrolls.partner_id'] = $userId;
        }
        $totalPayrollAmount = $this->PtPayrolls->find()
            ->contain(['PtClassEntries'])
            ->where($payrollConditions)
            ->sumOf('total_amount') ?: 0;

        $avgClasses = $totalTrainers > 0 ? round($totalClasses / $totalTrainers, 1) : 0;

        $pendingConditions = [
            'PtClassEntries.month' => $currentMonth, 
            'PtClassEntries.year' => $currentYear, 
            'PtPayrolls.status' => 'Pending'
        ];
        if (!$isGlobal) {
            $pendingConditions['PtPayrolls.partner_id'] = $userId;
        }
        $pendingPayroll = $this->PtPayrolls->find()
            ->contain(['PtClassEntries'])
            ->where($pendingConditions)
            ->sumOf('total_amount') ?: 0;

        // Paginated List
        $query = $this->PtPayrolls->find()
            ->contain([
                'Trainers', 
                'Partners', 
                'PtClassEntries' => ['Users', 'UserPtSubscriptions']
            ])
            ->where($search);

        $payrolls = $query->order(['PtPayrolls.id' => 'DESC'])->all();

        // Fetch select list variables
        $partners = [];
        if ($isGlobal) {
            $partners = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where(['Users.user_type' => 2, 'Users.active !=' => '3'])
                ->toArray();
        }

        $trainerQueryConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerQueryConditions['Users.partner_id'] = $userId;
        }
        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where($trainerQueryConditions)
            ->toArray();

        $this->set(compact(
            'payrolls', 'totalTrainers', 'totalClasses', 'totalPayrollAmount', 'avgClasses', 'pendingPayroll',
            'trainers', 'partners', 'isGlobal', 'trainerId', 'partnerId', 'month', 'year', 'status'
        ));
    }

    /**
     * View payroll details
     */
    public function view($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $payroll = $this->PtPayrolls->get($id, [
            'contain' => ['Trainers', 'Partners', 'PtClassEntries' => ['Users']]
        ]);

        if (!$isGlobal && $payroll->partner_id != $userId) {
            $this->Flash->error(__('You are not authorized to view this payroll record.'));
            return $this->redirect(['action' => 'index']);
        }

        $paidByUser = null;
        if ($payroll->paid_by) {
            $paidByUser = $this->Users->find()->select(['name'])->where(['id' => $payroll->paid_by])->first();
        }

        $this->set(compact('payroll', 'paidByUser'));
    }

    /**
     * Mark payroll as Paid
     */
    public function markPaid($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $payroll = $this->PtPayrolls->get($id);

        if (!$isGlobal && $payroll->partner_id != $userId) {
            $this->Flash->error(__('You are not authorized to edit this payroll record.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is('ajax') || $this->request->is('json')) {
            $this->autoRender = false;
            $payroll->status = 'Paid';
            $payroll->payment_date = date('Y-m-d');
            $payroll->paid_by = $userId;
            
            if ($this->PtPayrolls->save($payroll)) {
                $metrics = $this->getUpdatedMetrics($isGlobal, $userId);
                echo json_encode([
                    'success' => true,
                    'message' => __('Payroll marked as Paid successfully.'),
                    'metrics' => $metrics
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => __('Failed to update payroll status.')
                ]);
            }
            exit;
        }

        $payroll->status = 'Paid';
        $payroll->payment_date = date('Y-m-d');
        $payroll->paid_by = $userId;

        if ($this->PtPayrolls->save($payroll)) {
            $this->Flash->success(__('Payroll marked as Paid.'));
        } else {
            $this->Flash->error(__('Failed to update payroll status.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Manual PT Class Entry
     */
    public function addClassEntry()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $classEntry = $this->PtClassEntries->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            if (!$isGlobal) {
                // Verify trainer belongs to this partner
                $trainerExists = $this->Users->find()
                    ->where(['id' => $data['trainer_id'], 'partner_id' => $userId, 'user_type' => 4, 'active !=' => '3'])
                    ->first();
                if (!$trainerExists) {
                    $this->Flash->error(__('Invalid trainer selected or unauthorized.'));
                    return $this->redirect(['action' => 'index']);
                }
                $data['partner_id'] = $userId;
            } else {
                $trainer = $this->Users->get($data['trainer_id']);
                $data['partner_id'] = $trainer->partner_id;
            }

            $this->loadModel('UserPtSubscriptions');

            // Auto-detect active subscription if user_pt_subscription_id is missing
            if (!empty($data['user_id']) && empty($data['user_pt_subscription_id'])) {
                $activeSub = $this->UserPtSubscriptions->find()
                    ->where(['user_id' => $data['user_id']])
                    ->order(['id' => 'DESC'])
                    ->first();
                if ($activeSub) {
                    $data['user_pt_subscription_id'] = $activeSub->id;
                }
            }

            if (!empty($data['user_pt_subscription_id'])) {
                $sub = $this->UserPtSubscriptions->get($data['user_pt_subscription_id']);
                $data['user_id'] = $sub->user_id;
                $data['client_per_class_rate'] = $sub->client_per_class_rate;
                $clientRevenue = (int)$data['total_classes'] * (float)$sub->client_per_class_rate;
                $trainerPay = (int)$data['total_classes'] * (float)$data['rate_per_class'];
                $data['gym_profit'] = $clientRevenue - $trainerPay;
            } elseif (!empty($data['user_id'])) {
                $trainerPay = (int)$data['total_classes'] * (float)$data['rate_per_class'];
                $data['client_per_class_rate'] = 0.00;
                $data['gym_profit'] = 0 - $trainerPay;
            }

            $classEntry = $this->PtClassEntries->patchEntity($classEntry, $data);
            $classEntry->created_by = $userId;
            $classEntry->updated_by = $userId;

            if ($this->PtClassEntries->save($classEntry)) {
                if (!empty($sub)) {
                    $db = $this->PtClassEntries->getConnection();
                    $newClasses = (int)$sub->completed_classes + (int)$data['total_classes'];
                    $newStatus = ($newClasses >= (int)$sub->total_classes) ? 'Completed' : 'Active';
                    $db->execute(
                        "UPDATE user_pt_subscriptions SET completed_classes = ?, status = ? WHERE id = ?",
                        [$newClasses, $newStatus, (int)$sub->id]
                    );
                }

                // Check if this trainer has ANY active rate in PtRates
                $activeRate = $this->PtRates->find()
                    ->where(['trainer_id' => $classEntry->trainer_id, 'status' => 1])
                    ->first();
                if (!$activeRate) {
                    $newRate = $this->PtRates->newEntity();
                    $rateData = [
                        'trainer_id' => $classEntry->trainer_id,
                        'partner_id' => $classEntry->partner_id,
                        'rate_per_class' => $classEntry->rate_per_class,
                        'status' => 1,
                        'created_by' => $userId,
                        'updated_by' => $userId
                    ];
                    $newRate = $this->PtRates->patchEntity($newRate, $rateData);
                    $this->PtRates->save($newRate);
                }

                $this->calculateAndSavePayroll($classEntry);
                $this->Flash->success(__('PT Class entry saved and payroll successfully calculated.'));
                return $this->redirect(['action' => 'index']);
            }
            $errStr = [];
            foreach ($classEntry->getErrors() as $field => $errs) {
                $errStr[] = ucfirst($field) . ': ' . implode(', ', (array)$errs);
            }
            $errMsg = !empty($errStr) ? implode(' | ', $errStr) : __('Please check all required fields.');
            $this->Flash->error(__('Failed to save PT Class entry. ') . $errMsg);
        }

        $partners = [];
        if ($isGlobal) {
            $partners = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where(['Users.user_type' => 2, 'Users.active !=' => '3'])
                ->toArray();
        }

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        $userConditions = ['Users.user_type' => 3, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
            $userConditions['Users.partner_id'] = $userId;
        }
        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where($trainerConditions)
            ->toArray();
        $usersList = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where($userConditions)
            ->toArray();

        $this->set(compact('classEntry', 'trainers', 'usersList', 'partners', 'isGlobal'));
    }

    /**
     * Edit PT Class Entry
     */
    public function editClassEntry($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $classEntry = $this->PtClassEntries->get($id, ['contain' => ['Trainers', 'PtPayrolls']]);

        // Lock editing if payroll is Paid
        $payroll = $classEntry->pt_payroll ?: $classEntry->pt_payrolls;
        if ($payroll && $payroll->status === 'Paid') {
            $this->Flash->error(__('This class entry belongs to a Paid payroll record and cannot be edited.'));
            return $this->redirect(['action' => 'index']);
        }

        if (!$isGlobal && $classEntry->partner_id != $userId) {
            $this->Flash->error(__('You are not authorized to edit this class entry.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();
            $classEntry = $this->PtClassEntries->patchEntity($classEntry, $data);
            $classEntry->updated_by = $userId;

            if ($this->PtClassEntries->save($classEntry)) {
                // Check if this trainer has ANY active rate in PtRates
                $activeRate = $this->PtRates->find()
                    ->where(['trainer_id' => $classEntry->trainer_id, 'status' => 1])
                    ->first();
                if (!$activeRate) {
                    // Create a default active rate in PtRates for this trainer
                    $newRate = $this->PtRates->newEntity();
                    $rateData = [
                        'trainer_id' => $classEntry->trainer_id,
                        'partner_id' => $classEntry->partner_id,
                        'rate_per_class' => $classEntry->rate_per_class,
                        'status' => 1,
                        'created_by' => $userId,
                        'updated_by' => $userId
                    ];
                    $newRate = $this->PtRates->patchEntity($newRate, $rateData);
                    $this->PtRates->save($newRate);
                }

                $this->calculateAndSavePayroll($classEntry);
                $this->Flash->success(__('PT Class entry and payroll successfully updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Failed to save class entry.'));
        }

        $this->set(compact('classEntry'));
    }

    /**
     * Trainer PT Rate Management (list)
     */
    public function rates()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $search = [];
        if (!$isGlobal) {
            $search['PtRates.partner_id'] = $userId;
        }

        $trainerId = $this->request->getQuery('trainer_id');
        $partnerId = $this->request->getQuery('partner_id');

        if (!empty($trainerId)) {
            $search['PtRates.trainer_id'] = $trainerId;
        }
        if ($isGlobal && !empty($partnerId)) {
            $search['PtRates.partner_id'] = $partnerId;
        }

        $query = $this->PtRates->find()
            ->contain(['Trainers', 'Partners'])
            ->where($search);

        $rates = $query->order(['PtRates.id' => 'DESC'])->all();

        $partners = [];
        if ($isGlobal) {
            $partners = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where(['Users.user_type' => 2, 'Users.active !=' => '3'])
                ->toArray();
        }

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
        }
        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where($trainerConditions)
            ->toArray();

        $this->set(compact('rates', 'trainers', 'partners', 'isGlobal', 'trainerId', 'partnerId'));
    }

    /**
     * Add PT Rate
     */
    public function addRate()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $rate = $this->PtRates->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            if (!$isGlobal) {
                // Verify trainer belongs to this partner
                $trainerExists = $this->Users->find()
                    ->where(['id' => $data['trainer_id'], 'partner_id' => $userId, 'user_type' => 4, 'active !=' => '3'])
                    ->first();
                if (!$trainerExists) {
                    $this->Flash->error(__('Invalid trainer selected or unauthorized.'));
                    return $this->redirect(['action' => 'rates']);
                }
                $data['partner_id'] = $userId;
            } else {
                $trainer = $this->Users->get($data['trainer_id']);
                $data['partner_id'] = $trainer->partner_id;
            }

            $rate = $this->PtRates->patchEntity($rate, $data);
            $rate->created_by = $userId;
            $rate->updated_by = $userId;

            if ($this->PtRates->save($rate)) {
                if ($rate->status == 1) {
                    $this->PtRates->updateAll(
                        ['status' => 0],
                        ['trainer_id' => $rate->trainer_id, 'id !=' => $rate->id]
                    );
                }
                $this->Flash->success(__('Trainer PT rate added successfully.'));
                return $this->redirect(['action' => 'rates']);
            }
            $this->Flash->error(__('Failed to add PT rate. Please try again.'));
        }

        $partners = [];
        if ($isGlobal) {
            $partners = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where(['Users.user_type' => 2, 'Users.active !=' => '3'])
                ->toArray();
        }

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
        }
        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where($trainerConditions)
            ->toArray();

        $this->set(compact('rate', 'trainers', 'partners', 'isGlobal'));
    }

    /**
     * Edit PT Rate
     */
    public function editRate($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $rate = $this->PtRates->get($id, ['contain' => ['Trainers']]);

        if (!$isGlobal && $rate->partner_id != $userId) {
            $this->Flash->error(__('You are not authorized to edit this rate.'));
            return $this->redirect(['action' => 'rates']);
        }

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();
            $rate = $this->PtRates->patchEntity($rate, $data);
            $rate->updated_by = $userId;

            if ($this->PtRates->save($rate)) {
                if ($rate->status == 1) {
                    $this->PtRates->updateAll(
                        ['status' => 0],
                        ['trainer_id' => $rate->trainer_id, 'id !=' => $rate->id]
                    );
                }
                $this->Flash->success(__('Trainer PT rate updated successfully.'));
                return $this->redirect(['action' => 'rates']);
            }
            $this->Flash->error(__('Failed to update rate. Please try again.'));
        }

        $this->set(compact('rate'));
    }

    /**
     * Delete PT Rate
     */
    public function deleteRate($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $rate = $this->PtRates->get($id);

        if (!$isGlobal && $rate->partner_id != $userId) {
            $this->Flash->error(__('You are not authorized to delete this rate.'));
            return $this->redirect(['action' => 'rates']);
        }

        $this->request->allowMethod(['post', 'delete']);

        if ($this->PtRates->delete($rate)) {
            $this->Flash->success(__('Trainer PT rate deleted.'));
        } else {
            $this->Flash->error(__('Failed to delete rate.'));
        }

        return $this->redirect(['action' => 'rates']);
    }

    /**
     * Payroll History for a Trainer
     */
    public function history($trainerId = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $trainer = $this->Users->get($trainerId);
        if ($trainer->user_type != 4) {
            $this->Flash->error(__('Invalid trainer selected.'));
            return $this->redirect(['action' => 'index']);
        }

        if (!$isGlobal && $trainer->partner_id != $userId) {
            $this->Flash->error(__('You are not authorized to view this trainer\'s history.'));
            return $this->redirect(['action' => 'index']);
        }

        $search = ['PtPayrolls.trainer_id' => $trainerId];
        $month = $this->request->getQuery('month');
        $year = $this->request->getQuery('year');

        if (!empty($month)) {
            $search['PtClassEntries.month'] = $month;
        }
        if (!empty($year)) {
            $search['PtClassEntries.year'] = $year;
        }

        $query = $this->PtPayrolls->find()
            ->contain([
                'PtClassEntries' => ['Users', 'UserPtSubscriptions'], 
                'Partners'
            ])
            ->where($search);

        $history = $query->order(['PtClassEntries.year' => 'DESC', 'PtClassEntries.month' => 'DESC'])->all();

        // Fetch stats across all records for this trainer
        $allPayrolls = $this->PtPayrolls->find()
            ->where(['PtPayrolls.trainer_id' => $trainerId])
            ->all();

        $stats = [
            'totalClasses' => 0,
            'totalPaid' => 0.0,
            'totalPending' => 0.0
        ];

        foreach ($allPayrolls as $p) {
            $stats['totalClasses'] += $p->total_classes;
            if ($p->status === 'Paid') {
                $stats['totalPaid'] += (float)$p->total_amount;
            } else {
                $stats['totalPending'] += (float)$p->total_amount;
            }
        }

        $this->set(compact('trainer', 'history', 'month', 'year', 'stats'));
    }

    /**
     * AJAX endpoint to fetch trainers by partner
     */
    public function getTrainersByPartner($partnerId = null)
    {
        $this->autoRender = false;
        
        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        if (!$isGlobal) {
            $partnerId = $userId;
        }
        
        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $partnerId, 'Users.active !=' => '3'])
            ->toArray();

        echo json_encode($trainers);
        exit;
    }

    /**
     * AJAX endpoint to fetch active PT rate for a trainer
     */
    public function getTrainerActiveRate($trainerId = null)
    {
        $this->autoRender = false;
        
        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        if (!$isGlobal) {
            // Verify that this trainer belongs to the logged-in partner
            $trainerExists = $this->Users->find()
                ->where(['id' => $trainerId, 'partner_id' => $userId, 'user_type' => 4, 'active !=' => '3'])
                ->first();
            if (!$trainerExists) {
                echo json_encode(['rate' => 0.00, 'error' => 'Unauthorized']);
                exit;
            }
        }

        $activeRate = $this->PtRates->find()
            ->where(['trainer_id' => $trainerId, 'status' => 1])
            ->first();
        
        $rate = $activeRate ? $activeRate->rate_per_class : 0.00;
        echo json_encode(['rate' => $rate]);
        exit;
    }

    /**
     * Reports method
     */
    public function reports()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $search = [];
        if (!$isGlobal) {
            $search['PtPayrolls.partner_id'] = $userId;
        }

        $trainerId = $this->request->getQuery('trainer_id');
        $partnerId = $this->request->getQuery('partner_id');
        $month = $this->request->getQuery('month');
        $year = $this->request->getQuery('year');
        $status = $this->request->getQuery('status');

        if (!empty($trainerId)) {
            $search['PtPayrolls.trainer_id'] = $trainerId;
        }
        if ($isGlobal && !empty($partnerId)) {
            $search['PtPayrolls.partner_id'] = $partnerId;
        }
        if (!empty($month)) {
            $search['PtClassEntries.month'] = $month;
        }
        if (!empty($year)) {
            $search['PtClassEntries.year'] = $year;
        }
        if (!empty($status)) {
            $search['PtPayrolls.status'] = $status;
        }

        $payrolls = $this->PtPayrolls->find()
            ->contain(['Trainers', 'Partners', 'PtClassEntries'])
            ->where($search)
            ->order(['PtPayrolls.id' => 'DESC'])
            ->all();

        $partners = [];
        if ($isGlobal) {
            $partners = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where(['Users.user_type' => 2, 'Users.active !=' => '3'])
                ->toArray();
        }

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
        }
        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->where($trainerConditions)
            ->toArray();

        $this->set(compact('payrolls', 'trainers', 'partners', 'isGlobal', 'trainerId', 'partnerId', 'month', 'year', 'status'));
    }

    /**
     * Export report to Excel
     */
    public function exportExcel()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $search = [];
        if (!$isGlobal) {
            $search['PtPayrolls.partner_id'] = $userId;
        }

        $trainerId = $this->request->getQuery('trainer_id');
        $partnerId = $this->request->getQuery('partner_id');
        $month = $this->request->getQuery('month');
        $year = $this->request->getQuery('year');
        $status = $this->request->getQuery('status');

        if (!empty($trainerId)) {
            $search['PtPayrolls.trainer_id'] = $trainerId;
        }
        if ($isGlobal && !empty($partnerId)) {
            $search['PtPayrolls.partner_id'] = $partnerId;
        }
        if (!empty($month)) {
            $search['PtClassEntries.month'] = $month;
        }
        if (!empty($year)) {
            $search['PtClassEntries.year'] = $year;
        }
        if (!empty($status)) {
            $search['PtPayrolls.status'] = $status;
        }

        $payrolls = $this->PtPayrolls->find()
            ->contain(['Trainers', 'Partners', 'PtClassEntries'])
            ->where($search)
            ->order(['PtPayrolls.id' => 'DESC'])
            ->all();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('PT Payroll Report');

        $headers = [
            'Trainer Name', 'Partner Name', 'Month / Year', 'Classes Completed', 
            'Rate Per Class', 'Total Amount', 'Status', 'Payment Date'
        ];

        $colIdx = 1;
        foreach ($headers as $h) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
            $sheet->setCellValue($colLetter . '1', $h);
            $colIdx++;
        }

        $rowIdx = 2;
        foreach ($payrolls as $p) {
            $monthName = date('F', mktime(0, 0, 0, $p->pt_class_entry->month, 10));
            $sheet->setCellValue('A' . $rowIdx, $p->trainer->name);
            $sheet->setCellValue('B' . $rowIdx, $p->partner->name);
            $sheet->setCellValue('C' . $rowIdx, $monthName . ' ' . $p->pt_class_entry->year);
            $sheet->setCellValue('D' . $rowIdx, $p->total_classes);
            $sheet->setCellValue('E' . $rowIdx, $p->rate_per_class);
            $sheet->setCellValue('F' . $rowIdx, $p->total_amount);
            $sheet->setCellValue('G' . $rowIdx, $p->status);
            $sheet->setCellValue('H' . $rowIdx, $p->payment_date ? $p->payment_date->format('d-m-Y') : 'N/A');
            $rowIdx++;
        }

        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        for ($c = 1; $c <= 8; $c++) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($c);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        $this->autoRender = false;
        
        $this->response = $this->response->withType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->withHeader('Content-Disposition', 'attachment; filename="pt_payroll_report_' . date('Ymd_His') . '.xlsx"');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        $tempFile = tempnam(sys_get_temp_dir(), 'xlsx');
        $writer->save($tempFile);
        
        $xlsxContent = file_get_contents($tempFile);
        unlink($tempFile);
        
        $response = $this->response->withStringBody($xlsxContent);
        return $response;
    }

    /**
     * Calculate and Save/Update Payroll record helper
     */
    private function calculateAndSavePayroll($classEntry)
    {
        $rateVal = 0.00;
        if (isset($classEntry->rate_per_class) && $classEntry->rate_per_class !== '' && $classEntry->rate_per_class !== null) {
            $rateVal = (float)$classEntry->rate_per_class;
        } else {
            $activeRate = $this->PtRates->find()
                ->where(['trainer_id' => $classEntry->trainer_id, 'status' => 1])
                ->first();
            $rateVal = $activeRate ? $activeRate->rate_per_class : 0.00;
            
            // Store back to class entry to keep it in sync
            $classEntry->rate_per_class = $rateVal;
            $this->PtClassEntries->save($classEntry);
        }

        $totalAmount = $classEntry->total_classes * $rateVal;

        $payroll = $this->PtPayrolls->find()
            ->where(['class_entry_id' => $classEntry->id])
            ->first();

        if (!$payroll) {
            $payroll = $this->PtPayrolls->newEntity();
            $payroll->status = 'Pending';
        }

        $payroll->partner_id = $classEntry->partner_id;
        $payroll->trainer_id = $classEntry->trainer_id;
        $payroll->class_entry_id = $classEntry->id;
        $payroll->rate_per_class = $rateVal;
        $payroll->total_classes = $classEntry->total_classes;
        $payroll->total_amount = $totalAmount;

        return $this->PtPayrolls->save($payroll);
    }

    /**
     * AJAX action to save class entry and rate per class inline
     */
    public function saveInlinePayroll()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);

        $redirect = $this->checkAccess();
        if ($redirect) {
            echo json_encode(['success' => false, 'message' => __('Access denied.')]);
            exit;
        }

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $payrollId = $this->request->getData('payroll_id');
        if (empty($payrollId)) {
            echo json_encode(['success' => false, 'message' => __('Missing payroll ID.')]);
            exit;
        }

        $payroll = $this->PtPayrolls->get($payrollId, [
            'contain' => ['PtClassEntries']
        ]);

        if (!$payroll) {
            echo json_encode(['success' => false, 'message' => __('Payroll record not found.')]);
            exit;
        }

        // Check ownership
        if (!$isGlobal && $payroll->partner_id != $userId) {
            echo json_encode(['success' => false, 'message' => __('You are not authorized to edit this record.')]);
            exit;
        }

        // Lock if Paid
        if ($payroll->status === 'Paid') {
            echo json_encode(['success' => false, 'message' => __('Paid payroll records cannot be edited.')]);
            exit;
        }

        $totalClasses = $this->request->getData('total_classes');
        $ratePerClass = $this->request->getData('rate_per_class');

        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $connection->begin();

        try {
            $classEntry = $payroll->pt_class_entry;

            if ($totalClasses !== null) {
                $classEntry->total_classes = (int)$totalClasses;
            }
            if ($ratePerClass !== null) {
                $classEntry->rate_per_class = (float)$ratePerClass;
            }
            $classEntry->updated_by = $userId;

            if (!$this->PtClassEntries->save($classEntry)) {
                throw new \Exception(__('Failed to save class entry.'));
            }

            // Update payroll values
            $payroll->total_classes = $classEntry->total_classes;
            $payroll->rate_per_class = $classEntry->rate_per_class;
            $payroll->total_amount = $payroll->total_classes * $payroll->rate_per_class;

            if (!$this->PtPayrolls->save($payroll)) {
                throw new \Exception(__('Failed to save payroll calculation.'));
            }

            $connection->commit();

            $metrics = $this->getUpdatedMetrics($isGlobal, $userId);

            echo json_encode([
                'success' => true,
                'message' => __('Updated successfully.'),
                'total_amount' => number_format($payroll->total_amount, 2),
                'metrics' => $metrics
            ]);
            exit;

        } catch (\Exception $e) {
            $connection->rollback();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    /**
     * Get updated monthly dashboard metrics
     */
    private function getUpdatedMetrics($isGlobal, $userId)
    {
        $currentMonth = (int)date('m');
        $currentYear = (int)date('Y');

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
        }
        $totalTrainers = $this->Users->find()->where($trainerConditions)->count();

        $classConditions = ['PtClassEntries.month' => $currentMonth, 'PtClassEntries.year' => $currentYear];
        if (!$isGlobal) {
            $classConditions['PtClassEntries.partner_id'] = $userId;
        }
        $totalClasses = $this->PtClassEntries->find()->where($classConditions)->sumOf('total_classes') ?: 0;

        $payrollConditions = ['PtClassEntries.month' => $currentMonth, 'PtClassEntries.year' => $currentYear];
        if (!$isGlobal) {
            $payrollConditions['PtPayrolls.partner_id'] = $userId;
        }
        $totalPayrollAmount = $this->PtPayrolls->find()
            ->contain(['PtClassEntries'])
            ->where($payrollConditions)
            ->sumOf('total_amount') ?: 0;

        $pendingConditions = [
            'PtClassEntries.month' => $currentMonth, 
            'PtClassEntries.year' => $currentYear, 
            'PtPayrolls.status' => 'Pending'
        ];
        if (!$isGlobal) {
            $pendingConditions['PtPayrolls.partner_id'] = $userId;
        }
        $pendingPayroll = $this->PtPayrolls->find()
            ->contain(['PtClassEntries'])
            ->where($pendingConditions)
            ->sumOf('total_amount') ?: 0;

        return [
            'totalTrainers' => $totalTrainers,
            'totalClasses' => $totalClasses,
            'totalPayrollAmount' => number_format($totalPayrollAmount, 2),
            'pendingPayroll' => number_format($pendingPayroll, 2)
        ];
    }

    /**
     * Client PT Revenue & Trainer Share Report
     */
    public function clientReport()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $this->loadModel('UserPtSubscriptions');

        // Auto-repair any pt_class_entries that have NULL user_pt_subscription_id or NULL user_id
        $db = $this->PtClassEntries->getConnection();
        $db->execute("
            UPDATE pt_class_entries ce
            JOIN user_pt_subscriptions sub ON sub.trainer_id = ce.trainer_id
            SET ce.user_id = sub.user_id, ce.user_pt_subscription_id = sub.id, ce.client_per_class_rate = sub.client_per_class_rate, ce.gym_profit = (ce.total_classes * sub.client_per_class_rate) - (ce.total_classes * ce.rate_per_class)
            WHERE ce.user_id IS NULL OR ce.user_pt_subscription_id IS NULL
        ");

        $search = [];
        if (!$isGlobal) {
            $search['UserPtSubscriptions.partner_id'] = $userId;
        }

        $trainerId = $this->request->getQuery('trainer_id');
        $userIdFilter = $this->request->getQuery('user_id');

        if (!empty($trainerId)) {
            $search['UserPtSubscriptions.trainer_id'] = $trainerId;
        }
        if (!empty($userIdFilter)) {
            $search['UserPtSubscriptions.user_id'] = $userIdFilter;
        }

        $subscriptions = $this->UserPtSubscriptions->find()
            ->contain(['Users', 'Trainers', 'Partners', 'PtPlans'])
            ->where($search)
            ->order(['UserPtSubscriptions.id' => 'DESC'])
            ->all();

        $reportData = [];
        $totalClientRevenue = 0;
        $totalTrainerPayout = 0;
        $totalGymProfit = 0;

        foreach ($subscriptions as $sub) {
            $entries = $this->PtClassEntries->find()
                ->where(['OR' => [
                    ['user_pt_subscription_id' => $sub->id],
                    ['user_id' => $sub->user_id]
                ]])
                ->all();

            $conductedClasses = 0;
            $trainerPayout = 0;
            $clientRevenue = 0;

            foreach ($entries as $entry) {
                $conductedClasses += (int)$entry->total_classes;
                $trainerPayout += ((int)$entry->total_classes * (float)$entry->rate_per_class);
                $cRate = (float)($entry->client_per_class_rate > 0 ? $entry->client_per_class_rate : $sub->client_per_class_rate);
                $clientRevenue += ((int)$entry->total_classes * $cRate);
            }

            $gymProfit = $clientRevenue - $trainerPayout;
            $remainingClasses = max(0, (int)$sub->total_classes - $conductedClasses);

            $totalClientRevenue += $clientRevenue;
            $totalTrainerPayout += $trainerPayout;
            $totalGymProfit += $gymProfit;

            $reportData[] = [
                'subscription' => $sub,
                'conducted_classes' => $conductedClasses,
                'client_revenue' => $clientRevenue,
                'trainer_payout' => $trainerPayout,
                'gym_profit' => $gymProfit,
                'remaining_classes' => $remainingClasses
            ];
        }

        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => '3'];
        $userConditions = ['Users.user_type' => 3, 'Users.active !=' => '3'];
        if (!$isGlobal) {
            $trainerConditions['Users.partner_id'] = $userId;
            $userConditions['Users.partner_id'] = $userId;
        }

        $trainers = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where($trainerConditions)->toArray();
        $usersList = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where($userConditions)->toArray();

        $this->set(compact('reportData', 'trainers', 'usersList', 'isGlobal', 'trainerId', 'userIdFilter', 'totalClientRevenue', 'totalTrainerPayout', 'totalGymProfit'));
    }

    public function beforeRender(Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
