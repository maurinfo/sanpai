create view manifestlist as

select manifest.*,contractor.name as contractor, contractor.address1||contractor.address2 as contractoraddress,
contractorbranch.name as contractorbranch, contractorbranch.address1||contractorbranch.address2 as contbranchaddress,
permitclass.name as permitclass, wasteclass.name as wasteclass, item.name as itemname, itemunit.name as itemunit,
forwarder.name as forwarder, employee.name as receivedby, permit.permitno from manifest left join contractor on
manifest.contractorid=contractor.id left join contractorbranch on manifest.contractorbranchid=contractorbranch.id left
join permitclass on manifest.permitclassid=permitclass.id left join wasteclass on manifest.wasteclassid=wasteclass.id
left join item on manifest.itemid=item.id left join itemunit on manifest.itemunitid=itemunit.id left join forwarder on
manifest.1forwarderid= forwarder.id left join employee on manifest.receivedbyid=employee.id left join permit on
manifest.1forwarderid= permit.id
