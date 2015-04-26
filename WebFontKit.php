<?php

/**
 * @copyright Copyright &copy; Davidson Alencar, dalencar.com, 2015
 * @package yii2-webfontkit
 * @version 1.0.0
 */

namespace dalencar\webfontkit;

use Yii;
use yii\web\AssetBundle;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * WebFontKit is a class for setting up webfont frameworks to work with Yii in an easy way
 * To setup a global default webfont framework, you can set the Yii param 'webfontkit-framework'
 * to one of the following values in your config file:
 * - 'os' for Open Sans
 * - 'ro' for Roboto
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 */
class WebFontKit extends AssetBundle
{

    const NS = '\\dalencar\\webfontkit\\';
    const PARAM_NOT_SET = "The 'webfontkit-framework' option has not been setup in Yii params. Check your configuration file.";
    const PARAM_INVALID = "Invalid or non-recognized 'webfontkit-framework' has been setup in Yii params. Check your configuration file.";
    const FRAMEWORK_INVALID = "Invalid or non-existing framework '{framework}' called in your {method}() method.";

    /**
     * Webfont framework constants
     */
    const OS = 'os';
    const RO = 'ro';

    /**
     * Webfont framework configurations
     */
    private static $_frameworks = [
        self::OS => ['class' => 'WebFontOpenSansAsset'],
        self::RO => ['class' => 'WebFontRobotoAsset'],
    ];
    
    /**
     * @inherit
     */
    public function init() {
        $this->depends = ArrayHelper::merge(static::getAssetBundles(), $this->depends);
        parent::init();
    }

    /**
     * Returns the font framework setup from Yii parameters.
     *
     * @var string|array the framework to be used with the application
     * @throws InvalidConfigException
     */
    protected static function getFramework($framework = null)
    {
        if (is_string($framework)) {
            $framework = [$framework];
        }
        if (!empty($framework) && !!array_diff($framework, array_keys(self::$_frameworks))) {
            $replace = ['{framework}' => join($framework, ','), '{method}' => 'WebFontKit::getAssetBundles'];
            throw new InvalidConfigException(strtr(self::FRAMEWORK_INVALID, $replace));
        }
        if (!empty($framework)) {
            return $framework;
        }
        if (empty(Yii::$app->params['webfontkit-framework'])) {
            throw new InvalidConfigException(self::PARAM_NOT_SET);
        }
        $framework = Yii::$app->params['webfontkit-framework'];
        if (is_string($framework)) {
            $framework = [$framework];
        }
        if (!!array_diff($framework, array_keys(self::$_frameworks))) {
            throw new InvalidConfigException(self::PARAM_INVALID);
        }
        return $framework;
    }

    /**
     * Maps the webfont framework to the current view. Call this in your view or layout file.
     *
     * @param object $view the view object
     * @param string|array $framework the name of the framework, if not passed it will default to
     * the Yii config param 'webfontkit-framework'
     */
    public static function register($view, $framework = null)
    {
        $assets = static::getAssetBundles($framework);
        foreach ($assets as $asset) {
            $asset::register($view);
        }
    }
    
    /**
     * Maps the webfont framework to the current view. Call this in your view or layout file.
     *
     * @param string|array $framework the name of the framework, if not passed it will default to
     * the Yii config param 'webfontkit-framework'
     */
    public static function getAssetBundles($framework = null)
    {
        $keys = static::getFramework($framework);
        $assets = [];
        foreach ($keys as $key) {
            $class = self::$_frameworks[$key]['class'];
            if (substr($class, 0, 1) != '\\') {
                $class = self::NS . $class;
            }
            $assets[] = $class;
        }
        return $assets;            
    }

}