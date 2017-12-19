<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Groups'), ['controller' => 'UserGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Group'), ['controller' => 'UserGroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Industries'), ['controller' => 'Industries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Industry'), ['controller' => 'Industries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ads'), ['controller' => 'Ads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ad'), ['controller' => 'Ads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comment Likes'), ['controller' => 'CommentLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment Like'), ['controller' => 'CommentLikes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lang Manage Messages'), ['controller' => 'LangManageMessages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lang Manage Message'), ['controller' => 'LangManageMessages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lang Messages'), ['controller' => 'LangMessages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lang Message'), ['controller' => 'LangMessages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Login Tokens'), ['controller' => 'LoginTokens', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Login Token'), ['controller' => 'LoginTokens', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List News'), ['controller' => 'News', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News'), ['controller' => 'News', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List News Likes'), ['controller' => 'NewsLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News Like'), ['controller' => 'NewsLikes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List News Report Abuses'), ['controller' => 'NewsReportAbuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News Report Abus'), ['controller' => 'NewsReportAbuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Otps'), ['controller' => 'Otps', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Otp'), ['controller' => 'Otps', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scheduled Email Recipients'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scheduled Email Recipient'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscribers'), ['controller' => 'Subscribers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscriber'), ['controller' => 'Subscribers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tokens'), ['controller' => 'Tokens', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Token'), ['controller' => 'Tokens', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Activities'), ['controller' => 'UserActivities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Activity'), ['controller' => 'UserActivities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Contacts'), ['controller' => 'UserContacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Contact'), ['controller' => 'UserContacts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Details'), ['controller' => 'UserDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Detail'), ['controller' => 'UserDetails', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Email Recipients'), ['controller' => 'UserEmailRecipients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Email Recipient'), ['controller' => 'UserEmailRecipients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Email Signatures'), ['controller' => 'UserEmailSignatures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Email Signature'), ['controller' => 'UserEmailSignatures', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Email Templates'), ['controller' => 'UserEmailTemplates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Email Template'), ['controller' => 'UserEmailTemplates', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Settings'), ['controller' => 'UserSettings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Setting'), ['controller' => 'UserSettings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Socials'), ['controller' => 'UserSocials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Social'), ['controller' => 'UserSocials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Guestid') ?></th>
            <td><?= h($user->guestid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Group') ?></th>
            <td><?= $user->has('user_group') ? $this->Html->link($user->user_group->name, ['controller' => 'UserGroups', 'action' => 'view', $user->user_group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Secondry Email') ?></th>
            <td><?= h($user->secondry_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone Prefix') ?></th>
            <td><?= h($user->phone_prefix) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile No') ?></th>
            <td><?= h($user->mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Prefix') ?></th>
            <td><?= h($user->name_prefix) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($user->gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($user->photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Key') ?></th>
            <td><?= h($user->api_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Heard Us') ?></th>
            <td><?= h($user->heard_us) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source') ?></th>
            <td><?= h($user->source) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Url') ?></th>
            <td><?= h($user->website_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merital Status') ?></th>
            <td><?= h($user->merital_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nationality') ?></th>
            <td><?= h($user->nationality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Utm Source') ?></th>
            <td><?= h($user->utm_source) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Utm Medium') ?></th>
            <td><?= h($user->utm_medium) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Utm Campaign') ?></th>
            <td><?= h($user->utm_campaign) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $user->has('country') ? $this->Html->link($user->country->name, ['controller' => 'Countries', 'action' => 'view', $user->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $user->has('state') ? $this->Html->link($user->state->name, ['controller' => 'States', 'action' => 'view', $user->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= $user->has('industry') ? $this->Html->link($user->industry->name, ['controller' => 'Industries', 'action' => 'view', $user->industry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Id') ?></th>
            <td><?= h($user->skill_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= $user->has('language') ? $this->Html->link($user->language->name, ['controller' => 'Languages', 'action' => 'view', $user->language->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= $user->has('tag') ? $this->Html->link($user->tag->name, ['controller' => 'Tags', 'action' => 'view', $user->tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip Address') ?></th>
            <td><?= h($user->ip_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Elastic') ?></th>
            <td><?= h($user->elastic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $this->Number->format($user->active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Verified') ?></th>
            <td><?= $this->Number->format($user->email_verified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Follewer Count') ?></th>
            <td><?= $this->Number->format($user->follewer_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Following Count') ?></th>
            <td><?= $this->Number->format($user->following_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recomandation Count') ?></th>
            <td><?= $this->Number->format($user->recomandation_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Count') ?></th>
            <td><?= $this->Number->format($user->login_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Redis') ?></th>
            <td><?= $this->Number->format($user->redis) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mongo') ?></th>
            <td><?= $this->Number->format($user->mongo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Earned Points') ?></th>
            <td><?= $this->Number->format($user->earned_points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Change Password') ?></th>
            <td><?= $this->Number->format($user->change_password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($user->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($user->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bday') ?></th>
            <td><?= h($user->bday) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Date') ?></th>
            <td><?= h($user->registration_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Login') ?></th>
            <td><?= h($user->last_login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('About Me') ?></h4>
        <?= $this->Text->autoParagraph(h($user->about_me)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ads') ?></h4>
        <?php if (!empty($user->ads)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Visibility') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->ads as $ads): ?>
            <tr>
                <td><?= h($ads->id) ?></td>
                <td><?= h($ads->user_id) ?></td>
                <td><?= h($ads->content) ?></td>
                <td><?= h($ads->type) ?></td>
                <td><?= h($ads->status) ?></td>
                <td><?= h($ads->visibility) ?></td>
                <td><?= h($ads->created) ?></td>
                <td><?= h($ads->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ads', 'action' => 'view', $ads->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ads', 'action' => 'edit', $ads->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ads', 'action' => 'delete', $ads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ads->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Comment Likes') ?></h4>
        <?php if (!empty($user->comment_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment Id') ?></th>
                <th scope="col"><?= __('Vote') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->comment_likes as $commentLikes): ?>
            <tr>
                <td><?= h($commentLikes->id) ?></td>
                <td><?= h($commentLikes->user_id) ?></td>
                <td><?= h($commentLikes->comment_id) ?></td>
                <td><?= h($commentLikes->vote) ?></td>
                <td><?= h($commentLikes->created) ?></td>
                <td><?= h($commentLikes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CommentLikes', 'action' => 'view', $commentLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CommentLikes', 'action' => 'edit', $commentLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CommentLikes', 'action' => 'delete', $commentLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($user->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('News Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Like Cnt') ?></th>
                <th scope="col"><?= __('Reply') ?></th>
                <th scope="col"><?= __('Reply Cnt') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->comments as $comments): ?>
            <tr>
                <td><?= h($comments->id) ?></td>
                <td><?= h($comments->news_id) ?></td>
                <td><?= h($comments->user_id) ?></td>
                <td><?= h($comments->comment) ?></td>
                <td><?= h($comments->parent_id) ?></td>
                <td><?= h($comments->like_cnt) ?></td>
                <td><?= h($comments->reply) ?></td>
                <td><?= h($comments->reply_cnt) ?></td>
                <td><?= h($comments->created) ?></td>
                <td><?= h($comments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Documents') ?></h4>
        <?php if (!empty($user->documents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Docurl') ?></th>
                <th scope="col"><?= __('Verifiedby') ?></th>
                <th scope="col"><?= __('Verification Comments') ?></th>
                <th scope="col"><?= __('Verification Date') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Visibility') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->documents as $documents): ?>
            <tr>
                <td><?= h($documents->id) ?></td>
                <td><?= h($documents->user_id) ?></td>
                <td><?= h($documents->title) ?></td>
                <td><?= h($documents->description) ?></td>
                <td><?= h($documents->docurl) ?></td>
                <td><?= h($documents->verifiedby) ?></td>
                <td><?= h($documents->verification_comments) ?></td>
                <td><?= h($documents->verification_date) ?></td>
                <td><?= h($documents->status) ?></td>
                <td><?= h($documents->visibility) ?></td>
                <td><?= h($documents->created) ?></td>
                <td><?= h($documents->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Documents', 'action' => 'view', $documents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Documents', 'action' => 'edit', $documents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Documents', 'action' => 'delete', $documents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Lang Manage Messages') ?></h4>
        <?php if (!empty($user->lang_manage_messages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Lang Message Id') ?></th>
                <th scope="col"><?= __('Msgstr') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Language Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->lang_manage_messages as $langManageMessages): ?>
            <tr>
                <td><?= h($langManageMessages->id) ?></td>
                <td><?= h($langManageMessages->user_id) ?></td>
                <td><?= h($langManageMessages->lang_message_id) ?></td>
                <td><?= h($langManageMessages->msgstr) ?></td>
                <td><?= h($langManageMessages->comment) ?></td>
                <td><?= h($langManageMessages->language_id) ?></td>
                <td><?= h($langManageMessages->status) ?></td>
                <td><?= h($langManageMessages->created) ?></td>
                <td><?= h($langManageMessages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LangManageMessages', 'action' => 'view', $langManageMessages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LangManageMessages', 'action' => 'edit', $langManageMessages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LangManageMessages', 'action' => 'delete', $langManageMessages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $langManageMessages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Lang Messages') ?></h4>
        <?php if (!empty($user->lang_messages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Lang Msg Type Id') ?></th>
                <th scope="col"><?= __('Msg Status') ?></th>
                <th scope="col"><?= __('Module') ?></th>
                <th scope="col"><?= __('Action') ?></th>
                <th scope="col"><?= __('Version') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->lang_messages as $langMessages): ?>
            <tr>
                <td><?= h($langMessages->id) ?></td>
                <td><?= h($langMessages->message) ?></td>
                <td><?= h($langMessages->lang_msg_type_id) ?></td>
                <td><?= h($langMessages->msg_status) ?></td>
                <td><?= h($langMessages->module) ?></td>
                <td><?= h($langMessages->action) ?></td>
                <td><?= h($langMessages->version) ?></td>
                <td><?= h($langMessages->created) ?></td>
                <td><?= h($langMessages->modified) ?></td>
                <td><?= h($langMessages->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LangMessages', 'action' => 'view', $langMessages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LangMessages', 'action' => 'edit', $langMessages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LangMessages', 'action' => 'delete', $langMessages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $langMessages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Login Tokens') ?></h4>
        <?php if (!empty($user->login_tokens)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Token') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Used') ?></th>
                <th scope="col"><?= __('Expires') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->login_tokens as $loginTokens): ?>
            <tr>
                <td><?= h($loginTokens->id) ?></td>
                <td><?= h($loginTokens->user_id) ?></td>
                <td><?= h($loginTokens->token) ?></td>
                <td><?= h($loginTokens->duration) ?></td>
                <td><?= h($loginTokens->used) ?></td>
                <td><?= h($loginTokens->expires) ?></td>
                <td><?= h($loginTokens->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LoginTokens', 'action' => 'view', $loginTokens->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LoginTokens', 'action' => 'edit', $loginTokens->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LoginTokens', 'action' => 'delete', $loginTokens->id], ['confirm' => __('Are you sure you want to delete # {0}?', $loginTokens->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related News') ?></h4>
        <?php if (!empty($user->news)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Tags') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Source') ?></th>
                <th scope="col"><?= __('Related To') ?></th>
                <th scope="col"><?= __('Reference Url') ?></th>
                <th scope="col"><?= __('News Datetime') ?></th>
                <th scope="col"><?= __('Cover Image') ?></th>
                <th scope="col"><?= __('Images') ?></th>
                <th scope="col"><?= __('Videos') ?></th>
                <th scope="col"><?= __('Like Count') ?></th>
                <th scope="col"><?= __('Comment Count') ?></th>
                <th scope="col"><?= __('View Count') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Weightage') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->news as $news): ?>
            <tr>
                <td><?= h($news->id) ?></td>
                <td><?= h($news->parent_id) ?></td>
                <td><?= h($news->user_id) ?></td>
                <td><?= h($news->category_id) ?></td>
                <td><?= h($news->city_id) ?></td>
                <td><?= h($news->location) ?></td>
                <td><?= h($news->tags) ?></td>
                <td><?= h($news->title) ?></td>
                <td><?= h($news->description) ?></td>
                <td><?= h($news->source) ?></td>
                <td><?= h($news->related_to) ?></td>
                <td><?= h($news->reference_url) ?></td>
                <td><?= h($news->news_datetime) ?></td>
                <td><?= h($news->cover_image) ?></td>
                <td><?= h($news->images) ?></td>
                <td><?= h($news->videos) ?></td>
                <td><?= h($news->like_count) ?></td>
                <td><?= h($news->comment_count) ?></td>
                <td><?= h($news->view_count) ?></td>
                <td><?= h($news->status) ?></td>
                <td><?= h($news->weightage) ?></td>
                <td><?= h($news->created) ?></td>
                <td><?= h($news->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'News', 'action' => 'view', $news->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'News', 'action' => 'edit', $news->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'News', 'action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related News Likes') ?></h4>
        <?php if (!empty($user->news_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('News Id') ?></th>
                <th scope="col"><?= __('Vote') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->news_likes as $newsLikes): ?>
            <tr>
                <td><?= h($newsLikes->id) ?></td>
                <td><?= h($newsLikes->user_id) ?></td>
                <td><?= h($newsLikes->news_id) ?></td>
                <td><?= h($newsLikes->vote) ?></td>
                <td><?= h($newsLikes->created) ?></td>
                <td><?= h($newsLikes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NewsLikes', 'action' => 'view', $newsLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NewsLikes', 'action' => 'edit', $newsLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NewsLikes', 'action' => 'delete', $newsLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $newsLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related News Report Abuses') ?></h4>
        <?php if (!empty($user->news_report_abuses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('News Id') ?></th>
                <th scope="col"><?= __('Abuse Type') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->news_report_abuses as $newsReportAbuses): ?>
            <tr>
                <td><?= h($newsReportAbuses->id) ?></td>
                <td><?= h($newsReportAbuses->user_id) ?></td>
                <td><?= h($newsReportAbuses->news_id) ?></td>
                <td><?= h($newsReportAbuses->abuse_type) ?></td>
                <td><?= h($newsReportAbuses->comment) ?></td>
                <td><?= h($newsReportAbuses->created) ?></td>
                <td><?= h($newsReportAbuses->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NewsReportAbuses', 'action' => 'view', $newsReportAbuses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NewsReportAbuses', 'action' => 'edit', $newsReportAbuses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NewsReportAbuses', 'action' => 'delete', $newsReportAbuses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $newsReportAbuses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Otps') ?></h4>
        <?php if (!empty($user->otps)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Otp') ?></th>
                <th scope="col"><?= __('Ip') ?></th>
                <th scope="col"><?= __('Verified') ?></th>
                <th scope="col"><?= __('Expired') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->otps as $otps): ?>
            <tr>
                <td><?= h($otps->id) ?></td>
                <td><?= h($otps->user_id) ?></td>
                <td><?= h($otps->otp) ?></td>
                <td><?= h($otps->ip) ?></td>
                <td><?= h($otps->verified) ?></td>
                <td><?= h($otps->expired) ?></td>
                <td><?= h($otps->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Otps', 'action' => 'view', $otps->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Otps', 'action' => 'edit', $otps->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Otps', 'action' => 'delete', $otps->id], ['confirm' => __('Are you sure you want to delete # {0}?', $otps->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Profiles') ?></h4>
        <?php if (!empty($user->profiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Marital Status') ?></th>
                <th scope="col"><?= __('Industry Id') ?></th>
                <th scope="col"><?= __('Designation') ?></th>
                <th scope="col"><?= __('Is Journalist') ?></th>
                <th scope="col"><?= __('Summary') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->profiles as $profiles): ?>
            <tr>
                <td><?= h($profiles->id) ?></td>
                <td><?= h($profiles->user_id) ?></td>
                <td><?= h($profiles->country_id) ?></td>
                <td><?= h($profiles->city_id) ?></td>
                <td><?= h($profiles->address) ?></td>
                <td><?= h($profiles->dob) ?></td>
                <td><?= h($profiles->gender) ?></td>
                <td><?= h($profiles->image) ?></td>
                <td><?= h($profiles->marital_status) ?></td>
                <td><?= h($profiles->industry_id) ?></td>
                <td><?= h($profiles->designation) ?></td>
                <td><?= h($profiles->is_journalist) ?></td>
                <td><?= h($profiles->summary) ?></td>
                <td><?= h($profiles->created) ?></td>
                <td><?= h($profiles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Profiles', 'action' => 'view', $profiles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Profiles', 'action' => 'edit', $profiles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Profiles', 'action' => 'delete', $profiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profiles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Scheduled Email Recipients') ?></h4>
        <?php if (!empty($user->scheduled_email_recipients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Scheduled Email Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Email Address') ?></th>
                <th scope="col"><?= __('Is Email Sent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->scheduled_email_recipients as $scheduledEmailRecipients): ?>
            <tr>
                <td><?= h($scheduledEmailRecipients->id) ?></td>
                <td><?= h($scheduledEmailRecipients->scheduled_email_id) ?></td>
                <td><?= h($scheduledEmailRecipients->user_id) ?></td>
                <td><?= h($scheduledEmailRecipients->email_address) ?></td>
                <td><?= h($scheduledEmailRecipients->is_email_sent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'view', $scheduledEmailRecipients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'edit', $scheduledEmailRecipients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'delete', $scheduledEmailRecipients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scheduledEmailRecipients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subscribers') ?></h4>
        <?php if (!empty($user->subscribers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Guestid') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Ip') ?></th>
                <th scope="col"><?= __('Browser') ?></th>
                <th scope="col"><?= __('Source') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->subscribers as $subscribers): ?>
            <tr>
                <td><?= h($subscribers->id) ?></td>
                <td><?= h($subscribers->user_id) ?></td>
                <td><?= h($subscribers->guestid) ?></td>
                <td><?= h($subscribers->email) ?></td>
                <td><?= h($subscribers->ip) ?></td>
                <td><?= h($subscribers->browser) ?></td>
                <td><?= h($subscribers->source) ?></td>
                <td><?= h($subscribers->status) ?></td>
                <td><?= h($subscribers->created) ?></td>
                <td><?= h($subscribers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subscribers', 'action' => 'view', $subscribers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subscribers', 'action' => 'edit', $subscribers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subscribers', 'action' => 'delete', $subscribers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscribers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tokens') ?></h4>
        <?php if (!empty($user->tokens)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Token') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Used') ?></th>
                <th scope="col"><?= __('Expires') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->tokens as $tokens): ?>
            <tr>
                <td><?= h($tokens->id) ?></td>
                <td><?= h($tokens->user_id) ?></td>
                <td><?= h($tokens->token) ?></td>
                <td><?= h($tokens->duration) ?></td>
                <td><?= h($tokens->used) ?></td>
                <td><?= h($tokens->expires) ?></td>
                <td><?= h($tokens->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tokens', 'action' => 'view', $tokens->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tokens', 'action' => 'edit', $tokens->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tokens', 'action' => 'delete', $tokens->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tokens->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Activities') ?></h4>
        <?php if (!empty($user->user_activities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Useragent') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Last Action') ?></th>
                <th scope="col"><?= __('Last Url') ?></th>
                <th scope="col"><?= __('User Browser') ?></th>
                <th scope="col"><?= __('Ip Address') ?></th>
                <th scope="col"><?= __('Logout') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_activities as $userActivities): ?>
            <tr>
                <td><?= h($userActivities->id) ?></td>
                <td><?= h($userActivities->useragent) ?></td>
                <td><?= h($userActivities->user_id) ?></td>
                <td><?= h($userActivities->last_action) ?></td>
                <td><?= h($userActivities->last_url) ?></td>
                <td><?= h($userActivities->user_browser) ?></td>
                <td><?= h($userActivities->ip_address) ?></td>
                <td><?= h($userActivities->logout) ?></td>
                <td><?= h($userActivities->deleted) ?></td>
                <td><?= h($userActivities->created) ?></td>
                <td><?= h($userActivities->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserActivities', 'action' => 'view', $userActivities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserActivities', 'action' => 'edit', $userActivities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserActivities', 'action' => 'delete', $userActivities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userActivities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Contacts') ?></h4>
        <?php if (!empty($user->user_contacts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Requirement') ?></th>
                <th scope="col"><?= __('Reply Message') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_contacts as $userContacts): ?>
            <tr>
                <td><?= h($userContacts->id) ?></td>
                <td><?= h($userContacts->user_id) ?></td>
                <td><?= h($userContacts->name) ?></td>
                <td><?= h($userContacts->email) ?></td>
                <td><?= h($userContacts->phone) ?></td>
                <td><?= h($userContacts->requirement) ?></td>
                <td><?= h($userContacts->reply_message) ?></td>
                <td><?= h($userContacts->created) ?></td>
                <td><?= h($userContacts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserContacts', 'action' => 'view', $userContacts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserContacts', 'action' => 'edit', $userContacts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserContacts', 'action' => 'delete', $userContacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userContacts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Details') ?></h4>
        <?php if (!empty($user->user_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Cellphone') ?></th>
                <th scope="col"><?= __('Email Setting') ?></th>
                <th scope="col"><?= __('Facebook Link') ?></th>
                <th scope="col"><?= __('Twitter Link') ?></th>
                <th scope="col"><?= __('Linkedin Link') ?></th>
                <th scope="col"><?= __('Googleplus Link') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_details as $userDetails): ?>
            <tr>
                <td><?= h($userDetails->id) ?></td>
                <td><?= h($userDetails->user_id) ?></td>
                <td><?= h($userDetails->location) ?></td>
                <td><?= h($userDetails->cellphone) ?></td>
                <td><?= h($userDetails->email_setting) ?></td>
                <td><?= h($userDetails->facebook_link) ?></td>
                <td><?= h($userDetails->twitter_link) ?></td>
                <td><?= h($userDetails->linkedin_link) ?></td>
                <td><?= h($userDetails->googleplus_link) ?></td>
                <td><?= h($userDetails->created) ?></td>
                <td><?= h($userDetails->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserDetails', 'action' => 'view', $userDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserDetails', 'action' => 'edit', $userDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserDetails', 'action' => 'delete', $userDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Email Recipients') ?></h4>
        <?php if (!empty($user->user_email_recipients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Email Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Email Address') ?></th>
                <th scope="col"><?= __('Is Email Sent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_email_recipients as $userEmailRecipients): ?>
            <tr>
                <td><?= h($userEmailRecipients->id) ?></td>
                <td><?= h($userEmailRecipients->user_email_id) ?></td>
                <td><?= h($userEmailRecipients->user_id) ?></td>
                <td><?= h($userEmailRecipients->email_address) ?></td>
                <td><?= h($userEmailRecipients->is_email_sent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserEmailRecipients', 'action' => 'view', $userEmailRecipients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserEmailRecipients', 'action' => 'edit', $userEmailRecipients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserEmailRecipients', 'action' => 'delete', $userEmailRecipients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmailRecipients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Email Signatures') ?></h4>
        <?php if (!empty($user->user_email_signatures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Signature Name') ?></th>
                <th scope="col"><?= __('Signature') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_email_signatures as $userEmailSignatures): ?>
            <tr>
                <td><?= h($userEmailSignatures->id) ?></td>
                <td><?= h($userEmailSignatures->user_id) ?></td>
                <td><?= h($userEmailSignatures->signature_name) ?></td>
                <td><?= h($userEmailSignatures->signature) ?></td>
                <td><?= h($userEmailSignatures->created) ?></td>
                <td><?= h($userEmailSignatures->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserEmailSignatures', 'action' => 'view', $userEmailSignatures->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserEmailSignatures', 'action' => 'edit', $userEmailSignatures->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserEmailSignatures', 'action' => 'delete', $userEmailSignatures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmailSignatures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Email Templates') ?></h4>
        <?php if (!empty($user->user_email_templates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Template Name') ?></th>
                <th scope="col"><?= __('Header') ?></th>
                <th scope="col"><?= __('Footer') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_email_templates as $userEmailTemplates): ?>
            <tr>
                <td><?= h($userEmailTemplates->id) ?></td>
                <td><?= h($userEmailTemplates->user_id) ?></td>
                <td><?= h($userEmailTemplates->template_name) ?></td>
                <td><?= h($userEmailTemplates->header) ?></td>
                <td><?= h($userEmailTemplates->footer) ?></td>
                <td><?= h($userEmailTemplates->created) ?></td>
                <td><?= h($userEmailTemplates->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserEmailTemplates', 'action' => 'view', $userEmailTemplates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserEmailTemplates', 'action' => 'edit', $userEmailTemplates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserEmailTemplates', 'action' => 'delete', $userEmailTemplates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmailTemplates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Settings') ?></h4>
        <?php if (!empty($user->user_settings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Display Name') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Time From') ?></th>
                <th scope="col"><?= __('Time To') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Visibility') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_settings as $userSettings): ?>
            <tr>
                <td><?= h($userSettings->id) ?></td>
                <td><?= h($userSettings->user_id) ?></td>
                <td><?= h($userSettings->name) ?></td>
                <td><?= h($userSettings->display_name) ?></td>
                <td><?= h($userSettings->value) ?></td>
                <td><?= h($userSettings->type) ?></td>
                <td><?= h($userSettings->category) ?></td>
                <td><?= h($userSettings->time_from) ?></td>
                <td><?= h($userSettings->time_to) ?></td>
                <td><?= h($userSettings->status) ?></td>
                <td><?= h($userSettings->visibility) ?></td>
                <td><?= h($userSettings->created) ?></td>
                <td><?= h($userSettings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserSettings', 'action' => 'view', $userSettings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserSettings', 'action' => 'edit', $userSettings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserSettings', 'action' => 'delete', $userSettings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSettings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Socials') ?></h4>
        <?php if (!empty($user->user_socials)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Socialid') ?></th>
                <th scope="col"><?= __('Access Token') ?></th>
                <th scope="col"><?= __('Access Secret') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_socials as $userSocials): ?>
            <tr>
                <td><?= h($userSocials->id) ?></td>
                <td><?= h($userSocials->user_id) ?></td>
                <td><?= h($userSocials->type) ?></td>
                <td><?= h($userSocials->socialid) ?></td>
                <td><?= h($userSocials->access_token) ?></td>
                <td><?= h($userSocials->access_secret) ?></td>
                <td><?= h($userSocials->created) ?></td>
                <td><?= h($userSocials->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserSocials', 'action' => 'view', $userSocials->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserSocials', 'action' => 'edit', $userSocials->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserSocials', 'action' => 'delete', $userSocials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSocials->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
