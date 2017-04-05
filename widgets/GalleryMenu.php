<?php

namespace humhub\modules\gallery\widgets;

use humhub\modules\file\handler\FileHandlerCollection;

/**
 * Widget for rendering the file list menu.
 */
class GalleryMenu extends \yii\base\Widget
{

    /**
     * Current gallery model instance.
     * @var \humhub\modules\gallery\models\BaseGallery
     */
    public $gallery;

    /**
     * @var \humhub\modules\content\components\ContentContainerActiveRecord Current content container.
     */
    public $contentContainer;

    /**
     * @var boolean Determines if the user has write permissions.
     */
    public $canWrite;

    /**
     * @var integer FileList item count.
     */
    public $itemCount;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $fileHandlerImport = FileHandlerCollection::getByType(FileHandlerCollection::TYPE_IMPORT);
        $fileHandlerCreate = FileHandlerCollection::getByType(FileHandlerCollection::TYPE_CREATE);

        return $this->render('galleryMenu', [
                    'gallery' => $this->gallery,
                    'contentContainer' => $this->contentContainer,
                    'canWrite' => $this->canWrite,
                    'fileHandlers' => array_merge($fileHandlerCreate, $fileHandlerImport),
        ]);
    }

}