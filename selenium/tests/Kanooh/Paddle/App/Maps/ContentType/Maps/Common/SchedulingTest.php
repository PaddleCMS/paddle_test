<?php

/**
 * @file
 * Contains \Kanooh\Paddle\App\Maps\ContentType\Maps\Common\SchedulingTest.
 */

namespace Kanooh\Paddle\App\Maps\ContentType\Maps\Common;

use Kanooh\Paddle\Apps\Maps;
use Kanooh\Paddle\Core\ContentType\Base\SchedulingTestBase;
use Kanooh\Paddle\Utilities\AppService;

/**
 * Class SchedulingTest
 * @package Kanooh\Paddle\App\Maps\ContentType\Maps\Common
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class SchedulingTest extends SchedulingTestBase
{
    /**
     * {@inheritdoc}
     */
    public function setupPage()
    {
        parent::setUpPage();

        $service = new AppService($this, $this->userSessionService);
        $service->enableApp(new Maps);
    }

    /**
     * {@inheritdoc}
     */
    public function setupNode($title = null)
    {
        return $this->contentCreationService->createMapsPage($title);
    }
}
