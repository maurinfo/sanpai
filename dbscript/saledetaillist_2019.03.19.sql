create view saledetaillist as select saledetail.*, manifest.datemanifest,manifest.referenceno, manifest.contractorbranchid, contractorbranch.name as contractorbranch_name,item.name as item_name, manifest.otheritemname, itemunit.name as itemunit_name from saledetail left join manifest on saledetail.manifestid=manifest.id left join item on saledetail.itemid=item.id left join itemunit on saledetail.itemunitid=itemunit.id left join contractorbranch on manifest.contractorbranchid=contractorbranch.id

order by saledetail.id
