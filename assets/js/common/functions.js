let utility = (function() {
	let delayTimeOut;

	return {
		post: function(url, params, callbackfunc) {
			$.ajax({
				url: url,
				method: "POST",
				dataType: "json",
				data: params,
				success: function(data) {
					console.log(data);
					callbackfunc(data);
				},
				error: function(err) {
					console.log(err);
				}
			});
		},

		delayCall: function(callbackfunc, delays) {
			clearTimeout(delayTimeOut);
			delayTimeOut = setTimeout(callbackfunc, delays);
		},

		checkSearchString: function(searchString) {
			return (
				searchString !== null &&
				searchString !== undefined &&
				searchString.length > 0
			);
		}
	};
})();

let search = (function() {
	let url = '';
	let tbody = '';
	let colspan = 0;
	let datakey = [];
	let datakeyclass = {};
	
	return {
		setTable: function(tableBody) {
			this.tbody = tableBody;
		},

		setUrl: function(url) {
			this.url = url;
		},

		setDataKey: function(keys) {
			this.datakey = keys;
		},

		setDataKeyClass: function(keys) {
			this.datakeyclass = keys;
		},

		setColSpan: function(number) {
			this.colspan = number;
		},

		handleOnInput: function(searchString) {
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

		appendData: function(data) {
			const tbody = this.tbody;
			const datakey = this.datakey;
			
			tbody.empty();

			if (data !== null && data.length > 0) {
				data.forEach(d => {
					let tdata;
					datakey.forEach(k => {
						tdata += `<td ${this.addClass(k)}data-key='${k}'>${d[k] ? d[k] : ""}</td>`;
					});
					tbody.append(`<tr>${tdata}</tr>`);
				});
			} else {
				this.showNoRecordFound(this.tbody, this.colspan);
			}
		},

		addClass: function(key) {
			if(this.datakeyclass && this.datakeyclass[key])
				return `class='${this.datakeyclass[key]}'`;

			return '';
		},

		showNoRecordFound: function(table, colspan) {
			table
				.empty()
				.append(
					`<tr class="table-info"><td colspan="${colspan}">No Record Found</td></tr>`
				);
		}
	};
})();
