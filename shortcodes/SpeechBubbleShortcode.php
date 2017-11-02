<?php
/**
 * Short description for SpeechBubbleShortcode.php
 *
 * @package speech-bubble
 * @author Kazuya Kanatani
 * @version 2.0.2
 * @copyright (C) 2017 kinformation<kanatani.social@gmail.com>
 * @license MIT
 */

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SpeechBubbleShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('bubble', function (ShortcodeInterface $sc) {

            /* bubble setting */
            // direction
            $side = $sc->getParameter('side');
            if (empty($side) || ($side != 'left' && $side != 'right')) {
                $side = 'left';
            }

            // type
            $type = !empty($sc->getParameter('type'))
                ? $sc->getParameter('type')
                : $this->config->get('plugins.speech-bubble.bubble.type');
            if (empty($type)) {
                $type = 'std';
            }

            // content
            $text = $sc->getContent();
            if (empty($text)) {
                $text = " ";
            }

            /* icon setting */
            // image
            $ICON_DIR = '/user/plugins/speech-bubble/assets/icon/';
            $icon = !empty($sc->getParameter('icon'))
                ? $sc->getParameter('icon')
                : $ICON_DIR.$this->config->get('plugins.speech-bubble.icon.image.'.$side);

            // frame
            $icon_type = $this->config->get('plugins.speech-bubble.icon.type');
            if (empty($icon_type) || empty($icon)) {
                $icon_type = 'hidden';
            }

            // label
            if ($icon_type != 'hidden'){
                $icon_label = $sc->getParameter('label');
            }

            return $this->twig->processTemplate('partials/bubble.twig', [
                'bubble_side' => $side,
                'bubble_type' => $type,
                'bubble_text' => $text,
                'bubble_icon' => $icon,
                'bubble_icon_type' => $icon_type,
                'bubble_icon_label' => $icon_label,
            ]);
        });
    }
}
