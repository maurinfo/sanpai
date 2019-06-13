let utility = (function () {
	let delayTimeOut;

	return {
		post: function (url, params, callbackfunc) {
			$.ajax({
				url: url,
				method: "POST",
				data: params,
				success: function (data, status) {
					callbackfunc(data, status);
				},
				error: function (err) {
					console.log(err);
				}
			});
		},

		delayCall: function (callbackfunc, delays) {
			clearTimeout(delayTimeOut);
			delayTimeOut = setTimeout(callbackfunc, delays);
		},

		checkSearchString: function (searchString) {
			return (
				searchString !== null &&
				searchString !== undefined &&
				searchString.length > 0
			);
		},

		validateInputs: function (formid, inputs, rules) {
			const errs = validate(inputs, rules);
			this.resetErrorMessage(formid, inputs);

			if (errs) {
				this.showValidationErrors(formid, errs);
			}
			return errs == null;
		},

		resetErrorMessage: function (formid, inputs) {
			for (let key in inputs) {
				$(`#${formid} [name=${key}]`)
					.parents("div")
					.children("span.text-danger")
					.text("");
			}
		},

		showValidationErrors: function (formsid, errs) {
			for (let err in errs) {
				let message = "";
				errs[err].forEach(msg => {
					message += msg;
				});
				$(`#${formsid} [name=${err}]`)
					.parents("div")
					.children("span.text-danger")
					.text(message);
			}
		},

		getCurrentDate: function () {

		}
	};
})();

let search = (function () {
	let url = "";
	let tbody = "";
	let colspan = 0;
	let datakey = [];
	let datakeyclass = {};
	let data;

	return {

		setTable: function (tableBody) {
			this.tbody = tableBody;
		},

		setUrl: function (url) {
			this.url = url;
		},

		setDataKey: function (keys) {
			this.datakey = keys;
		},

		setDataKeyClass: function (keys) {
			this.datakeyclass = keys;
		},

		setColSpan: function (number) {
			this.colspan = number;
		},

		handleOnInput: function (searchString) {
			if (utility.checkSearchString(searchString)) {
				utility.delayCall(
					() =>
						utility.post(
							this.url,
							{ query: searchString },
							this.appendData.bind(this)
						),
					500
				);
			} else {
				this.showNoRecordFound(this.tbody, this.colspan);
			}
		},

		appendData: function (data) {
			const tbody = this.tbody;
			const datakey = this.datakey;
			this.data = data;

			tbody.empty();

			if (data !== null && data.length > 0) {
				data.forEach((d, idx) => {
					let tdata;
					datakey.forEach(k => {
						tdata += `<td ${this.addClass(k)}data-key='${k}'>${
							d[k] ? d[k] : ""
							}</td>`;
					});
					tbody.append(`<tr data-key=${idx}>${tdata}</tr>`);
				});
			} else {
				this.showNoRecordFound(this.tbody, this.colspan);
			}
		},

		addClass: function (key) {
			if (this.datakeyclass && this.datakeyclass[key])
				return `class='${this.datakeyclass[key]}'`;

			return "";
		},

		showNoRecordFound: function (table, colspan) {
			table
				.empty()
				.append(
					`<tr class="table-info"><td colspan="${colspan}">No Record Found</td></tr>`
				);
		}
	};
})();
