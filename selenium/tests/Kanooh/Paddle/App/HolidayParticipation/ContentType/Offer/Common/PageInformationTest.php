<?php

/**
 * @file
 * Contains \Kanooh\Paddle\App\HolidayParticipation\ContentType\Offer\Common\PageInformationTest.
 */

namespace Kanooh\Paddle\App\HolidayParticipation\ContentType\Offer\Common;

use Kanooh\Paddle\Apps\HolidayParticipation;
use Kanooh\Paddle\Core\ContentType\Base\PageInformationTestBase;
use Kanooh\Paddle\Utilities\AppService;

/**
 * Class PageInformationTest
 * @package Kanooh\Paddle\App\HolidayParticipation\ContentType\Offer\Common
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PageInformationTest extends PageInformationTestBase
{
    /**
     * {@inheritdoc}
     */
    public function setupPage()
    {
        parent::setUpPage();

        $service = new AppService($this, $this->userSessionService);
        $service->enableApp(new HolidayParticipation);
    }

    /**
     * {@inheritdoc}
     */
    public function setupNode($title = null)
    {
        return $this->contentCreationService->createOfferPage($title);
    }
}
