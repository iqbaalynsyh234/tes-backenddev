SELECT 
    mc.CategoryID,
    mc.CategoryName,
    mi.ItemID,
    mi.ItemName
FROM 
    mastercategory mc
INNER JOIN 
    masteritem mi ON mc.PerusahaanNo = mi.PerusahaanNo
                   AND mc.DeviceID = mi.DeviceID
                   AND mc.CategoryDeviceNo = mi.CategoryDeviceNo;