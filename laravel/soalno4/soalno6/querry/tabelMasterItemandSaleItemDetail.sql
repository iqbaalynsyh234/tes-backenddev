SELECT 
    c.CategoryName,
    mi.ItemName,
    COALESCE(sid.Qty, 0) AS Qty,
    COALESCE(sid.Qty * sid.Price, 0) AS SubTotal
FROM Categories c
CROSS JOIN MasterItem mi
LEFT JOIN SaleItemDetail sid ON mi.ItemID = sid.ItemID
                               AND sid.PerusahaanNo = 639
                               AND sid.DeviceID = 1356
LEFT JOIN Sale s ON sid.PerusahaanNo = s.PerusahaanNo
                AND sid.DeviceID = s.DeviceID
                AND sid.TransactionID = s.TransactionID
                AND s.SaleDate = '2017-05-01'
WHERE mi.CategoryID = c.CategoryID
ORDER BY c.CategoryName, mi.ItemName;