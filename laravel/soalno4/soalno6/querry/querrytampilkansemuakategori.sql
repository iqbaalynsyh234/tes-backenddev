SELECT 
    mc.CategoryID,
    mc.CategoryName,
    mi.ItemID,
    mi.ItemName,
    COALESCE(SUM(sid.Qty), 0) AS Qty,
    COALESCE(SUM(sid.SubTotal), 0) AS SubTotal
FROM 
    mastercategory mc
JOIN 
    masteritem mi ON mc.CategoryID = mi.CategoryID
LEFT JOIN 
    saleitemdetail sid ON mi.ItemID = sid.ItemID
    AND sid.PerusahaanNo = 639
    AND sid.DeviceID = 1356
    AND sid.SaleDate = '2017-05-11'
GROUP BY 
    mc.CategoryID,
    mc.CategoryName,
    mi.ItemID,
    mi.ItemName;