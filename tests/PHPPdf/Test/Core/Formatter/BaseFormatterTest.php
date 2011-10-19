<?php

namespace PHPPdf\Test\Core\Formatter;

use PHPPdf\Core\Formatter\BaseFormatter;
use PHPPdf\Stub\Formatter\StubFormatter;

abstract class BaseFormatterTest extends \PHPPdf\PHPUnit\Framework\TestCase
{
    private $formatter;

    public function setUp()
    {
        $this->formatter = new StubFormatter();
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function throwExceptionIfTryToGetUnsettedDocument()
    {
        $this->formatter->getDocument();
    }

    /**
     * @test
     */
    public function dontThrowExceptionIfDocumentIsSet()
    {
        $document = new \PHPPdf\Core\Document();
        $this->formatter->setDocument($document);

        $this->assertTrue($document === $this->formatter->getDocument());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function unserializedFormatterHaveDocumentDetached()
    {
        $document = new \PHPPdf\Core\Document();
        $this->formatter->setDocument($document);

        $unserializedFormatter = unserialize(serialize($this->formatter));

        $unserializedFormatter->getDocument();
    }
}