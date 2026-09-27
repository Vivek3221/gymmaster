<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * PlanSubscribers Controller
 *
 * @property \App\Model\Table\PlanSubscribersTable $PlanSubscribers
 *
 * @method \App\Model\Entity\PlanSubscriber[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlanSubscribersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        if (!empty($this->usersdetail['users_type'])) {
            $userType = $this->usersdetail['users_type'];
            $action = $this->request->getParam('action');
            // Block Trainers completely from PlanSubscribers
            if ($userType == 3) {
                $this->Flash->error(__('Access Denied. Trainers are not allowed to view or manage plan subscriptions.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
            }
            // Block Front Desk (user_type == 5) from editing, deleting, exporting, or viewing reports for plan subscriptions
            if ($userType == 5 && in_array($action, ['edit', 'delete', 'export', 'report'])) {
                $this->Flash->error(__('Front Desk role is restricted from editing, exporting, or viewing reports for plan subscriptions.'));
                return $this->redirect(['controller' => 'PlanSubscribers', 'action' => 'index']);
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $this->Users    = TableRegistry::get('Users');
        $name = '';
        $mode_ofpay = '';
        $norec = 10;
        $status = '';
        $user_type = '';
        $partner   ='';
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        
        $fee_filter = '';
        $paid_fee_filter = '';
        $remain_fee_filter = '';
        $due_date_from = '';
        $due_date_to = '';

        // Exclude manual collection entries from regular list
        $search['PlanSubscribers.collection_type !='] = 'manual';

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = str_replace(',','',$this->request->query['name']);
            $search['OR'] = ['PlanSubscribers.fee'=>$name,'Users.name REGEXP'=>$name,'PlanSubscribers.plan_name REGEXP'=>$name];
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['PlanSubscribers.partner_id'] = $partner;
        }
        if (isset($this->request->query['payments']) && trim($this->request->query['payments']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.payment_due_date <'] = $payment;
        }
        if (isset($this->request->query['planexp']) && trim($this->request->query['planexp']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.plan_expire_date <'] = $payment;
        }
        
        // Due Date Filters
        if (isset($this->request->query['due_date_from']) && trim($this->request->query['due_date_from']) != "") {
            $due_date_from = $this->request->query['due_date_from'];
            $search['PlanSubscribers.payment_due_date >='] = $due_date_from;
        }
        if (isset($this->request->query['due_date_to']) && trim($this->request->query['due_date_to']) != "") {
            $due_date_to = $this->request->query['due_date_to'];
            $search['PlanSubscribers.payment_due_date <='] = $due_date_to;
        }
        
        // Advanced fee filters (range based)
        if (isset($this->request->query['paid_fee']) && trim($this->request->query['paid_fee']) != "") {
            $paid_fee_filter = $this->request->query['paid_fee'];
            $paymentsTable = \Cake\ORM\TableRegistry::get('Payments');
            $subquery = $paymentsTable->find();
            $subquery->select($subquery->newExpr('COALESCE(SUM(amount), 0)'))
                     ->where(['plan_subscriber_id' => new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.id'), 'is_deleted' => 0]);

            if ($paid_fee_filter === '0') {
                $search[] = function ($exp, $q) use ($subquery) {
                    return $exp->eq($subquery, 0);
                };
            } elseif (strpos($paid_fee_filter, '-') !== false) {
                list($min, $max) = explode('-', $paid_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    return $exp->gte($subquery, (float)$min);
                };
                $search[] = function ($exp, $q) use ($subquery, $max) {
                    return $exp->lte($subquery, (float)$max);
                };
            } elseif (strpos($paid_fee_filter, '+') !== false) {
                $min = str_replace('+', '', $paid_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    return $exp->gte($subquery, (float)$min);
                };
            }
        }
        if (isset($this->request->query['remain_fee']) && trim($this->request->query['remain_fee']) != "") {
            $remain_fee_filter = $this->request->query['remain_fee'];
            $paymentsTable = \Cake\ORM\TableRegistry::get('Payments');
            $subquery = $paymentsTable->find();
            $subquery->select($subquery->newExpr('COALESCE(SUM(amount), 0)'))
                     ->where(['plan_subscriber_id' => new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.id'), 'is_deleted' => 0]);

            if ($remain_fee_filter === '0') {
                $search[] = function ($exp, $q) use ($subquery) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->eq($remainFeeExpr, 0);
                };
            } elseif (strpos($remain_fee_filter, '-') !== false) {
                list($min, $max) = explode('-', $remain_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->gte($remainFeeExpr, (float)$min);
                };
                $search[] = function ($exp, $q) use ($subquery, $max) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->lte($remainFeeExpr, (float)$max);
                };
            } elseif (strpos($remain_fee_filter, '+') !== false) {
                $min = str_replace('+', '', $remain_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->gte($remainFeeExpr, (float)$min);
                };
            }
        }

        // Calculate card values using SQL subqueries for robustness
        $matchedQuery = $this->PlanSubscribers->find()
            ->contain(['Users'])
            ->select(['id'])
            ->where($search)
            ->where(['Users.active !=' => '3','Users.user_type !='=>'1']);

        // Sum of total fee
        $totalFeeQuery = $this->PlanSubscribers->find()
            ->select(['total' => 'SUM(fee)'])
            ->where(['id IN' => $matchedQuery]);
        $amount = $totalFeeQuery->first()->total ?? 0;

        // Sum of paid fee
        $paymentsTable = TableRegistry::get('Payments');
        $totalPaidQuery = $paymentsTable->find()
            ->select(['total' => 'SUM(amount)'])
            ->where(['plan_subscriber_id IN' => $matchedQuery, 'is_deleted' => 0]);
        $totalPaid = $totalPaidQuery->first()->total ?? 0;

        // Sum of discount
        $totalDiscQuery = $paymentsTable->find()
            ->select(['total' => 'SUM(discount_amount)'])
            ->where(['plan_subscriber_id IN' => $matchedQuery, 'is_deleted' => 0]);
        $totalDiscount = $totalDiscQuery->first()->total ?? 0;

        // Remaining fee
        $totalRemaining = max(0, $amount - $totalDiscount - $totalPaid);

        $this->PlanSubscribers = $this->PlanSubscribers->find('all')
            ->contain(['Users'])
            ->where($search)
            ->where(['Users.active !=' => '3','Users.user_type !='=>'1']);

        $partners =  $this->Users->find('list')
                                 ->select(['id','name'])
                                 ->where(['user_type'=> 2])
                                 ->toArray();
        $this->paginate = [
            'limit' => $norec,
            'contain' => ['Users', 'Partners', 'Payments' => function ($q) {
                return $q->where(['Payments.is_deleted' => 0]);
            }],
            'order' => ['id' => 'DESC']
        ];
        $planSubscribers = $this->paginate($this->PlanSubscribers);
        $this->set(compact('planSubscribers','users', 'name', 'status', 'norec','mode_ofpay','user_type','users_type','partners','partner','amount','totalPaid','totalRemaining','fee_filter','paid_fee_filter','remain_fee_filter', 'due_date_from', 'due_date_to'));
    }

    public function export()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $this->Users    = TableRegistry::get('Users');
        $name = '';
        $partner   ='';
        $search = [];
        $search['PlanSubscribers.collection_type !='] = 'manual';
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['PlanSubscribers.partner_id'] = $users_id;
        }
        
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = str_replace(',','',$this->request->query['name']);
            $search['OR'] = ['PlanSubscribers.fee'=>$name,'Users.name REGEXP'=>$name,'PlanSubscribers.plan_name REGEXP'=>$name];
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['PlanSubscribers.partner_id'] = $partner;
        }
        if (isset($this->request->query['payments']) && trim($this->request->query['payments']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.payment_due_date <'] = $payment;
        }
        if (isset($this->request->query['planexp']) && trim($this->request->query['planexp']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.plan_expire_date <'] = $payment;
        }
        
        // Due Date Filters
        if (isset($this->request->query['due_date_from']) && trim($this->request->query['due_date_from']) != "") {
            $search['PlanSubscribers.payment_due_date >='] = $this->request->query['due_date_from'];
        }
        if (isset($this->request->query['due_date_to']) && trim($this->request->query['due_date_to']) != "") {
            $search['PlanSubscribers.payment_due_date <='] = $this->request->query['due_date_to'];
        }
        
        // Advanced fee filters (range based)
        if (isset($this->request->query['paid_fee']) && trim($this->request->query['paid_fee']) != "") {
            $paid_fee_filter = $this->request->query['paid_fee'];
            $paymentsTable = \Cake\ORM\TableRegistry::get('Payments');
            $subquery = $paymentsTable->find();
            $subquery->select($subquery->newExpr('COALESCE(SUM(amount), 0)'))
                     ->where(['plan_subscriber_id' => new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.id')]);

            if ($paid_fee_filter === '0') {
                $search[] = function ($exp, $q) use ($subquery) {
                    return $exp->eq($subquery, 0);
                };
            } elseif (strpos($paid_fee_filter, '-') !== false) {
                list($min, $max) = explode('-', $paid_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    return $exp->gte($subquery, (float)$min);
                };
                $search[] = function ($exp, $q) use ($subquery, $max) {
                    return $exp->lte($subquery, (float)$max);
                };
            } elseif (strpos($paid_fee_filter, '+') !== false) {
                $min = str_replace('+', '', $paid_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    return $exp->gte($subquery, (float)$min);
                };
            }
        }
        if (isset($this->request->query['remain_fee']) && trim($this->request->query['remain_fee']) != "") {
            $remain_fee_filter = $this->request->query['remain_fee'];
            $paymentsTable = \Cake\ORM\TableRegistry::get('Payments');
            $subquery = $paymentsTable->find();
            $subquery->select($subquery->newExpr('COALESCE(SUM(amount), 0)'))
                     ->where(['plan_subscriber_id' => new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.id')]);

            if ($remain_fee_filter === '0') {
                $search[] = function ($exp, $q) use ($subquery) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->eq($remainFeeExpr, 0);
                };
            } elseif (strpos($remain_fee_filter, '-') !== false) {
                list($min, $max) = explode('-', $remain_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->gte($remainFeeExpr, (float)$min);
                };
                $search[] = function ($exp, $q) use ($subquery, $max) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->lte($remainFeeExpr, (float)$max);
                };
            } elseif (strpos($remain_fee_filter, '+') !== false) {
                $min = str_replace('+', '', $remain_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->gte($remainFeeExpr, (float)$min);
                };
            }
        }

        $planSubscribers = $this->PlanSubscribers->find('all')
            ->contain([
                'Users' => ['Partners', 'AddedByUsers'], 
                'Partners', 
                'Payments' => function ($q) {
                    return $q->where(['Payments.is_deleted' => 0]);
                }
            ])
            ->where($search)
            ->where(['Users.active !=' => '3', 'Users.user_type !=' => '1'])
            ->order(['PlanSubscribers.id' => 'DESC'])
            ->all();

        // Group subscribers by Financial Year (FY: 1 April to 31 March)
        $groupedSubscribers = [];
        foreach ($planSubscribers as $ps) {
            $fys = [];
            $startDateStr = !empty($ps->subscription_start_date) ? $ps->subscription_start_date->format('Y-m-d') : $ps->created->format('Y-m-d');
            $endDateStr = $ps->plan_expire_date->format('Y-m-d');

            $startFY = ((int)date('n', strtotime($startDateStr)) >= 4) ? (int)date('Y', strtotime($startDateStr)) : ((int)date('Y', strtotime($startDateStr)) - 1);
            $endFY = ((int)date('n', strtotime($endDateStr)) >= 4) ? (int)date('Y', strtotime($endDateStr)) : ((int)date('Y', strtotime($endDateStr)) - 1);

            for ($y = $startFY; $y <= $endFY; $y++) {
                $fys[] = $y;
            }

            if (!empty($ps->payments)) {
                foreach ($ps->payments as $pm) {
                    if ($pm->is_deleted == 0) {
                        $payDateStr = !empty($pm->payment_date) ? $pm->payment_date->format('Y-m-d') : $pm->created->format('Y-m-d');
                        $payFY = ((int)date('n', strtotime($payDateStr)) >= 4) ? (int)date('Y', strtotime($payDateStr)) : ((int)date('Y', strtotime($payDateStr)) - 1);
                        $fys[] = $payFY;
                    }
                }
            }

            $fys = array_unique($fys);
            foreach ($fys as $fy) {
                $groupedSubscribers[$fy][] = $ps;
            }
        }

        if (!isset($groupedSubscribers[2026])) {
            $groupedSubscribers[2026] = [];
        }
        
        // Sort years chronologically
        ksort($groupedSubscribers);

        // Initialize spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->removeSheetByIndex(0); // Remove default sheet

        if (empty($groupedSubscribers)) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle((string)date('Y'));
            $sheet->setCellValue('A1', 'No data available');
        } else {
            foreach ($groupedSubscribers as $year => $subscribersInYear) {
                $sheet = $spreadsheet->createSheet();
                $sheet->setTitle((string)$year);

                $fyStart = "{$year}-04-01";
                $fyEnd = ($year + 1) . "-03-31";

                // Fixed 12 months for this financial year (April to March)
                $months = [];
                for ($m = 4; $m <= 12; $m++) {
                    $months[] = date('Y-m-t', strtotime("{$year}-{$m}-01"));
                }
                $nextYear = $year + 1;
                for ($m = 1; $m <= 3; $m++) {
                    $months[] = date('Y-m-t', strtotime("{$nextYear}-{$m}-01"));
                }

                // Gather payments made within this financial year
                $subscriberPayments = [];
                $paymentDates = [];
                foreach ($subscribersInYear as $ps) {
                    $subId = $ps->id;
                    $subscriberPayments[$subId] = [];
                    if (!empty($ps->payments)) {
                        foreach ($ps->payments as $p) {
                            if ($p->is_deleted == 0) {
                                $pDate = !empty($p->payment_date) ? $p->payment_date->format('Y-m-d') : $p->created->format('Y-m-d');
                                if ($pDate >= $fyStart && $pDate <= $fyEnd) {
                                    $dateStr = date('d-m-Y', strtotime($pDate));
                                    $paymentDates[$dateStr] = $dateStr;
                                    if (!isset($subscriberPayments[$subId][$dateStr])) {
                                        $subscriberPayments[$subId][$dateStr] = 0;
                                    }
                                    $subscriberPayments[$subId][$dateStr] += (float)$p->amount;
                                }
                            }
                        }
                    }
                }
                uksort($paymentDates, function($a, $b) {
                    return strtotime($a) - strtotime($b);
                });

                // Precalculate data rows and totals
                $dataRows = [];
                $monthActiveCounts = array_fill_keys($months, 0);
                $monthTotals = array_fill_keys($months, 0);

                foreach ($subscribersInYear as $row) {
                    $startDateStr = (!empty($row->subscription_start_date)) ? $row->subscription_start_date->format('Y-m-d') : $row->created->format('Y-m-d');
                    $endDateStr = $row->plan_expire_date->format('Y-m-d');
                    
                    $totalDays = round((strtotime($endDateStr) - strtotime($startDateStr)) / 86400) + 1;
                    if ($totalDays <= 0) {
                        $totalDays = 1;
                    }
                    $dailyRate = $row->fee / $totalDays;
                    
                    $start = new \DateTime($startDateStr);
                    $end = new \DateTime($endDateStr);
                    $diff = $start->diff($end);
                    $monthsCount = $diff->y * 12 + $diff->m;
                    if ($diff->d >= 1) {
                        $monthsCount += 1;
                    }
                    if ($monthsCount <= 0) {
                        $monthsCount = 1;
                    }
                    
                    $today = strtotime(date('Y-m-d'));
                    $expireTime = strtotime($endDateStr);
                    $pendingDays = 0;
                    if ($expireTime > $today) {
                        $pendingDays = round(($expireTime - $today) / 86400);
                    }
                    $pendingAmount = round($pendingDays * $dailyRate, 2);

                    // Calculate actual paid fee from payments
                    $totalPaid = 0;
                    if (!empty($row->payments)) {
                        foreach ($row->payments as $pm) {
                            if ($pm->is_deleted == 0) {
                                $totalPaid += (float)$pm->amount;
                            }
                        }
                    }
                    $totalDue = max(0, (float)$row->fee - $totalPaid);

                    // Determine who added this subscriber
                    $addedByName = 'Admin';
                    if (!empty($row->user->added_by_user->name)) {
                        $addedByName = $row->user->added_by_user->name;
                    } elseif (!empty($row->user->partner->name)) {
                        $addedByName = $row->user->partner->name;
                    } elseif (!empty($row->partner->name)) {
                        $addedByName = $row->partner->name;
                    }
                    
                    $subscriberRow = [
                        'id' => $row->id,
                        'name' => ucwords($row->user->name),
                        'added_by' => $addedByName,
                        'joining_date' => $row->created->format('d-m-Y'),
                        'membership' => $monthsCount,
                        'total_amount' => (float)$row->fee,
                        'paid_amount' => $totalPaid,
                        'due_amount' => $totalDue,
                        'end_date' => date("d-m-Y", strtotime($row->plan_expire_date)),
                        'pending_days' => $pendingDays,
                        'pending_amount' => $pendingAmount,
                        'days' => $totalDays,
                        'daily_amt' => round($dailyRate, 2)
                    ];
                    
                    // Month columns values
                    $subscriberRow['months'] = [];
                    foreach ($months as $m) {
                        $monthStart = date('Y-m-01', strtotime($m));
                        $monthEnd = $m;
                        
                        $overlapStart = max(strtotime($startDateStr), strtotime($monthStart));
                        $overlapEnd = min(strtotime($endDateStr), strtotime($monthEnd));
                        
                        if ($overlapStart <= $overlapEnd) {
                            $overlapDays = round(($overlapEnd - $overlapStart) / 86400) + 1;
                            $val = round($overlapDays * $dailyRate, 2);
                        } else {
                            $val = 0;
                        }
                        
                        $subscriberRow['months'][$m] = $val;
                        
                        if ($val > 0) {
                            $monthActiveCounts[$m] += 1;
                            $monthTotals[$m] += $val;
                        }
                    }
                    
                    // Payment columns values
                    $subscriberRow['payments'] = [];
                    foreach ($paymentDates as $d) {
                        $subscriberRow['payments'][$d] = $subscriberPayments[$row->id][$d] ?? 0;
                    }
                    
                    $dataRows[] = $subscriberRow;
                }

                // Write ACTIVE MEMBERS Row
                $sheet->setCellValue('A1', 'ACTIVE MEMBERS');
                $colIdx = 13;
                foreach ($months as $m) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                    $sheet->setCellValueExplicit($colLetter . '1', $monthActiveCounts[$m], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    $colIdx++;
                }

                // Write AMOUNT/MONTH Row
                $sheet->setCellValue('A2', 'AMOUNT/MONTH');
                $colIdx = 13;
                foreach ($months as $m) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                    $sheet->setCellValueExplicit($colLetter . '2', round($monthTotals[$m], 2), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    $colIdx++;
                }

                // Write Header Row (Row 3)
                $headers = [
                    'NAME', 'ADDED BY', 'DATE OF JOINING', 'MEMBERSHIP', 'TOTAL AMOUNT', 'PAID AMOUNT', 
                    'DUE AMOUNT', 'MEMBERSHIP END DATE', 'MEMBERSHIP PENDING IN DAYS', 
                    'MEMBERSHIP PENIDNG IN AMOUNT', 'Days', 'Daily Amt'
                ];
                $colIdx = 1;
                foreach ($headers as $h) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                    $sheet->setCellValue($colLetter . '3', $h);
                    $colIdx++;
                }
                foreach ($months as $m) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                    $sheet->setCellValue($colLetter . '3', date('d-m-Y', strtotime($m)));
                    $colIdx++;
                }
                foreach ($paymentDates as $d) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                    $sheet->setCellValue($colLetter . '3', 'Paid on ' . $d);
                    $colIdx++;
                }

                // Write Data Rows
                $rowIdx = 4;
                foreach ($dataRows as $r) {
                    $sheet->setCellValue('A' . $rowIdx, $r['name']);
                    $sheet->setCellValue('B' . $rowIdx, $r['added_by']);
                    $sheet->setCellValue('C' . $rowIdx, $r['joining_date']);
                    $sheet->setCellValue('D' . $rowIdx, $r['membership']);
                    $sheet->setCellValue('E' . $rowIdx, $r['total_amount']);
                    $sheet->setCellValue('F' . $rowIdx, $r['paid_amount']);
                    $sheet->setCellValue('G' . $rowIdx, $r['due_amount']);
                    $sheet->setCellValue('H' . $rowIdx, $r['end_date']);
                    $sheet->setCellValue('I' . $rowIdx, $r['pending_days']);
                    $sheet->setCellValue('J' . $rowIdx, $r['pending_amount']);
                    $sheet->setCellValue('K' . $rowIdx, $r['days']);
                    $sheet->setCellValue('L' . $rowIdx, $r['daily_amt']);
                    
                    $colIdx = 13;
                    foreach ($months as $m) {
                        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                        $sheet->setCellValue($colLetter . $rowIdx, $r['months'][$m]);
                        $colIdx++;
                    }
                    foreach ($paymentDates as $d) {
                        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
                        $sheet->setCellValue($colLetter . $rowIdx, $r['payments'][$d]);
                        $colIdx++;
                    }
                    $rowIdx++;
                }

                // Apply Styling
                $highestCol = $sheet->getHighestColumn();
                $sheet->getStyle('A1:' . $highestCol . '3')->getFont()->setBold(true);
                
                // Autofit columns
                $highestColIdx = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestCol);
                for ($c = 1; $c <= $highestColIdx; $c++) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($c);
                    $sheet->getColumnDimension($colLetter)->setAutoSize(true);
                }
            }
        }

        $this->autoRender = false;
        
        // Set xlsx download headers
        $this->response = $this->response->withType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->withHeader('Content-Disposition', 'attachment; filename="plan_subscribers_' . date('Ymd_His') . '.xlsx"');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        // Write xlsx output to a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'xlsx');
        $writer->save($tempFile);
        
        $xlsxContent = file_get_contents($tempFile);
        unlink($tempFile);
        
        $response = $this->response->withStringBody($xlsxContent);
        return $response;
    }

    public function report()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $this->Users    = TableRegistry::get('Users');
        $name = '';
        $partner   ='';
        $search = [];
        $search['PlanSubscribers.collection_type !='] = 'manual';
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['PlanSubscribers.partner_id'] = $users_id;
        }
        
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = str_replace(',','',$this->request->query['name']);
            $search['OR'] = ['PlanSubscribers.fee'=>$name,'Users.name REGEXP'=>$name,'PlanSubscribers.plan_name REGEXP'=>$name];
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['PlanSubscribers.partner_id'] = $partner;
        }
        if (isset($this->request->query['payments']) && trim($this->request->query['payments']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.payment_due_date <'] = $payment;
        }
        if (isset($this->request->query['planexp']) && trim($this->request->query['planexp']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.plan_expire_date <'] = $payment;
        }
        
        // Due Date Filters
        if (isset($this->request->query['due_date_from']) && trim($this->request->query['due_date_from']) != "") {
            $search['PlanSubscribers.payment_due_date >='] = $this->request->query['due_date_from'];
        }
        if (isset($this->request->query['due_date_to']) && trim($this->request->query['due_date_to']) != "") {
            $search['PlanSubscribers.payment_due_date <='] = $this->request->query['due_date_to'];
        }
        
        // Advanced fee filters (range based)
        if (isset($this->request->query['paid_fee']) && trim($this->request->query['paid_fee']) != "") {
            $paid_fee_filter = $this->request->query['paid_fee'];
            $paymentsTable = \Cake\ORM\TableRegistry::get('Payments');
            $subquery = $paymentsTable->find();
            $subquery->select($subquery->newExpr('COALESCE(SUM(amount), 0)'))
                     ->where(['plan_subscriber_id' => new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.id'), 'is_deleted' => 0]);

            if ($paid_fee_filter === '0') {
                $search[] = function ($exp, $q) use ($subquery) {
                    return $exp->eq($subquery, 0);
                };
            } elseif (strpos($paid_fee_filter, '-') !== false) {
                list($min, $max) = explode('-', $paid_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    return $exp->gte($subquery, (float)$min);
                };
                $search[] = function ($exp, $q) use ($subquery, $max) {
                    return $exp->lte($subquery, (float)$max);
                };
            } elseif (strpos($paid_fee_filter, '+') !== false) {
                $min = str_replace('+', '', $paid_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    return $exp->gte($subquery, (float)$min);
                };
            }
        }
        if (isset($this->request->query['remain_fee']) && trim($this->request->query['remain_fee']) != "") {
            $remain_fee_filter = $this->request->query['remain_fee'];
            $paymentsTable = \Cake\ORM\TableRegistry::get('Payments');
            $subquery = $paymentsTable->find();
            $subquery->select($subquery->newExpr('COALESCE(SUM(amount), 0)'))
                     ->where(['plan_subscriber_id' => new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.id'), 'is_deleted' => 0]);

            if ($remain_fee_filter === '0') {
                $search[] = function ($exp, $q) use ($subquery) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->eq($remainFeeExpr, 0);
                };
            } elseif (strpos($remain_fee_filter, '-') !== false) {
                list($min, $max) = explode('-', $remain_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->gte($remainFeeExpr, (float)$min);
                };
                $search[] = function ($exp, $q) use ($subquery, $max) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->lte($remainFeeExpr, (float)$max);
                };
            } elseif (strpos($remain_fee_filter, '+') !== false) {
                $min = str_replace('+', '', $remain_fee_filter);
                $search[] = function ($exp, $q) use ($subquery, $min) {
                    $fee = new \Cake\Database\Expression\IdentifierExpression('PlanSubscribers.fee');
                    $planSubscribersTable = \Cake\ORM\TableRegistry::get('PlanSubscribers');
                    $remainFeeExpr = $planSubscribersTable->newQuery()->newExpr()->type(' ')->add($fee)->add('-')->add($subquery);
                    return $exp->gte($remainFeeExpr, (float)$min);
                };
            }
        }

        $planSubscribers = $this->PlanSubscribers->find('all')
            ->contain([
                'Users' => ['Partners', 'AddedByUsers'], 
                'Partners', 
                'Payments' => function ($q) {
                    return $q->where(['Payments.is_deleted' => 0]);
                }
            ])
            ->where($search)
            ->where(['Users.active !=' => '3', 'Users.user_type !=' => '1'])
            ->order(['PlanSubscribers.id' => 'DESC'])
            ->all();

        // Group subscribers by Financial Year (FY: 1 April to 31 March)
        $groupedSubscribers = [];
        foreach ($planSubscribers as $ps) {
            $fys = [];
            $startDateStr = !empty($ps->subscription_start_date) ? $ps->subscription_start_date->format('Y-m-d') : $ps->created->format('Y-m-d');
            $endDateStr = $ps->plan_expire_date->format('Y-m-d');

            $startFY = ((int)date('n', strtotime($startDateStr)) >= 4) ? (int)date('Y', strtotime($startDateStr)) : ((int)date('Y', strtotime($startDateStr)) - 1);
            $endFY = ((int)date('n', strtotime($endDateStr)) >= 4) ? (int)date('Y', strtotime($endDateStr)) : ((int)date('Y', strtotime($endDateStr)) - 1);

            for ($y = $startFY; $y <= $endFY; $y++) {
                $fys[] = $y;
            }

            if (!empty($ps->payments)) {
                foreach ($ps->payments as $pm) {
                    if ($pm->is_deleted == 0) {
                        $payDateStr = !empty($pm->payment_date) ? $pm->payment_date->format('Y-m-d') : $pm->created->format('Y-m-d');
                        $payFY = ((int)date('n', strtotime($payDateStr)) >= 4) ? (int)date('Y', strtotime($payDateStr)) : ((int)date('Y', strtotime($payDateStr)) - 1);
                        $fys[] = $payFY;
                    }
                }
            }

            $fys = array_unique($fys);
            foreach ($fys as $fy) {
                $groupedSubscribers[$fy][] = $ps;
            }
        }

        // Always ensure FY 2026 tab exists
        if (!isset($groupedSubscribers[2026])) {
            $groupedSubscribers[2026] = [];
        }
        
        // Sort years chronologically
        ksort($groupedSubscribers);

        $reportData = [];
        foreach ($groupedSubscribers as $year => $subscribersInYear) {
            $fyStart = "{$year}-04-01";
            $fyEnd = ($year + 1) . "-03-31";

            // Fixed 12 months for this financial year (April to March)
            $months = [];
            for ($m = 4; $m <= 12; $m++) {
                $months[] = date('Y-m-t', strtotime("{$year}-{$m}-01"));
            }
            $nextYear = $year + 1;
            for ($m = 1; $m <= 3; $m++) {
                $months[] = date('Y-m-t', strtotime("{$nextYear}-{$m}-01"));
            }

            // Gather payments made within this financial year
            $subscriberPayments = [];
            $paymentDates = [];
            foreach ($subscribersInYear as $ps) {
                $subId = $ps->id;
                $subscriberPayments[$subId] = [];
                if (!empty($ps->payments)) {
                    foreach ($ps->payments as $p) {
                        if ($p->is_deleted == 0) {
                            $pDate = !empty($p->payment_date) ? $p->payment_date->format('Y-m-d') : $p->created->format('Y-m-d');
                            if ($pDate >= $fyStart && $pDate <= $fyEnd) {
                                $dateStr = date('d-m-Y', strtotime($pDate));
                                $paymentDates[$dateStr] = $dateStr;
                                if (!isset($subscriberPayments[$subId][$dateStr])) {
                                    $subscriberPayments[$subId][$dateStr] = 0;
                                }
                                $subscriberPayments[$subId][$dateStr] += (float)$p->amount;
                            }
                        }
                    }
                }
            }
            uksort($paymentDates, function($a, $b) {
                return strtotime($a) - strtotime($b);
            });

            $dataRows = [];
            $monthActiveCounts = array_fill_keys($months, 0);
            $monthTotals = array_fill_keys($months, 0);

            foreach ($subscribersInYear as $row) {
                $startDateStr = (!empty($row->subscription_start_date)) ? $row->subscription_start_date->format('Y-m-d') : $row->created->format('Y-m-d');
                $endDateStr = $row->plan_expire_date->format('Y-m-d');
                
                $totalDays = round((strtotime($endDateStr) - strtotime($startDateStr)) / 86400) + 1;
                if ($totalDays <= 0) {
                    $totalDays = 1;
                }
                $dailyRate = $row->fee / $totalDays;
                
                $start = new \DateTime($startDateStr);
                $end = new \DateTime($endDateStr);
                $diff = $start->diff($end);
                $monthsCount = $diff->y * 12 + $diff->m;
                if ($diff->d >= 1) {
                    $monthsCount += 1;
                }
                if ($monthsCount <= 0) {
                    $monthsCount = 1;
                }
                
                $today = strtotime(date('Y-m-d'));
                $expireTime = strtotime($endDateStr);
                $pendingDays = 0;
                if ($expireTime > $today) {
                    $pendingDays = round(($expireTime - $today) / 86400);
                }
                $pendingAmount = round($pendingDays * $dailyRate, 2);

                // Calculate actual paid fee and discount from payments
                $totalPaid = 0;
                $totalDiscount = 0;
                if (!empty($row->payments)) {
                    foreach ($row->payments as $pm) {
                        if ($pm->is_deleted == 0) {
                            $totalPaid += (float)$pm->amount;
                            $totalDiscount += (float)($pm->discount_amount ?? 0);
                        }
                    }
                }
                $totalDue = max(0, (float)$row->fee - $totalDiscount - $totalPaid);

                // Determine who added this subscriber
                $addedByName = 'Admin';
                if (!empty($row->user->added_by_user->name)) {
                    $addedByName = $row->user->added_by_user->name;
                } elseif (!empty($row->user->partner->name)) {
                    $addedByName = $row->user->partner->name;
                } elseif (!empty($row->partner->name)) {
                    $addedByName = $row->partner->name;
                }
                
                $subscriberRow = [
                    'id' => $row->id,
                    'name' => ucwords($row->user->name),
                    'added_by' => $addedByName,
                    'joining_date' => $row->created->format('d-m-Y'),
                    'membership' => $monthsCount,
                    'total_amount' => (float)$row->fee,
                    'paid_amount' => $totalPaid,
                    'due_amount' => $totalDue,
                    'end_date' => date("d-m-Y", strtotime($row->plan_expire_date)),
                    'pending_days' => $pendingDays,
                    'pending_amount' => $pendingAmount,
                    'days' => $totalDays,
                    'daily_amt' => round($dailyRate, 2)
                ];
                
                $subscriberRow['months'] = [];
                foreach ($months as $m) {
                    $monthStart = date('Y-m-01', strtotime($m));
                    $monthEnd = $m;
                    
                    $overlapStart = max(strtotime($startDateStr), strtotime($monthStart));
                    $overlapEnd = min(strtotime($endDateStr), strtotime($monthEnd));
                    
                    if ($overlapStart <= $overlapEnd) {
                        $overlapDays = round(($overlapEnd - $overlapStart) / 86400) + 1;
                        $val = round($overlapDays * $dailyRate, 2);
                    } else {
                        $val = 0;
                    }
                    
                    $subscriberRow['months'][$m] = $val;
                    
                    if ($val > 0) {
                        $monthActiveCounts[$m] += 1;
                        $monthTotals[$m] += $val;
                    }
                }
                
                $subscriberRow['payments'] = [];
                foreach ($paymentDates as $d) {
                    $subscriberRow['payments'][$d] = $subscriberPayments[$row->id][$d] ?? 0;
                }
                
                $dataRows[] = $subscriberRow;
            }

            $reportData[$year] = [
                'months' => $months,
                'paymentDates' => $paymentDates,
                'dataRows' => $dataRows,
                'monthActiveCounts' => $monthActiveCounts,
                'monthTotals' => $monthTotals
            ];
        }

        $this->set(compact('reportData'));
    }

    /**
     * View method
     *
     * @param string|null $id Plan Subscriber id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $planSubscriber = $this->PlanSubscribers->get($id, [
            'contain' => [
                'Users', 
                'Partners', 
                'Payments' => function ($q) {
                    return $q->where(['Payments.is_deleted' => 0]);
                }
            ]
        ]);

        $this->set('planSubscriber', $planSubscriber);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planSubscriber = $this->PlanSubscribers->newEntity();
        if ($this->request->is('post')) {
            $planSubscriber = $this->PlanSubscribers->patchEntity($planSubscriber, $this->request->getData());
            if ($this->PlanSubscribers->save($planSubscriber)) {
                $this->Flash->success(__('The plan subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan subscriber could not be saved. Please, try again.'));
        }
        $users = $this->PlanSubscribers->Users->find('list', ['limit' => 200]);
        $partners = $this->PlanSubscribers->Partners->find('list', ['limit' => 200]);
        $this->set(compact('planSubscriber', 'users', 'partners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan Subscriber id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $planSubscriber = $this->PlanSubscribers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $planSubscriber = $this->PlanSubscribers->patchEntity($planSubscriber, $this->request->getData());
            if ($this->PlanSubscribers->save($planSubscriber)) {
                $this->Flash->success(__('The plan subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan subscriber could not be saved. Please, try again.'));
        }
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Users.user_type'] = 3;
        if (!empty($search)) {
            $users = $this->PlanSubscribers->Users->find('list')
                    ->where([$search]);
        } else {
            $users = $this->PlanSubscribers->Users->find('list');
        }
        
        $partners = $this->PlanSubscribers->Partners->find('list', ['limit' => 200]);
        $this->set(compact('planSubscriber', 'users', 'partners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan Subscriber id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       // $this->request->allowMethod(['post', 'delete']);
        $planSubscriber = $this->PlanSubscribers->get($id);
        if ($this->PlanSubscribers->delete($planSubscriber)) {
            $this->Flash->success(__('The plan subscriber has been deleted.'));
        } else {
            $this->Flash->error(__('The plan subscriber could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
