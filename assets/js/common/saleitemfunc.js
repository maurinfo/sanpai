"use strict";

const SaleItemFunc = {
	saleitems: {},
	itemUnits : {},

	addNewItem: function() {
		this.resetIsEdit();
		this.saleitems.push(this.createNewEmptyItem());
		this.updateSalesRowUI();
	},

	createNewEmptyItem: function() {
		return {
			id: null,
			manifestid: "",
			referenceno: "",
			contractorbranch_name: "",
			datedelivered: moment().format("YYYY/MM/D"),
			item_name: "",
			itemid: "",
			itemunitid: "",
			itemunit_name: "",
			spec: "",
			qty: 0,
			price: 0,
			amount: 0,
			isEdit: true
		};
	},

	updateSalesRowUI: function() {
		$("#itemlist tbody").empty();

		this.saleitems.forEach((item, key) => {
			if (item.referenceno == null) {
				item.referenceno = "";
			}
			if (item.contractorbranch_name == null) {
				item.contractorbranch_name = "";
			}
			item.qty = Number(item.qty);
			item.price = Math.floor(item.price);
			item.amount = Math.floor(item.amount);
			const row = this.createRow(item, key);
			$("#itemlist tbody").append(row);
		});

		this.reInitializeDatePickers();
		this.reInitializeToolTips();

		this.updateTotal();
	},

	createRow: function(item, key) {
		return `
         <tr id="item-${key}">
            <td>${key + 1}</td>
            <td>${item.isEdit ? this.createDatePicker(item.datedelivered, key) : item.datedelivered }</td>
            <td>${item.isEdit ? this.createIcon('selectDate', key, 'Date', 'calendar', 'success') : ''}</td>
            <td>${item.referenceno}</td>
            <td>${item.isEdit ? this.createIcon('openManifestSearchModal', key, 'Referenceno', 'plus', 'success') : ''}</td>
            <td>${item.contractorbranch_name}</td>
            <td>${item.item_name}</td>
            <td>${item.isEdit ? this.createIcon('openWatesItemSearchModal', key, 'Waste', 'plus', 'success') : ''}</td>
            <td
               onBlur="SaleItemFunc.updateItemValue(this, ${key}, 'spec')"
               onKeyPress="SaleItemFunc.handleOnKeyPress(this, event, 50)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.spec}
            </td>
            <td
               class="text-align-right"
               onBlur="SaleItemFunc.updateItemValue(this, ${key}, 'qty')"
               onKeyPress="SaleItemFunc.handleOnKeyPress(this, event, 7, true)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.qty}
            </td>
			<td>
				${item.isEdit ? this.createUnitSelectItem(item.itemunitid, key) : item.itemunit_name }
			</td>
            <td
               class="text-align-right"
               onBlur="SaleItemFunc.updateItemValue(this, ${key}, 'price')"
               onKeyPress="SaleItemFunc.handleOnKeyPress(this, event, 10, true)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.price}
            </td>
            <td
               class="text-align-right"
               onBlur="SaleItemFunc.updateItemValue(this, ${key}, 'amount')">
               ${item.amount}
            </td>
            <td class="actions">
               ${this.createIcon('handlesEditItem', key, 'Edit', 'edit',)}
               ${this.createIcon('handlesDeleteItem', key, 'Close','close')}
            </td>
         </tr>`;
	},

	createDatePicker: function(value, key) {
		return `
         <input
            data-plugin="datepicker"
            onChange="SaleItemFunc.updateItemValue(this, ${key}, 'datedelivered')"
            type="text"
            value=${value}
            readonly
         />`;
	},

	createUnitSelectItem : function(selectedId, key) {
		const options = this.itemUnits.
			map(v => `<option value="${v.id}" ${v.id === selectedId ? 'selected' : ''}>${v.name}</option>`);
		return `
			<select
				onChange="SaleItemFunc.updateItemValue(this, ${key}, 'itemunitid')"
			>
				${options.join('')}
			</select>`;
	},

	createIcon: function(
		eventHandler,
		key,
		toolTipCaption,
		icon,
		btnType = "default"
	) {
		const tbnPure = btnType == "default" ? "btn-pure" : "";
		return `
            <button type="button" onClick="SaleItemFunc.${eventHandler}(this, ${key})"
               class="btn btn-xs btn-icon ${tbnPure} btn-${btnType}"
               data-toggle="tooltip" title="${toolTipCaption}">
               <i class="icon md-${icon}"></i>
            </button>`;
	},

	reInitializeDatePickers: function() {
		$('[data-plugin="datepicker"]')
			.datepicker()
			.on("changeDate", () => {
				$(".datepicker").hide();
			});
	},

	reInitializeToolTips: function() {
		$(".tooltip").tooltip("dispose");
		$('[data-toggle="tooltip"]').tooltip();
	},

	handlesEditItem: function(sender, key) {
		this.resetIsEdit();
		this.saleitems[key].isEdit = true;
		this.updateSalesRowUI();
	},

	resetIsEdit: function() {
		this.saleitems.forEach(x => (x.isEdit = false));
	},

	handlesDeleteItem: function(sender, itemId) {
		this.saleitems = this.saleitems.filter((item, key) => key !== itemId);
		this.updateSalesRowUI();
	},

	updateItemValue: function(sender, key, prop) {
		this.saleitems[key][prop] =
			sender.tagName === "INPUT" || sender.tagName === "SELECT" ? 
			$(sender).val() : $(sender).text();

		if (prop === "qty" || prop === "price") {
			this.saleitems[key].amount =
				this.saleitems[key].qty * this.saleitems[key].price;
			this.updateSalesRowUI();
		} else if(prop === "itemunitid") {
			this.saleitems[key].itemunit_name = 
				this.itemUnits.find(v => v.id === $(sender).val()).name;
		}
	},

	selectDate: function(sender, key) {
		$(sender)
			.parent()
			.parent()
			.find("input")
			.focus();
	},

	handleOnKeyPress: function(sender, event, maxLength, isNumericType = false) {
		const numbersOnly = isNumericType && (event.keyCode < 48 || event.keyCode > 57);
		const lengthExceed = $(sender).text().trim().length > maxLength;
		if (numbersOnly || lengthExceed) {
			event.preventDefault();
		}
	},

	openManifestSearchModal: function(sender, key) {
		this.salesItemToUpdate = key;
		$("#manifest_search_modal").modal();
	},

	updateItemSelectedByManifest: function(manifestItem) {
		const key = this.salesItemToUpdate;
		const saleItem = this.saleitems[key];
		saleItem.manifestid = manifestItem.manifestid;
		saleItem.referenceno = manifestItem.referenceno;
		saleItem.contractorbranch_name = manifestItem.contractor_name;
		saleItem.datedelivered = manifestItem.datereceived;
		saleItem.item_name = manifestItem.wasteclass_name ? manifestItem.wasteclass_name	: "";
		saleItem.itemid = manifestItem.wasteclass_id;
		saleItem.itemunitid = manifestItem.itemunitid;
		this.updateSalesRowUI();
	},

	openWatesItemSearchModal: function(sender, key) {
		this.salesItemToUpdate = key;
		$("#waste_search_modal").modal();
	},

	updateItemSelectedByWaste: function(wasteItem) {
		const key = this.salesItemToUpdate;
		const saleItem = this.saleitems[key];
		saleItem.item_name = wasteItem.name;
		saleItem.itemid = wasteItem.id;
		saleItem.itemunitid = wasteItem.itemunitid;
		saleItem.itemunit_name = wasteItem.unit;
		this.updateSalesRowUI();
	},

	updateTotal: function() {
		const { subtotal, tax, total } = this.getTotals();

		$("[name=subtotal]").val(subtotal);
		$("[name=tax]").val(tax);
		$("[name=total]").val(total);
	},

	getTotals: function() {
		let subtotal = this.saleitems.reduce((sum, i) => +sum + +i.amount, 0);
		let tax = Math.floor(subtotal * (taxrate / 100));

		return {
			subtotal: subtotal,
			tax: tax,
			total: subtotal + tax
		};
	}
};
