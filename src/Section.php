<?php
declare(strict_types=1);

namespace Weph\CommonMark;

use League\CommonMark\Node\Block\AbstractBlock;

final class Section extends AbstractBlock
{
    public function __construct(public readonly int $level)
    {
        parent::__construct();
    }
}
