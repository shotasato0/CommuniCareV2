# CommuniCare

## どのようなサービスなのか？

**職員の効率的なコミュニケーションと情報管理を支援**

CommuniCare は、介護施設の運営を効率化するために、 職員間のスムーズなコミュニケーションと利用者様の情報を一元管理する プラットフォームです。

![サービスのメインビジュアル](public/images/hero-section.png)

## サービスの URL

[https://communi-care.jp](https://communi-care.jp/)

ゲストデモ機能を実装しましたので、登録せずにお試しいただくことも可能です。

---

## サービスを開発した背景

**職員間の連携を強化する、タイムリーな情報共有**

介護現場では情報共有の遅れやタスクの漏れが、利用者のケアに直接影響します。この課題を解決するため、 **「誰でも直感的に使える介護専用ツール」** として CommuniCare を開発しました。

-   **課題:** 口頭での申し送りや手書きノートによる情報共有が主流で、出勤しないと情報が得られない課題が存在。
-   **解決策:** 出勤していなくても情報確認が可能な、全体連絡と部署内連絡の両方に対応したツールを開発。
-   **こだわり:** 過去の重要なルールや情報を引用投稿機能で再共有することで、形骸化したルールの再確認も促進。

---

### 主な機能

-   **掲示板機能:** 全体連絡や部署間での申し送りなどのやり取りが可能。メイン機能として活躍。
-   **職員ページ機能:** 職員情報（名前、電話番号、メールアドレス）を表示し、部署ごとの一覧表示も可能。管理者は職員の登録・削除が可能。
-   **利用者ページ機能:** 利用者の基本情報、サービス内容、支援状況、備考などを表示・編集。管理者は利用者の登録・削除が可能。
-   **管理ページ:** ログイン中のユーザー情報とログイン状態を表示。管理者は部署管理（新規登録・削除）が可能。

_(スクリーンショットを適宜挿入)_

---

## ディレクトリ構成

```
├── app
│   ├── Console
│   │   └── Commands (バッチ処理やカスタムコマンド)
│   ├── Http
│   │   ├── Controllers (ビジネスロジックの管理)
│   │   ├── Middleware (リクエストの前後処理)
│   │   └── Requests (バリデーションロジック)
│   ├── Models (データベースモデル)
│   └── Providers (サービスプロバイダ)
├── database
│   ├── migrations (DB構造の管理)
│   └── seeders (初期データの投入)
├── resources
│   ├── js (フロントエンドのVueコンポーネント)
│   └── views (Bladeテンプレート)
├── routes (ルーティングの定義)
├── tests (ユニット・機能テスト)
└── docker-compose.yml (コンテナ環境の構成)
```

---

## 主な使用技術

| カテゴリ       | 技術                 | バージョン |
| -------------- | -------------------- | ---------- |
| フロントエンド | Vue.js, Tailwind CSS | 3.x        |
| バックエンド   | Node.js, Laravel     | 最新       |
| データベース   | MySQL                | 8.x        |
| インフラ       | Docker, NGINX, AWS   | 最新       |
| その他         | Redis                | -          |

---

## ER 図

![ER図](public/images/communicare_ERD.png)

## ☁️ インフラ構成図

_(ここにインフラ構成図を挿入)_

---

## 今後の展望

-   **モバイルアプリ対応:** スマートフォン向けの最適化
-   **AI によるタスク自動提案:** 業務効率化をさらに向上
-   **多言語対応:** グローバルな介護現場への展開
-   **分析機能:** ケアの質を定量的に評価するダッシュボード追加

---

## 最後に

CommuniCare は、介護現場で働くすべての人が **「もっと簡単に、もっと安全に」** 仕事ができる環境を目指しています。今後も現場の声を大切に、進化を続けていきます！
