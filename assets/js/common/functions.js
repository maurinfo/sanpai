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
							this.append_data.bind(this)
						),
					500
				);
			} else {
				this.showNoRecordFound(this.tbody, this.colspan);
			}
		},

		append_data: function(data) {
			let tbody = this.tbody;
			let datakey = this.datakey;

			tbody.empty();

			if (data.length > 0) {
				data.forEach(d => {
					let tdata;
					datakey.forEach(k => {
						tdata += `<td data-key='${k}'>${d[k] ? d[k] : ""}</td>`;
					});
					tbody.append(`<tr>${tdata}</tr>`);
				});
			} else {
				this.showNoRecordFound(this.tbody, this.colspan);
			}
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
