<?php
/**
 * Short description for speech-bubble.php
 *
 * @package speech-bubble
 * @author Kazuya Kanatani
 * @version 2.0.0
 * @copyright (C) 2017 kinformation<kanatani.social@gmail.com>
 * @license MIT
 */

namespace Grav\Plugin;

use Grav\Common\Plugin;

/**
 * Class SpeechBubblePlugin
 * @package Grav\Plugin
 */
class SpeechBubblePlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
        ];
    }

    /**
     * Initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Add style and script to page.
     */
    public function onTwigSiteVariables()
    {
        $this->grav['assets']->addCss('plugin://speech-bubble/assets/css/speech-bubble.css');
    }
}
