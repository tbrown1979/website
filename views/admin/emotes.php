<?php
use Destiny\Common\Utils\Tpl;
use Destiny\Common\Config;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?=Tpl::title($this->title)?>
    <?php include 'seg/meta.php' ?>
    <?=Tpl::manifestLink('web.css')?>
    <link href="<?=Config::cdnv()?>/emotes/emotes.css?_=<?=Tpl::out($this->cacheKey)?>" rel="stylesheet" media="screen">
</head>
<body id="admin" class="no-contain">
<div id="page-wrap">

    <?php include 'seg/nav.php' ?>
    <?php include 'seg/alerts.php' ?>
    <?php include 'seg/admin.nav.php' ?>

    <section class="container">
        <div class="content content-dark clearfix">
            <div class="ds-block" style="display: flex;">
                <a href="/admin/emotes/new" class="btn btn-primary">New Emote <i class="fas fa-fw fa-plus"></i></a>
                <input style="margin-left: 1rem;" id="emote-search" type="text" class="form-control" placeholder="Search ..." />
            </div>
        </div>
    </section>

    <section class="container">
        <div id="emote-grid" class="image-grid">
            <?php foreach ($this->emotes as $emote): ?>
                <div data-prefix="<?=Tpl::out($emote['prefix'])?>" class="image-grid-item <?=($emote['twitch'] == 1)?"twitch":""?> <?=($emote['draft'] == 1)?" draft":""?>" data-id="<?=Tpl::out($emote['id'])?>" data-imageId="<?=Tpl::out($emote['imageId'])?>">
                    <div class="image-view">
                        <a href="/admin/emotes/<?=Tpl::out($emote['id'])?>/edit" title="<?=Tpl::out($emote['prefix'])?>" class="emote <?=Tpl::out($emote['prefix'])?>"></a>
                    </div>
                    <a href="/admin/emotes/<?=Tpl::out($emote['id'])?>/edit" class="image-info">
                        <label><?=Tpl::out($emote['prefix'])?></label>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</div>

<?php include 'seg/foot.php' ?>
<?php include 'seg/tracker.php' ?>
<?=Tpl::manifestScript('runtime.js')?>
<?=Tpl::manifestScript('common.vendor.js')?>
<?=Tpl::manifestScript('web.js')?>
<?=Tpl::manifestScript('admin.js')?>

</body>
</html>