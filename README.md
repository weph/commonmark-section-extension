# weph/commonmark-section-extension

This [league/commonmark](https://github.com/thephpleague/commonmark) extension 
wraps headings and associated content into sections.

## Installation & Basic Usage

```bash
composer require weph/commonmark-section-extension
```

Example:

```php
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Weph\CommonMark\SectionExtension;

$environment = new Environment();
$environment->addExtension(new CommonMarkCoreExtension());
$environment->addExtension(new SectionExtension());

$converter = new MarkdownConverter($environment);

echo $converter->convert(<<<EOMD
# Title

## Section 1

Section 1 content

### Section 1.1

Section 1.1 content

## Section 2

Section 2 content
EOMD
);
```

Output:

```html
<section>
    <h1>Title</h1>
    <section>
        <h2>Section 1</h2>
        <p>Section 1 content</p>
        <section>
            <h3>Section 1.1</h3>
            <p>Section 1.1 content</p>
        </section>
    </section>
    <section>
        <h2>Section 2</h2>
        <p>Section 2 content</p>
    </section>
</section>
```
