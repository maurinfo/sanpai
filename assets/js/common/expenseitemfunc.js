"use strict";

const ExpenseItemFunc = {
	expenseitems: {},
	itemUnits : {},

	addNewItem: function() {
		this.resetIsEdit();
		this.expenseitems.push(this.createNewEmptyItem());
		this.updateExpensesRowUI();
	},

	createNewEmptyItem: function() {
		return {
			id: null,
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

	updateExpensesRowUI: function() {
		$("#itemlist tbody").empty();

		this.expenseitems.forEach((item, key) => {
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
            <td>${item.item_name}</td>
            <td>${item.isEdit ? this.createIcon('openWatesItemSearchModal', key, 'Waste', 'plus', 'success') : ''}</td>
            <td
               onBlur="ExpenseItemFunc.updateItemValue(this, ${key}, 'spec')"
               onKeyPress="ExpenseItemFunc.handleOnKeyPress(this, event, 50)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.spec}
            </td>
            <td
               class="text-align-right"
               onBlur="ExpenseItemFunc.updateItemValue(this, ${key}, 'qty')"
               onKeyPress="ExpenseItemFunc.handleOnKeyPress(this, event, 7, true)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.qty}
            </td>
			<td>
				${item.isEdit ? this.createUnitSelectItem(item.itemunitid, key) : item.itemunit_name }
			</td>
            <td
               class="text-align-right"
               onBlur="ExpenseItemFunc.updateItemValue(this, ${key}, 'price')"
               onKeyPress="ExpenseItemFunc.handleOnKeyPress(this, event, 10, true)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.price}
            </td>
            <td
               class="text-align-right"
               onBlur="ExpenseItemFunc.updateItemValue(this, ${key}, 'amount')">
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
            onChange="ExpenseItemFunc.updateItemValue(this, ${key}, 'datedelivered')"
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
				onChange="ExpenseItemFunc.updateItemValue(this, ${key}, 'itemunitid')"
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
            <button type="button" onClick="ExpenseItemFunc.${eventHandler}(this, ${key})"
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
		this.expenseitems[key].isEdit = true;
		this.updateExpensesRowUI();
	},

	resetIsEdit: function() {
		this.expenseitems.forEach(x => (x.isEdit = false));
	},

	handlesDeleteItem: function(sender, itemId) {
		this.expenseitems = this.expenseitems.filter((item, key) => key !== itemId);
		this.updateExpensesRowUI();
	},

	updateItemValue: function(sender, key, prop) {
		this.expenseitems[key][prop] =
			sender.tagName === "INPUT" || sender.tagName === "SELECT" ?
			$(sender).val() : $(sender).text();

		if (prop === "qty" || prop === "price") {
			this.expenseitems[key].amount =
				this.expenseitems[key].qty * this.expenseitems[key].price;
			this.updateExpensesRowUI();
		} else if(prop === "itemunitid") {
			this.expenseitems[key].itemunit_name =
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
		this.expensesItemToUpdate = key;
		$("#manifest_search_modal").modal();
	},

	updateItemSelectedByManifest: function(manifestItem) {
		const key = this.expensesItemToUpdate;
		const expenseItem = this.expenseitems[key];

		expenseItem.item_name = manifestItem.wasteclass_name ? manifestItem.wasteclass_name	: "";
		expenseItem.itemid = manifestItem.wasteclass_id;
		expenseItem.itemunitid = manifestItem.itemunitid;
		this.updateExpensesRowUI();
	},

	openWatesItemSearchModal: function(sender, key) {
		this.expensesItemToUpdate = key;
		$("#waste_search_modal").modal();
	},

	updateItemSelectedByWaste: function(wasteItem) {
		const key = this.expensesItemToUpdate;
		const expenseItem = this.expenseitems[key];
		expenseItem.item_name = wasteItem.name;
		expenseItem.itemid = wasteItem.id;
		expenseItem.itemunitid = wasteItem.itemunitid;
		expenseItem.itemunit_name = wasteItem.unit;
		this.updateExpensesRowUI();
	},

	updateTotal: function() {
		const { subtotal, tax, total } = this.getTotals();

		$("[name=subtotal]").val(subtotal);
		$("[name=tax]").val(tax);
		$("[name=total]").val(total);
	},

	getTotals: function() {
		let subtotal = this.expenseitems.reduce((sum, i) => +sum + +i.amount, 0);
		let tax = Math.floor(subtotal * (taxrate / 100));

		return {
			subtotal: subtotal,
			tax: tax,
			total: subtotal + tax
		};
	}
};
