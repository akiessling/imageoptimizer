<?php
namespace Lemming\Imageoptimizer\EventListener;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Resource\Event\AfterFileProcessingEvent;

class AfterFileProcessing extends AbstractEventListener
{
    public function __invoke(AfterFileProcessingEvent $event): void
    {
        if ($event->getProcessedFile()->isUpdated() && !$event->getProcessedFile()->usesOriginalFile()) {
            $this->getService()->process(
                Environment::getPublicPath() . '/' . ltrim($event->getProcessedFile()->getPublicUrl(true), '/'),
                $event->getProcessedFile()->getExtension()
            );
        }
    }
}
