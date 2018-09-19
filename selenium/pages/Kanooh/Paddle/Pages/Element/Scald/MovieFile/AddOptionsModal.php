<?php
/**
 * @file
 * Contains \Kanooh\Paddle\Pages\Element\Scald\MovieFile\AddOptionsModal.
 */

namespace Kanooh\Paddle\Pages\Element\Scald\MovieFile;

use Kanooh\Paddle\Pages\Element\Scald\AddOptionsModalBase;

/**
 * Modal to change the options of a video file.
 *
 * @property AddOptionsForm $form
 *   The options form.
 */
class AddOptionsModal extends AddOptionsModalBase
{
    public function __get($name)
    {
        switch ($name) {
            case 'form':
                return new AddOptionsForm($this->webdriver, $this->webdriver->byXPath($this->formXpath));
        }
    }
}
