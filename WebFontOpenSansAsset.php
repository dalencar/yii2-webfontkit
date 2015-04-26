<?php

/**
 * @copyright Copyright &copy; Davidson Alencar, dalencar.com, 2015
 * @package yii2-webfontkit
 * @version 1.0.0
 */

namespace dalencar\webfontkit;

use yii\web\AssetBundle;

/**
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */
class WebFontOpenSansAsset extends AssetBundle {

    public $sourcePath = '@vendor/webfontkit/open-sans';
    public $css = [
        'open-sans.css',
    ];

}
