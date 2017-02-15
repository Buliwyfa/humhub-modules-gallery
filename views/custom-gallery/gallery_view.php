<?php
use yii\helpers\Html;
use humhub\modules\gallery\widgets\CustomGalleryContent;
use humhub\modules\like\widgets\LikeLink;
use humhub\modules\comment\widgets\CommentLink;
use humhub\modules\comment\widgets\Comments;

$bundle = \humhub\modules\gallery\assets\Assets::register($this);
$this->registerJsVar('galleryMediaUploadUrl', $this->context->contentContainer->createUrl('upload', [
    'open-gallery-id' => $gallery->id
]));
?>
<div id="galleryContainer" class="panel panel-default">
    <?php echo Html::beginForm(null, null, ['data-target' => '#globalModal', 'id' => 'gallery-form']); ?>
    <?php echo Html::endForm(); ?>
    <div class="panel-body">
        <a class="btn btn-default btn-sm back-button" href="<?php echo $this->context->contentContainer->createUrl('/gallery/list'); ?>"><i
            class="glyphicon glyphicon-arrow-left"></i> <?php echo Yii::t('GalleryModule.base', 'Back to the list'); ?></a>
        <h1><strong><?php echo Html::encode($gallery->title); ?></strong></h1>
        <div class="row">
            <div class="col-sm-12 gallery-description">
                <?php echo Html::encode($gallery->description); ?><br />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 social-activities colorFont5">
                <?php echo LikeLink::widget(['object' => $gallery]); ?>
                |
                <?php echo CommentLink::widget(['object' => $gallery]); ?>
            </div>
            <div class="col-sm-12 comments">
                <?php echo Comments::widget(['object' => $gallery]); ?>
            </div>
        </div>
        <hr />
        <?php if($this->context->canWrite(false)): ?>
        <div class="row button-action-menu">
            <div class="col-sm-4">
                <span class="fileinput-button btn btn-default overflow-hidden"> <i
                    class="glyphicon glyphicon-plus"></i> <?php echo Yii::t('GalleryModule.base', 'Upload'); ?> <input
                    id="galleryMediaUpload" type="file" name="files[]"
                    multiple>
                </span>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-default" data-target="#globalModal"
                    href="<?php echo $this->context->contentContainer->createUrl('edit', ['open-gallery-id' => $gallery->id, 'item-id' => $gallery->getItemId()]); ?>">Edit
                    Gallery</a>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-default" data-target="#globalModal"
                    href="<?php echo $this->context->contentContainer->createUrl('/gallery/list/delete-multiple', ['item-id' => $gallery->getItemId()]); ?>">Delete
                    Gallery</a>
            </div>
        </div>
        <?php endif;?>
        <div class="row">
            <div id="logContainer" class="col-sm-12" style="display: none">
                <ul class="alert alert-danger">
                </ul>
            </div>
            <?php echo CustomGalleryContent::widget([ 'gallery' => $gallery]); ?>
        </div>
    </div>
</div>