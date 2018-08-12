<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//use.fontawesome.com/releases/v5.1.1/css/all.css',
        'vendor/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css',
        'css/site.css',
    ];
    public $js = [
        'vendor/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
