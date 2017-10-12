<?php
/**
 * Short description for SpeechBubbleShortcode.php
 *
 * @package speech-bubble
 * @author Kazuya Kanatani
 * @version 1.0.0
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
            if (empty($side)) {
                $side = 'left';
            }

            // bubble icon setting
            $icon_disp = $this->config->get('plugins.speech-bubble.icon.display');
            $icon = $this->config->get('plugins.speech-bubble.icon.image.'.$side);
            if (empty($icon_disp) || empty($side)) {
                $icon_disp = false;
            }

            // bubble content setting
            $text = $sc->getContent();
            if (empty($side)) {
                $text = " ";
            }

            return $this->twig->processTemplate('partials/bubble.twig', [
                'bubble_side' => $side,
                'bubble_text' => $text,
                'bubble_icon_disp' => $icon_disp,
                'bubble_icon' => $icon,
            ]);
        });
    }
}
