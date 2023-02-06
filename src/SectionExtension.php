<?php
declare(strict_types=1);

namespace Weph\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;

/**
 * @psalm-suppress UnusedClass
 */
final class SectionExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(DocumentParsedEvent::class, new SectionListener(), 1001);
        $environment->addRenderer(Section::class, new SectionRenderer());
    }
}
