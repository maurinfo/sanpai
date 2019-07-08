"use strict";

const ExpenseItemFunc = {
	expenseitems: {},
	itemUnits: {},

	addNewItem: function () {
		this.resetIsEdit();
		this.expenseitems.push(this.createNewEmptyItem());
		this.updateExpensesRowUI();
	},

	createNewEmptyItem: function () {
		return {
			id: null,
			item_name: "",
			itemid: 0,
			itemunitid: 0,
			itemunit_name: "",
			qty: 0,
			price: 0,
			amount: 0,
			isEdit: true
		};
	},

	updateExpensesRowUI: function () {
		$("#itemlist tbody").empty();

		this.expenseitems.forEach((item, key) => {
			item.item_name = item.item_name;
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

	createRow: function (item, key) {
		return `
         <tr id="item-${key}">
            <td>${key + 1}</td>

			<td ${item.isEdit ? 'contenteditable=true' : ''}
				onBlur="ExpenseItemFunc.updateItemValue(this, ${key}, 'item_name')"
				onKeyPress="ExpenseItemFunc.handleOnKeyPress(this, event, 100)">
				${item.item_name}
			</td>
            <td>${item.isEdit ? this.createIcon('openWatesItemSearchModal', key, 'Item', 'plus', 'success') : ''}</td>
            <td
               class="text-align-right"
               onBlur="ExpenseItemFunc.updateItemValue(this, ${key}, 'qty')"
               onKeyPress="ExpenseItemFunc.handleOnKeyPress(this, event, 7, true)" ${item.isEdit ? 'contenteditable=true' : ''}>
               ${item.qty}
            </td>
			<td>
				${item.isEdit ? this.createUnitSelectItem(item.itemunit_name, key) : item.itemunit_name}
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
               ${this.createIcon('handlesEditItem', key, 'Edit', 'edit')}
               ${this.createIcon('handlesDeleteItem', key, 'Close', 'close')}
            </td>
         </tr>`;
	},

	createUnitSelectItem: function (unitName, key) {
		const options = this.itemUnits.
			map(v => `<option value="${v.name}">`);
		return `
			<input list='unitlist' 
				value="${unitName}"
				onChange="ExpenseItemFunc.updateItemValue(this, ${key}, 'itemunit_name')" 
			/>
			<datalist id='unitlist'>
				${options.join('')}
			</datalist>`;
	},

	createIcon: function (
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

	reInitializeDatePickers: function () {
		$('[data-plugin="datepicker"]')
			.datepicker()
			.on("changeDate", () => {
				$(".datepicker").hide();
			});
	},

	reInitializeToolTips: function () {
		$(".tooltip").tooltip("dispose");
		$('[data-toggle="tooltip"]').tooltip();
	},

	handlesEditItem: function (sender, key) {
		this.resetIsEdit();
		this.expenseitems[key].isEdit = true;
		this.updateExpensesRowUI();
	},

	resetIsEdit: function () {
		this.expenseitems.forEach(x => (x.isEdit = false));
	},

	handlesDeleteItem: function (sender, itemId) {
		this.expenseitems = this.expenseitems.filter((item, key) => key !== itemId);
		this.updateExpensesRowUI();
	},

	updateItemValue: function (sender, key, prop) {
		this.expenseitems[key][prop] =
			sender.tagName === "INPUT" || sender.tagName === "SELECT" ?
				$(sender).val().trim() : $(sender).text().trim();
		if (prop === "qty" || prop === "price") {
			this.expenseitems[key].amount =
				this.expenseitems[key].qty * this.expenseitems[key].price;
			this.updateExpensesRowUI();
		} else if (prop === "itemunit_name") {
			const unitName = $(sender).val().trim();
			const itemUnit = this.itemUnits.find(v => v.name === unitName);
			if (itemUnit) {
				this.expenseitems[key].itemunitid = itemUnit.id;
			} else {
				this.expenseitems[key].itemunitid = 0;
			}
		}
	},

	handleOnKeyPress: function (sender, event, maxLength, isNumericType = false) {
		const numbersOnly = isNumericType && (event.keyCode < 48 || event.keyCode > 57);
		const lengthExceed = $(sender).text().trim().length > maxLength;
		if (numbersOnly || lengthExceed) {
			event.preventDefault();
		}
	},

	openWatesItemSearchModal: function (sender, key) {
		this.expensesItemToUpdate = key;
		$("#item_search_modal").modal();
	},

	updateItemSelectedByItem: function (itemItem) {
		const key = this.expensesItemToUpdate;
		const expenseItem = this.expenseitems[key];
		expenseItem.item_name = itemItem.name;
		expenseItem.itemid = itemItem.id;
		expenseItem.itemunitid = itemItem.itemunitid;
		expenseItem.itemunit_name = itemItem.unit;
		this.updateExpensesRowUI();
	},

	updateTotal: function () {
		const { subtotal, tax, total } = this.getTotals();

		$("[name=subtotal]").val(subtotal);
		$("[name=tax]").val(tax);
		$("[name=total]").val(total);
	},

	getTotals: function () {
		let subtotal = this.expenseitems.reduce((sum, i) => +sum + +i.amount, 0);
		let tax = Math.floor(subtotal * (taxrate / 100));

		return {
			subtotal: subtotal,
			tax: tax,
			total: subtotal + tax
		};
	}
};
