<?php
declare(strict_types=1);

namespace Weph\CommonMark\Tests;

use League\CommonMark\ConverterInterface;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Xml\MarkdownToXmlConverter;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Weph\CommonMark\SectionExtension;

#[CoversNothing]
final class SectionExtensionTest extends TestCase
{
    #[Test]
    #[DataProvider(methodName: 'examples')]
    #[TestDox('$converter should convert $input to $expected')]
    public function convertMarkdown(ConverterInterface $converter, string $input, string $expected): void
    {
        $result = $converter
            ->convert(file_get_contents($input))
            ->getContent();

        self::assertStringEqualsFile($expected, $result);
    }

    /**
     * @return iterable<string, array{0: ConverterInterface, 1: string, 2: string}>
     */
    public static function examples(): iterable
    {
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new SectionExtension());
        $xmlConverter = new MarkdownToXmlConverter($environment);
        $htmlConverter = new MarkdownConverter($environment);

        foreach (glob(__DIR__ . '/examples/*.md') as $markdownFile) {
            $example = basename($markdownFile, '.md');

            yield sprintf('%s to xml', $example) => [$xmlConverter, $markdownFile, str_replace('.md', '.xml', $markdownFile)];
            yield sprintf('%s to html', $example) => [$htmlConverter, $markdownFile, str_replace('.md', '.html', $markdownFile)];
        }
    }
}
