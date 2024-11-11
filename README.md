# 資料庫測驗

## 題目一

```sql
SELECT 
    b.id,
    b.name,
    SUM(o.amount) AS may_amount
FROM 
    orders o
JOIN 
    bnbs b ON o.bnb_id = b.id
WHERE 
    o.created_at BETWEEN '2023-05-01' AND '2023-05-31'
    AND o.currency = 'TWD'
GROUP BY 
    b.id, b.name
ORDER BY 
    may_amount DESC
LIMIT 10;
```

## 題目二
1. 若是因資料量過大導致 Order by 效能過慢
    - 可以將資料依日期分群
    - 時間長久，可將很久以前的資料封存
2. 若是因連線數量過大導致設備無法負荷而變慢
    - 因為過往資料變動頻度小，可使用 cache 減少 query 量
    - 若有預算可以增加設備規格
3. 可以使用 search engine 替代，甚至使用 databricks 類型服務

# API 實作測驗

## Design Pattern
### 工廠模式
  - 透過工廠模式創建 `validator`，並依賴於 `BaseOrdersValidator`
  - 在各欄位的 `validator` 實作其檢查規則
### Adpater pattern
  - 透過 `Adpater` 對應到需要的 `validator` 或 `converter`
  - 將對應的邏輯在 `Adpater` ，以便於擴展及替換


## 1. 單一職責原則 (SRP)
  - 每個欄位的 `validator` 專注於欄位驗證邏輯
  - 幣別轉換的 `converter` 專注於幣別轉換邏輯
  - `OrdersService` 專注於流程控制

## 2. 開放封閉原則 (OCP)
  - 如果要修改邏輯，不需要調整高階 `OrdersService` (修改封閉)
  - 僅需調整依賴於 `BaseOrdersValidator` 和 `ConverterInterface` 的物件邏輯
## 3. 里氏替換原則 (LSP)
  - 如要做幣別或驗證欄位替換可在 `Adapter` 做替換

## 4 介面隔離原則 (ISP)
  - 這裡沒有用到

## 5. 依賴反轉原則 (DIP)
  - 高階 `OrdersService` 並非直接操作邏輯，而是讓其依賴 `interface`

## Tips
  - 啟動 docker (port : 8000)
  ```
  docker compose build
  docker compose up
  ```

  - 測試覆蓋率
  ```
  vendor/bin/phpunit --coverage-text
  ```