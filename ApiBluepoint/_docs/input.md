FDORMAT: 1A

# Group APIBlueprintSample

Githubは[こちら](https://github.com/darai0512/APIBlueprintSampleOnNodeV4)

## 商品系API [/v1/item/{clientId}/{id}{?acl,inserted_by}]
### 商品一覧取得 [GET]

#### 動作概要

- 見出し4以降は、Markdown形式でこのようにdescriptionを挟めます

+ Parameters
    + clientId: 5 (number, required) - ここに各パラメータのコメントを書けます
    + acl: hogeAPItoken_001 (string, required) - acl token
    + inserted_by: darai0512 (string, optional) - 任意パラメータ

+ Response 200 (application/json)
UTF-8
    + Attributes(Base)
        + results (array) - このコメントはBaseのコメントに上書きされる
            + (Resource)
            + (Resource)
                + id: 101
                + name: 土鍋 (string)
                + similarItems (object)
                    + 16: 北京鍋 (string)

### 商品削除 [DELETE]

- 削除成功時のresultsは空のため、成功/失敗はHTTPステータスコードで判断してください

+ Parameters
    + clientId: 5 (number, required) - 商品提供顧客ID
    + id: 100 (number, required) - 商品ID

+ Response 200 (application/json)
UTF-8
    + Attributes(Base)

+ Response 400 (application/json)
UTF-8
    + Attributes(Base)
        + status (Status)
            + code: 404 (number)
            + message: `Combination of clientId and id is invalid.` (string) - 文字列エスケープはバッククォートで囲む

## 顧客系 [/v1/client]
### クライアント登録 [POST]

+ Request (application/json)
UTF-8
    + Attribute
        + name: darai0512 (string, required) - クライアント名
        + type (enum[string], optional) -  列挙データ。下記ネストしたメタ情報はschemaに記載される(A: 通常、B: 特別契約顧客)
            + Default: A - default値はこう記述
            + A - このコメントはschemaに記載されないので注意
            + B
 
+ Response 200 (application/json)
UTF-8
    + Attributes(Base)
        + results (object)
            + id: 5 - 型省略時はstring
            + name: darai0512 (string) - クライアント名
            + type: A (enum[string]) -  顧客タイプ

## Data Structure
### Base

+ status (Status) - HTTP statusとは異なるアプリケーション専用のstatus
+ results (array) - array内の構造はschema(メタデータ)に表現されない

### Status

+ code: 200 (number, required) - application status code
+ message (string, nullable)
+ details (array) - Error時のみカラム別エラー詳細などが入る

### Resource

+ id: 100 (number)
+ name: 食洗機 (string)
+ similarItems (object) - 何も書かなければ空オブジェクト

# Group カラム説明
## 商品一覧取得[GET]

results(array)内の構造は以下の通り

key | type | format | description
--- | --- | --- | ---
5d | number | 1以上の整数 | 商品ID
name | string | マルチバイトを含む1文字以上 | 商品名
similarItems | object | key: id(商品ID)<br>value: name(商品名) | 類似商品（レコメンド用）