# Laravel

Laravel6.x（LTS）を動かしてみるサンプル

## ミドルウエアとフレームワーク

下記で動作確認を行っています
- php
 -- 7.4
 -- Laravel 6.x
  --- 6が現時点でLTS（202003時点では7がリリースされた）
  --- https://readouble.com/laravel/ でリリースバージョン確認できる
- nginx
 -- 1.16
- mysql
 -- 8.0

## インストール関連

gitをcloneした後に必要なライブラリ群を取得する
```
composer install
※composer.jsonやcomposer.lockファイルを参照して、記載されているライブラリや特定バージョンで取得する
```

ex）構築時の初回インストールは下記で対応している
```
composer create-project laravel/laravel laravel --prefer-dist "6.*"
※packageのURL（https://repo.packagist.org/packages.json）がリンク切れでインストールできない場合があるのでその場合は下記を実行する
composer config -g repos.packagist composer https://packagist.jp
```

## ディレクトリ構造（簡略版）

```
laravel
├── app
│   ├── Console // バッチ
│   ├── Http
│   │   ├── Controllers // コントローラ(web)
│   │   │   └── Api // コントローラ(api)
│   │   └── Requests // バリデーション
│   ├── Services // ビジネスロジック
│   ├── Repositories // モデルへのCRUD操作
│   ├── Providers // プロバイダ設定（Repositoriesのbind）
│   └── Models // モデル（テーブルと1:1になるように作成）
├── config // 定数など
├── resources // ビュー関連
├── routes // ルーティング設定
├── storage // ログなど環境変数（一部Git管理していません）
├── tests // テスト関連
└── .env // 環境変数（Git管理していません）
```

## 処理の流れ

- オニオンアーキテクチャの思想を実現できるように構成している（つもり）
 -- httpリクエスト → Requests（バリデーション） → Controllers → Services → Repositories → Models → DB（データストア）
 -- クリーンアーキテクチャに最終的にはしたい
- 参考URL
 -- https://qiita.com/little_hand_s/items/ebb4284afeea0e8cc752
 -- https://qiita.com/little_hand_s/items/2040fba15d90b93fc124

## サンプル

- 下記のサイトを参考に最低限のTODOリストを作成（一覧・作成・編集）
 -- https://www.hypertextcandy.com/laravel-tutorial-introduction/
 -- DBとwebサーバを用意すれば動きます
 --- https://github.com/hszk/docker-php-nginx-mysql-pma と合わせれば一応動く
- テーブル情報は下記
 -- マイグレーション
  --- database/migrations/2020_03_11_034529_create_tasks_table.php
 -- シード（サンプルデータ）
  --- database/seeds/TasksTableSeeder.php

## コーディング

- 全体的に
 -- ディレクトリ構造（簡略版）に記載した処理の基本的な流れは守るようにコーディングをする
 --- ex）ControllersからRepositoriesのメソッドを呼び出すことはしない
 --- ↑似たような処理でも必ずServicesを通す（将来的にビジネスロジックが入った時に対応が面倒になるので）
 -- 環境変数はconfigを経由して呼び出すようにする
- Repositories
 -- ModelsへのアクセスはEloquentを使用する
 --- https://readouble.com/laravel/6.x/ja/eloquent.html
 --- 使い方はネットで確認（たくさん情報はあるはず）
 --- テーブルの指定で「DB::table('テーブル名')」という指定はしないこと（クエリビルダになるので）
- Models
 -- 定数値でDBの値に関連するものはModelsで定義をする
 --- app/Models/Task.phpのconstを確認
 --- statusを文字列に変換する場合はAttributeを使用する

## エラー監視

- sentryを導入
 -- https://sentry.io/welcome/
 -- https://qiita.com/megane42/items/8e68ee40b1d9a360a5b9

ライブラリのインストールは下記で対応する
```
composer require sentry/sentry-laravel
※packageのURL（https://repo.packagist.org/packages.json）がリンク切れでインストールできない場合があるのでその場合は下記を実行する
composer config -g repos.packagist composer https://packagist.jp
sentryにアカウントを作成してプロジェクトを作成したときに出てくる設定を行う
.envにSENTRY_LARAVEL_DSNを設定すれば動く
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
