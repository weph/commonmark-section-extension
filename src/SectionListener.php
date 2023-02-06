<?php
declare(strict_types=1);

namespace Weph\CommonMark;

use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Node\Block\Document;

final class SectionListener
{
    public function __invoke(DocumentParsedEvent $event): void
    {
        $currentSection = $event->getDocument();

        foreach ($event->getDocument()->children() as $node) {
            if ($node instanceof Heading) {
                while ($currentSection instanceof Section && $currentSection->level >= $node->getLevel()) {
                    $parent = $currentSection->parent();

                    \assert($parent instanceof Section || $parent instanceof Document);

                    $currentSection = $parent;
                }

                $section = new Section($node->getLevel());
                $section->appendChild($node);

                $currentSection->appendChild($section);

                $currentSection = $section;
                continue;
            }

            $currentSection->appendChild($node);
        }
    }
}
