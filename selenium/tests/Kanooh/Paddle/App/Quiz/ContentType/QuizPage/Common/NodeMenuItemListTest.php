<?php

/**
 * @file
 * Contains \Kanooh\Paddle\App\Quiz\ContentType\QuizPage\Common\NodeMenuItemListTest.
 */

namespace Kanooh\Paddle\App\Quiz\ContentType\QuizPage\Common;

use Kanooh\Paddle\Apps\Quiz;
use Kanooh\Paddle\Core\ContentType\Base\NodeMenuItemListTestBase;
use Kanooh\Paddle\Utilities\AppService;
use Kanooh\Paddle\Utilities\ContentCreationService;

/**
 * Class NodeMenuItemListTest
 * @package Kanooh\Paddle\Core\ContentType\QuizPage\Common
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class NodeMenuItemListTest extends NodeMenuItemListTestBase
{
    /**
     * {@inheritdoc}
     */
    public function setupPage()
    {
        parent::setUpPage();

        $service = new AppService($this, $this->userSessionService);
        $service->enableApp(new Quiz);
    }

    /**
     * {@inheritdoc}
     */
    public function setupNode($title = null)
    {
        $service = new ContentCreationService($this, $this->userSessionService);
        return $service->createQuizPageViaUI($title);
    }

    /**
     * {@inheritdoc}
     */
    public function getContentTypeName()
    {
        return 'quiz_page';
    }
}
