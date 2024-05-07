SELECT 
    s.TransactionID,
    s.TransactionDate,
    sid.ItemID,
    sid.ItemName,
    sid.Quantity,
    sid.PricePerUnit
FROM 
    sale s
INNER JOIN 
    saleitemdetail sid ON s.PerusahaanNo = sid.PerusahaanNo
                        AND s.DeviceID = sid.DeviceID
                        AND s.TransactionDeviceNo = sid.TransactionDeviceNo
                        AND s.TransactionID = sid.TransactionID;