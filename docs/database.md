# テーブル設計書

## 項目説明

- PK: ○ → プライマリーキーである。x → プライマリーキーではない。  
- NULL: ○ → NULL を許容する。 x → NULL を許容しない。  
- DEFAULT: デフォルト値を表す。  
- UNIQUE: ○ → 一意の値である。x → 一意の値ではない。  
- FK: ○ → 外部キーである。x → 外部キーではない。  
- AUTO_INCREMENT: ○ → オートインクリメントである。x → オートインクリメントではない。 

## テーブル
### フォルダ（folders）

| 論理名        | 物理名     | データ型   | サイズ | PK  | NULL | DEFAULT | UNIQUE | FK  | AUTO_INCREMENT |
| ------------- | ---------- | ---------- | ------ | --- | ---- | ------- | ------ | --- | -------------- |
| フォルダID    | id         | BIGINTEGER | -      | ○   | ×    | -       | ○      | ×   | ○              |
| 親フォルダID  | parent_id  | BIGINTEGER | -      | ×   | ○    | NULL    | ×      | ○   |                |
| フォルダ名    | name       | VARCHAR    | 255    | ×   | ×    | -       | ×      | ×   |                |
| 作成日時      | created_at | TIMESTAMP  | -      | ×   | ×    | NOW()   | ×      | ×   |                |
| 更新日時      | updated_at | TIMESTAMP  | -      | ×   | ×    | NOW()   | ×      | ×   |                |

### 書類（documents）

| 論理名      | 物理名     | データ型   | サイズ | PK  | NULL | DEFAULT | UNIQUE | FK  | AUTO_INCREMENT |
| ----------- | ---------- | ---------- | ------ | --- | ---- | ------- | ------ | --- | -------------- |
| 書類ID      | id         | BIGINTEGER | -      | ○   | ×    | -       | ○      | ×   | ○              |
| フォルダID  | folder_id  | BIGINTEGER | -      | ×   | ○    | NULL    | ×      | ○   |                |
| タイトル    | title      | VARCHAR    | 255    | ×   | ×    | -       | ×      | ×   |                |
| 文書内容    | content    | TEXT       | -      | ×   | ○    | NULL    | ×      | ×   |                |
| 作成日時    | created_at | TIMESTAMP  | -      | ×   | ×    | NOW()   | ×      | ×   |                |
| 更新日時    | updated_at | TIMESTAMP  | -      | ×   | ×    | NOW()   | ×      | ×   |                |
