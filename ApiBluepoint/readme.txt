#windows上でApiBluepointを使用する

■参考サイト
http://qiita.com/taipon_rock/items/9001ae194571feb63a5e
http://imamotty.hatenablog.jp/entry/2015/01/18/033222


##nodeをインストールする
以下のURLからインストールする
https://nodejs.org/en/download/

###cmdで以下を実行して確認する
node --version

バージョンが表示されればOK

###npmのインストールも確認する
npm --version

バージョンが表示されればOK

##npmでgulpをグローバルインストールします。

###cmdで以下を実行
npm install -g gulp

###インストール確認
gulp -v

バージョンが表示されればOK

##作業フォルダを作成する

cmdで以下を実行
mkdir ~/apiblueprint ←作業フォルダ名
cd ~/apiblueprint
npm init

##gulpとgulp-aglioをローカルインストール

gulpとgulp-aglioを作業ディレクトリにローカルインストールしてください。
npm install gulp gulp-aglio --save-dev

##API Blueprint記法でAPIの一覧を書く

##docsタスクを実行してHTMLのAPIドキュメントを作成

gulp docs

