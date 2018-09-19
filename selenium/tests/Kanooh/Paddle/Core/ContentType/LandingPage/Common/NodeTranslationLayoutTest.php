<?php

/**
 * @file
 * Contains \Kanooh\Paddle\Core\ContentType\LandingPage\Common\NodeTranslationLayoutTestBase.
 */

namespace Kanooh\Paddle\Core\ContentType\LandingPage\Common;

use Kanooh\Paddle\App\Multilingual\ContentType\Base\NodeTranslationLayoutTestBase;
use Kanooh\Paddle\Pages\Admin\ContentManager\AddPage\CreateNodeModal;
use Kanooh\Paddle\Pages\Admin\ContentManager\PanelsContentPage\PanelsContentPage;

/**
 * {@inheritdoc}
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class NodeTranslationLayoutTest extends NodeTranslationLayoutTestBase
{
    /**
     * @inheritDoc
     */
    public function setUpPage()
    {
        parent::setUpPage();

        $this->layoutPage = new PanelsContentPage($this);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpNode()
    {
        return $this->contentCreationService->createLandingPage();
    }

    /**
     * {@inheritDoc}
     */
    public function fillTranslationModal($title = null)
    {
        $title = !empty($title) ? $title : $this->alphanumericTestDataProvider->getValidValue();

        $modal = new CreateNodeModal($this);
        $modal->waitUntilOpened();
        $modal->title->fill($title);
        $modal->submit();
        $modal->waitUntilClosed();
    }
}
