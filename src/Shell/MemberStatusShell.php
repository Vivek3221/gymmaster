<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

/**
 * MemberStatus Shell
 *
 * Automatically updates member status based on subscription validity.
 * Usage: bin/cake member_status expire
 */
class MemberStatusShell extends Shell
{
    public function main()
    {
        $this->expire();
    }

    /**
     * Mark expired members (active = 1, user_type = 3) with no future plan as Inactive (active = 0)
     */
    public function expire()
    {
        $this->out('<info>[GymMaster]</info> Starting membership expiration check...');

        $usersTable = TableRegistry::get('Users');
        $planSubscribersTable = TableRegistry::get('PlanSubscribers');
        $today = date('Y-m-d');

        // Subquery: Has any active or future plan expiring today or in the future
        $activePlanSubquery = $planSubscribersTable->find()
            ->select(['PlanSubscribers.id'])
            ->where([
                'PlanSubscribers.user_id = Users.id',
                'PlanSubscribers.plan_expire_date >=' => $today . ' 00:00:00'
            ]);

        // Find active members (user_type = 3, active = 1) who have an expired plan AND no active/future plan
        $expiredMembers = $usersTable->find()
            ->select(['id', 'name', 'email', 'partner_id'])
            ->where([
                'Users.user_type' => 3,
                'Users.active' => 1
            ])
            ->where(function ($exp) use ($activePlanSubquery, $planSubscribersTable, $today) {
                $hasExpiredPlanSubquery = $planSubscribersTable->find()
                    ->select(['PlanSubscribers.id'])
                    ->where([
                        'PlanSubscribers.user_id = Users.id',
                        'PlanSubscribers.plan_expire_date <' => $today . ' 00:00:00'
                    ]);

                return $exp
                    ->exists($hasExpiredPlanSubquery)
                    ->notExists($activePlanSubquery);
            })
            ->toArray();

        $count = 0;
        if (!empty($expiredMembers)) {
            foreach ($expiredMembers as $m) {
                $usersTable->updateAll(
                    ['active' => 0],
                    ['id' => $m->id]
                );
                $this->out(" - Marked user #{$m->id} ({$m->name}) as Inactive.");
                $count++;
            }
        }

        $this->out("<success>[GymMaster] Done. Marked {$count} expired member(s) as Inactive.</success>");
    }
}
