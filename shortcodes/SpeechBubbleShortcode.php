<?php
/**
 * Short description for SpeechBubbleShortcode.php
 *
 * @package speech-bubble
 * @author Kazuya Kanatani
 * @version 1.1.0
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

            // bubble side setting
            $side = $sc->getParameter('side');
            if (empty($side) || ($side != 'left' && $side != 'right')) {
                $side = 'left';
            }

            // bubble icon setting
            $icon = !empty($sc->getParameter('icon'))
                ? $sc->getParameter('icon')
                : $this->config->get('plugins.speech-bubble.icon.image.'.$side);
            $icon_type = $this->config->get('plugins.speech-bubble.icon.type');
            if (empty($icon_type) || empty($icon)) {
                $icon_type = 'hidden';
            }

            if ($icon_type != 'hidden'){
                $icon_label = $sc->getParameter('label');
            }

            // bubble content setting
            $text = $sc->getContent();
            if (empty($side)) {
                $text = " ";
            }

            return $this->twig->processTemplate('partials/bubble.twig', [
                'bubble_side' => $side,
                'bubble_text' => $text,
                'bubble_icon' => $icon,
                'bubble_icon_type' => $icon_type,
                'bubble_icon_label' => $icon_label,
            ]);
        });
    }
}
