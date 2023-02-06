<?php
declare(strict_types=1);

namespace Weph\CommonMark;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

final class SectionRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    public function getXmlTagName(Node $node): string
    {
        return 'section';
    }

    public function getXmlAttributes(Node $node): array
    {
        return [];
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        return new HtmlElement('section', [], $childRenderer->renderNodes($node->children()));
    }
}
