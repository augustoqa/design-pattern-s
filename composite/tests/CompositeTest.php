<?php


namespace Styde\Tests;

use Styde\Html\{
    Form,
    Fieldset,
    Legend,
    Textarea,
    Input
};


class CompositeTest extends TestCase
{
    /** @test */
    function it_generates_nested_html()
    {
        $form = new Form;

        $contentFieldset = new Fieldset;

        $legend = new Legend('Contenido');

        $contentFieldset->add($legend);

        $input = new Input('title');

        $contentFieldset->add($input);

        $textarea = new Textarea('content');

        $contentFieldset->add($textarea);

        $form->add($contentFieldset);

        $expected = <<<HTML
<form>
    <fieldset>
        <legend>Contenido</legend>
        <input name="title">
        <textarea name="content"></textarea>
    </fieldset>
</form>
HTML;

        $this->assertSame($this->removeIndentation($expected), $form->render());
    }

    protected function removeIndentation(string $expected)
    {
        return str_replace([PHP_EOL, '    '], '', $expected);
    }
}