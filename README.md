# CommuniCare

## どのようなサービスなのか？

**職員の効率的なコミュニケーションと情報管理を支援**

CommuniCare は、介護施設の運営を効率化するために、職員間のスムーズなコミュニケーションと利用者様の情報を一元管理するプラットフォームです。

![サービスのメインビジュアル](public/images/hero-section.png)

---

## サービスの URL

[https://communi-care.jp](https://communi-care.jp/)

ゲストデモ機能を実装しましたので、登録せずにお試しいただくことができます。  
ゲストユーザーは **ログアウトすると、アカウントや投稿・コメントが自動的に削除されます。** また、表示されている職員や利用者名はすべて **デモ用のダミーデータ** であり、実在の人物や団体とは関係ありません。安心して操作してください。

---

## サービスを開発した背景

### **職員間の連携を強化する、タイムリーな情報共有**

介護現場では、情報共有の遅れや漏れが利用者のケアに直接影響します。この課題を解決するため、 **「誰でも直感的に使える 介護施設向けの情報共有ツール」** として CommuniCare を開発しました。

-   **課題:** 口頭での申し送りや手書きノートによる情報共有が主流で、必要な情報を得るには現場まで足を運ぶ必要がある。
-   **解決策:** どこにいても必要な情報を確認できるように、全体連絡と部署内連絡の両方に対応したツールを開発。
-   **こだわり:** 過去の重要なルールや情報を引用投稿機能で再共有することで、形骸化したルールの再確認も促進。

---

## 主な機能

### 掲示板機能

| 掲示板機能                                          |
| --------------------------------------------------- |
| ![掲示板機能](public/images/feature_forum_page.png) |

-   **投稿機能:** 職員が情報を共有するために投稿を作成可能。
-   **返信機能:** 各投稿に対して返信ができ、双方向のコミュニケーションを実現。
-   **引用投稿機能:** 過去の投稿を引用して新しい投稿を作成でき、情報の再共有が可能。
-   **削除機能:** 自身が作成した投稿や返信のみ削除可能。
-   **画像添付:** 投稿、引用投稿、返信に画像を添付可能。
-   **いいね機能:** 投稿に対してリアクションが可能で、投稿や返信に対する既読のサインとして活用可能。

| 左サイドバー                                                                                                                                   | 右サイドバー                                                                                 |
| ---------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| ![左サイドバー](public/images/feature_sidebar_left.png)                                                                                        | ![右サイドバー](public/images/feature_sidebar_right.png)                                     |
| 掲示板ごとの部署一覧が表示され、現在選択中の部署がグレーで強調される。掲示板にアクセスすると、自身の所属する部署の掲示板が自動的に表示される。 | 掲示板に関連する職員の一覧が表示され、職員名やアイコンをクリックすると詳細情報を確認できる。 |

---

### 職員ページ機能

| 職員ページ                                          | 職員詳細モーダル                                                  |
| --------------------------------------------------- | ----------------------------------------------------------------- |
| ![職員ページ](public/images/feature_users_page.png) | ![職員詳細モーダル](public/images/feature_users_datail_modal.png) |

職員の一覧を表示し、部署ごとに絞り込んで閲覧が可能。 **職員名をクリックすると、その職員の詳細情報をモーダルウィンドウで確認可能。** 管理者は職員の登録・削除が可能。

---

### 利用者ページ機能

| 利用者ページ                                              | 利用者詳細ページ                                                |
| --------------------------------------------------------- | --------------------------------------------------------------- |
| ![利用者ページ](public/images/feature_residents_page.png) | ![利用者詳細ページ](public/images/feature_residents_detail.png) |

利用者の一覧を表示し、部署ごとに絞り込んで閲覧が可能。 **利用者名をクリックすると、詳細情報ページへ移動。** サービス内容、支援状況、備考などの利用者情報の確認や編集が可能。また、管理者は利用者の登録・削除が可能。

---

### 管理ページ

| 管理ページ                                                                               | 部署管理                                                     |
| ---------------------------------------------------------------------------------------- | ------------------------------------------------------------ |
| ![管理ページ](public/images/feature_management_page.png)                                 | ![部署管理](public/images/feature_department_management.png) |
| ログイン中のユーザー情報とログイン状態を表示。管理者は部署管理（新規登録・削除）が可能。 | 部署の新規登録や削除を行うことができる管理画面。             |

---

## マルチテナンシーの採用

CommuniCare は、**介護事業所ごとの独立した情報管理を可能にするマルチテナンシー構成**を採用しています。これにより、事業所ごとの機密情報を守りつつ、安全かつ効率的にサービスを提供できます。

### **1. マルチテナンシーの方式**

-   **データベースの分離方法:** シングルデータベース＋テナント識別

-   **テナントの識別方法:** `tenant_id` カラムを用いた識別に加え、サブドメインをレンタルサーバー側に登録。

    -   ホスト側でドメインとテナントを管理することで、各事業所に専用のサブドメインを発行。
    -   発行された URL にアクセスすることで、以降は専用の管理画面からサービスを利用可能。

※当初、マルチデータベース方式を採用していましたが、レンタルサーバーの制約によりデータベースの動的作成ができないため、シングルデータベース方式に変更しました。（Docker 環境では動的なデータベース作成が可能なため、ローカル開発環境ではマルチデータベース構成のテストも実施可能です）

この仕様変更により、現在サブドメインを利用した管理環境の作成機能は**一時的に停止しています**。本来想定していた「ユーザーが自身でサブドメインを用いた独立した管理環境を作成する」という実装は、レンタルサーバーの制約により一部制限されていますが、今後の開発で改善を検討しています。

![サブドメイン登録機能が無効であることを示すスクリーンショット](public/images/subdomain_registration_disabled.png)

なお、**運営側で専用のテナントやサブドメインを登録することは可能**です。登録を希望される方は、**X（旧 Twitter）の DM** にてお問い合わせください。

-   X アカウント **[@shoprogramming](https://twitter.com/shoprogramming)**

### **2. マルチテナンシーを採用した目的**

-   **機密情報の保護:** 介護事業所ごとに独立したデータ管理を実現し、事業所間の情報漏洩を防止。
-   **専用の管理ページ:** 介護事業所ごとに専用の URL（ドメイン）を発行し、独自の管理ページを作成可能。

### **参考ドキュメント**

-   [Tenancy for Laravel 公式ドキュメント](https://tenancyforlaravel.com/)

### **参考記事（非公式）**

-   [Tenancy for Laravel 入門](https://zenn.dev/yudai64/articles/12aab89b6bc70e)  
    _yudai64 氏による、Tenancy for Laravel の基本概念と実装手順の解説_

### **参考動画（非公式）**

-   [01 What’s Inside the Course（YouTube）](https://www.youtube.com/watch?v=hDaVMqj5D5A&list=PLoT0Ngy3KoLLomJDbNhIrQRT3n0UHVxqQ)  
    _Yin Yin Kyaw 氏によるマルチテナンシーの概要解説（非公式）_

---

### **主な使用技術**

| カテゴリ       | 技術                                   | バージョン |
| -------------- | -------------------------------------- | ---------- |
| フロントエンド | Vue.js, Inertia.js, Tailwind CSS, Vite | 3.x        |
| バックエンド   | Laravel (PHP)                          | 11.x       |
| 認証           | Laravel Breeze                         | -          |
| データベース   | MySQL                                  | 8.0.32     |
| インフラ       | Docker 27.5.1, Xserver (本番環境)      | -          |
| マルチテナント | Tenancy for Laravel (stancl/tenancy)   | 最新       |

---

### **開発環境のセットアップ**

このプロジェクトをローカル環境で動作させるために、以下のツールが必要です。

-   **PHP 8.3.16**
-   **Node.js 20.18.2** (Vite のビルドに使用)
-   **Composer 2.8.5** (Laravel のパッケージ管理)
-   **Docker 27.5.1** (開発環境を構築するために Laravel Sail を利用)

---

## ディレクトリ構成

```
├── app/                 # アプリケーション本体
│   ├── Console/         # Artisanコマンド（バッチ処理）
│   ├── Http/            # コントローラー・ミドルウェア・リクエスト
│   ├── Models/          # データベースモデル
│   ├── Providers/       # サービスプロバイダ（マルチテナンシー管理含む）
├── bootstrap/           # フレームワークの起動設定
├── config/              # アプリケーションの環境設定
├── database/            # データベース関連（マイグレーション・シーダー）
├── public/              # 公開ディレクトリ（エントリーポイント）
├── resources/           # フロントエンド（Vue.js, Blade）
├── routes/              # ルーティング定義
├── storage/             # ストレージ・ログ・キャッシュ
├── tests/               # 自動テスト（Unit & Feature）
├── docker-compose.yml   # 開発環境用Docker設定
├── composer.json        # PHPパッケージ管理
├── package.json         # フロントエンド依存関係
├── vite.config.js       # フロントエンドビルド設定
```

---

## ER 図

| ER 図                                      |
| ------------------------------------------ |
| ![ER図](public/images/communicare_ERD.png) |

## インフラ構成図

![インフラ構成図](docs/infrastructure-diagram.svg)

---

## 今後の展望

-   **モバイルアプリ対応:** スマートフォン向けの最適化
-   **AI によるタスク自動提案:** 業務効率化をさらに向上
-   **多言語対応:** グローバルな介護現場への展開
-   **分析機能:** ケアの質を定量的に評価するダッシュボード追加

---

## 最後に

CommuniCare は、介護現場で働くすべての人が **「もっと簡単に、もっと安全に」** 仕事ができる環境を目指しています。今後も現場の声を大切に、進化を続けていきます。
