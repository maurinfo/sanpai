create view expensedetaillist as select expensedetail.*,item.name as item_name, itemunit.name as itemunit_name from expensedetail left join item on expensedetail.itemid=item.id left join itemunit on expensedetail.itemunitid=itemunit.id

order by expensedetail.id
