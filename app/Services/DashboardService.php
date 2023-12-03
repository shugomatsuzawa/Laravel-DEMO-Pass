<?php

namespace App\Services;

use Thenextweb\PassGenerator;

class DashboardService
{
    public function createWalletPass($pass_identifier)
    {
        $pass = new PassGenerator($pass_identifier);

        $pass_definition = [
            "formatVersion"     => 1,
            "passTypeIdentifier"=> "pass.com.shugomatsuzawa.demo",
            "serialNumber"      => (string)auth()->id(),
            "teamIdentifier"    => env('APPLE_DEVELOPER_TEAM_ID'),

            "organizationName"  => "Shugo Matsuzawa",
            "description"       => "Shugo Matsuzawa ロイヤリティカード",
            "logoText"          => "Shugo Matsuzawa",
            "foregroundColor"   => "rgb(112, 112, 112)",
            "backgroundColor"   => "rgb(255, 255, 255)",

            "barcode" => [
                "message"   => (string)auth()->id(),
                "format"    => "PKBarcodeFormatQR",
                "messageEncoding"=> "utf-8",
            ],

            "storeCard" => [
                "headerFields" => [
                    [
                        "key" => "label",
                        "value" => "DEMO",
                    ],
                ],
                "auxiliaryFields" => [
                    [
                        "key" => "member_name",
                        "label" => "お名前",
                        "value" => auth()->user()->name,
                    ],
                    [
                        "key" => "member_id",
                        "label" => "会員番号",
                        "value" => (string)auth()->id(),
                    ],
                    [
                        "key" => "member_since",
                        "label" => "ご登録",
                        "value" => auth()->user()->created_at->format('Y年m月'),
                    ],
                ],
                "backFields" => [
                    [
                        "key" => "phone",
                        "label" => "電話",
                        "value" => "+81 3 1234 5678"
                    ], [
                        "key" => "website",
                        "label" => "サポートWebサイト",
                        "value" => "https://shugomatsuzawa.com"
                    ], [
                        "key" => "privacy",
                        "label" => "プライバシーポリシー",
                        "value" => "https://shugomatsuzawa.com/privacy/"
                    ], [
                        "key" => "terms",
                        "label" => "利用規約",
                        "value" => "この利用規約（以下、「本規約」といいます）は、[お店の名前]（以下、「当店」といいます）が提供する会員証サービス（以下、「本サービス」といいます）に関する条件を規定します。本サービスを利用する際には、以下の規約に同意していただく必要があります。\n\n1. 会員資格\n1.1. 本サービスの利用資格は、[条件を記載]となります。\n1.2. 会員は、本サービスを他者に譲渡・移転することはできません。\n\n2. 会員証の発行と利用\n2.1. 会員証は[発行条件を記載]に基づき、当店が発行します。\n2.2. 会員証は本人のみが利用でき、他者に貸与することはできません。\n\n3. ポイントおよび特典\n3.1. 会員は、本サービスの利用に伴い、ポイントや特典を享受できる場合があります。これらの条件は随時変更される可能性があります。\n3.2. ポイントや特典は、[利用条件や期限を記載]に基づき提供されます。\n\n4. プライバシーと個人情報\n4.1. 会員のプライバシーと個人情報は、当店のプライバシーポリシーに基づき取り扱われます。\n\n5. 会員証の紛失・盗難\n5.1. 会員は、会員証の紛失・盗難があった場合、直ちに当店に報告する責任があります。\n\n6. 本規約の変更\n6.1. 当店は、本規約を随時変更できるものとし、変更後の規約は本ウェブサイト上で掲示された時点で効力を発生します。\n\n7. サービスの終了\n7.1. 当店は予告なく本サービスを終了する権利を有します。\n\n8. 免責事項\n 8.1. 当店は、本サービスの利用に伴う一切の損害やトラブルに対して一切の責任を負いません。\n\n9. その他の条件\n9.1. 本規約に定められていない事項については、関係法令および一般的な商慣習に従います。\n\n©︎Shugo Matsuzawa 2023"
                    ]
                ],
                "locations" => [
                    [
                        "latitude" => 37.6189722,
                        "longitude" => -122.3748889,
                    ]
                ],
            ],
        ];

        $pass->setPassDefinition($pass_definition);

        // Definitions can also be set from a JSON string
        // $pass->setPassDefinition(file_get_contents('/path/to/pass.json));

        // Add assets to the PKPass package
        $pass->addAsset(base_path('resources/assets/wallet/icon.png'));
        $pass->addAsset(base_path('resources/assets/wallet/icon@2x.png'));
        $pass->addAsset(base_path('resources/assets/wallet/icon@3x.png'));
        $pass->addAsset(base_path('resources/assets/wallet/logo.png'));
        $pass->addAsset(base_path('resources/assets/wallet/logo@2x.png'));
        $pass->addAsset(base_path('resources/assets/wallet/logo@3x.png'));
        $pass->addAsset(base_path('resources/assets/wallet/strip.png'));
        $pass->addAsset(base_path('resources/assets/wallet/strip@2x.png'));
        $pass->addAsset(base_path('resources/assets/wallet/strip@3x.png'));

        $pkpass = $pass->create();
        return $pkpass;
    }
}