<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web';
    
    public $css = [
        'css/site.css',
        'angular/angular-material.min.css',
    ];
    public $js = [
        'js/jquery-3.4.1.js',
        'angular/angular.js',
        'angular/angular-animate.js',
        'angular/angular-aria.min.js',
        'angular/angular-messages.min.js',
        'angular/angular-material.min.js',
        'angular/angular-cookies.min.js',
        'js/main.js',
    ];
    public $depends = [
        
    ];
    
    public $jsOptions = [
        'position' => 1
    ];
    
}
