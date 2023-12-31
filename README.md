# デジタル会員証発行ツール（DEMO）
会員登録すると、会員番号が入ったQRコード付きのAppleウォレットパスを発行するLaravelアプリケーションのデモンストレーションです。  
詳細は[ブログをご覧ください](https://shugomatsuzawa.com/techblog/2023/12/03/288/)。
## ローカルで実行する
はじめに、Laravel Sailが実行できるようにDockerをセットアップしてください。

```storage/app/keys/```に次のファイルを入れます。
- Apple Worldwide Developer Relations Certification Authorityを.pem形式に変換したもの
- Apple Developerアカウントを使って自分で作成した証明書を.p12形式に変換したもの（ブログを参照）

```.env.example```を複製して```.env```を作成し、次の箇所を変更します。
```
# Passgenerator
# Apple DeveloperアカウントのチームID (https://developer.apple.com/account に載っている)
APPLE_DEVELOPER_TEAM_ID="0000AA0000"
# p12証明書の絶対パス
CERTIFICATE_PATH="/var/www/html/storage/app/keys/pass.p12"
# p12証明書作成字のパスワード
CERTIFICATE_PASS="password"
# Worldwide Developer Relations Certification Authorityの絶対パス
WWDR_CERTIFICATE="/var/www/html/storage/app/keys/Apple Worldwide Developer Relations Certification Authority.pem"
```

プロジェクトディレクトリに移動し、次のコマンドで起動します。
```sh
./vendor/bin/sail up
```
## 詳しい情報
Laravelに関する詳しい情報は、[Laravelのドキュメント](https://laravel.com/docs)をご覧ください。  
Passgeneratorに関する詳しい情報は、[Passgeneratorのリポジトリ](https://github.com/thenextweb/passgenerator)をご覧ください。  
Appleウォレットに関する詳しい情報は、[Apple Developer Webサイト](https://developer.apple.com/library/archive/documentation/UserExperience/Conceptual/PassKit_PG/index.html#//apple_ref/doc/uid/TP40012195-CH1-SW1)をご覧ください。