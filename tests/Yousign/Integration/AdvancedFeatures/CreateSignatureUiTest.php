<?php

namespace YousignTest\Integration\AdvancedFeatures;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use YousignTest\DataHelper;
use Yousign\YousignApi;

class CreateSignatureUiTest extends TestCase
{
    /**
     * Create user
     */
    public function testSuccess()
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(DataHelper::getFakeCreatedUi()), true)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign
            ->setClientOptions([
                'handler' => $handlerStack
            ]);

        $signatureUi = $yousign->postSignatureUi([
            "name"                    => "My first template for Signature-UI",
            "description"             => "Here is the Signature-UI template for Yousign Developers.",
            "defaultZoom"             => 100,
            "logo"                    => "data:image/png;base64,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",
            "languages"               => ["fr", "en"],
            "defaultLanguage"         => "en",
            "labels"                  => [
                [
                    "name"      => "NAME OF THE LABEL",
                    "languages" => [
                        "en" => "Label en",
                        "fr" => "Label fr"
                    ],
                    "creator"   => null,
                ]
            ],
            "signImageTypesAvailable" => [
                "name",
                "draw",
            ],
            "enableHeaderBar"         => true,
            "enableHeaderBarSignAs"   => true,
            "enableSidebar"           => true,
            "enableMemberList"        => true,
            "enableDocumentList"      => true,
            "enableDocumentDownload"  => true,
            "enableActivities"        => false,
            "authenticationPopup"     => false,
            "enableRefuseComment"     => true,
            "fonts"                   => ["Roboto", "Lato"],
            "creator"                 => null,
            "redirectCancel"          => [
                "url"    => "https://example.com?cancel=1",
                "target" => "_top",
                "auto"   => false
            ],
            "redirectError"           => [
                "url"    => "https://example.com?error=1",
                "target" => "_blank",
                "auto"   => true
            ],
            "redirectSuccess"           => [
                "url"    => "https://example.com?success=1",
                "target" => "_parent",
                "auto"   => true
            ],
            "style"                   => "
                .sign-ui-header-bar { background-color: #00f }
                .sign-ui-headerbar-signas { background-color: #f00 }
                .sign-ui-headerbar-signas--primary { background-color: #f00 }
                .sign-ui-tab-item { color: #000 }
                .sign-ui-tab-item--current { background-color: #0f0; color: #fff }
            "
        ]);

        $this->assertEquals(
            DataHelper::getFakeCreatedUi(),
            $signatureUi->toArray()
        );
    }
}
