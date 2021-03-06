<?php
use Destiny\Common\Utils\Date;
use Destiny\Common\Utils\Tpl;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?=Tpl::title($this->title)?>
    <?php include 'seg/meta.php' ?>
    <?=Tpl::manifestLink('web.css')?>
</head>
<body id="admin" class="no-contain">
<div id="page-wrap">
    <?php include 'seg/nav.php' ?>
    <?php include 'seg/admin.nav.php' ?>

    <?php function buildSubscribersTier(array $tier, $num){?>
        <?php if(!empty($tier)): ?>
            <section class="container">
                <h3 class="in" data-toggle="collapse" data-target="#tier-<?=$num?>-content">T<?=$num?> Subscribers</h3>
                <div id="tier-<?=$num?>-content" class="content content-dark collapse show">
                    <table class="grid">
                        <thead>
                        <tr>
                            <td style="width: 20px;"></td>
                            <td style="width: 200px;">User</td>
                            <td style="width: 100px;">Recurring</td>
                            <td style="width: 80px;">Created on</td>
                            <td>Ends on</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        <?php foreach($tier as $sub): ?>
                            <tr>
                                <td><?=$i?></td>
                                <td>
                                    <a href="/admin/user/<?=$sub['userId']?>/edit"><?=Tpl::out($sub['username'])?></a>
                                    <?php if(!empty($sub['gifter'])): ?>
                                        &nbsp; (<a title="Gifted by" href="/admin/user/<?=$sub['gifter']?>/edit"><i class="fas fa-gift"></i> <?=Tpl::out($sub['gifterUsername'])?></a>)
                                    <?php endif ?>
                                </td>
                                <td><?=($sub['recurring'] == 1) ? 'Yes':'No'?></td>
                                <td><?=Tpl::moment(Date::getDateTime($sub['createdDate']), Date::STRING_FORMAT)?></td>
                                <td><?=Tpl::moment(Date::getDateTime($sub['endDate']), Date::STRING_FORMAT)?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php endif ?>
    <?php } ?>

    <?php if(empty($this->subscribersT4) && empty($this->subscribersT3) && empty($this->subscribersT2) && empty($this->subscribersT1)): ?>
        <section class="container">
            <h3 class="in" data-toggle="collapse" data-target="#no-subs-content">Subscribers</h3>
            <div id="no-subs-content" class="content content-dark collapse show">
                <div class="ds-block">
                    <p>No subscribers</p>
                </div>
            </div>
        </section>
    <?php endif ?>

    <?php buildSubscribersTier($this->subscribersT4, 4) ?>
    <?php buildSubscribersTier($this->subscribersT3, 3) ?>
    <?php buildSubscribersTier($this->subscribersT2, 2) ?>
    <?php buildSubscribersTier($this->subscribersT1, 1) ?>

</div>

<?php include 'seg/foot.php' ?>
<?php include 'seg/tracker.php' ?>
<?=Tpl::manifestScript('runtime.js')?>
<?=Tpl::manifestScript('common.vendor.js')?>
<?=Tpl::manifestScript('web.js')?>
<?=Tpl::manifestScript('admin.js')?>

</body>
</html>