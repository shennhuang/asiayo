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
1. 若是因資料量過大導致 Order by 效能過慢，可以將資料分群
2. 若是因連線數量過大導致設備無法負荷
    - 因為過往資料變動頻度小，可使用 cache 減少 query 量
    - 若有預算可以增加設備規格
3. 可以使用 search engine 替代，甚至使用 databricks 類型服務

# API 實作測驗

### 1. 單一職責原則 (SRP)
  - 每個欄位的 validator 專注於欄位驗證
  - 
  - 

### 2. 開放封閉原則 (OCP)
- **目標**：軟體應對擴展開放，對修改封閉。
- **實踐**：
  - 在 `OrderRequest` 的 `prepareForValidation` 方法中，將換匯邏輯獨立於 `currencyTrans` 方法。
  - 如未來有其他預處理需求，可直接添加至此方法中，而無需更改現有邏輯。

### 3. 里氏替換原則 (LSP)
- **目標**：任何子類別應可以替換其父類別。
- **實踐**：
  - 本專案邏輯的執行過程中未違反父類別的行為約定，且後續處理也不會推翻先前的驗證結果。

### 5. 依賴反轉原則 (DIP)
- **目標**：高階模組不應依賴於低階模組；兩者都應依賴於抽象。
- **實踐**：
  - Controller 並未直接依賴具體的服務操作，而是通過 `use` 方式使用 `OrderService`，便於單元測試及維護。