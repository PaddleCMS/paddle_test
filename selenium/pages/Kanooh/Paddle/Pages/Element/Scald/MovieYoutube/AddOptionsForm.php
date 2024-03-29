<?php
/**
 * @file
 * Contains \Kanooh\Paddle\Pages\Element\Scald\MovieYoutube\AddOptionsForm.
 */

namespace Kanooh\Paddle\Pages\Element\Scald\MovieYoutube;

use Kanooh\Paddle\Pages\Element\Form\FileField;
use Kanooh\Paddle\Pages\Element\Form\Text;
use Kanooh\Paddle\Pages\Element\Scald\AddOptionsFormBase;

/**
 * Form to change the options of a Youtube video.
 *
 * @property Text $title
 * @property FileField $thumbnail
 * @property FileField $subtitles
 */
class AddOptionsForm extends AddOptionsFormBase
{
    public function __get($name)
    {
        switch ($name) {
            case 'title':
                $element = $this->element->byXPath('.//input[@name="atom0[title]"]');

                return new Text($this->webdriver, $element);
            case 'thumbnail':
                return new FileField(
                    $this->webdriver,
                    '//input[@name="files[atom0_scald_thumbnail_und_0]"]',
                    '//input[@name="atom0_scald_thumbnail_und_0_upload_button"]',
                    '//input[@name="atom0_scald_thumbnail_und_0_remove_button"]'
                );
            case 'subtitles':
                return new FileField(
                    $this->webdriver,
                    '//input[@name="files[atom0_paddle_scald_video_subtitles_und_0]"]',
                    '//input[@name="atom0_paddle_scald_video_subtitles_und_0_upload_button"]',
                    '//input[@name="atom0_paddle_scald_video_subtitles_und_0_remove_button"]'
                );
        }

        return parent::__get($name);
    }
}
