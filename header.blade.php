  function autoComplete(element, url, ph, dataPost, id, text, parent){
	$(element).select2({
		placeholder: ph,
		minimumInputLength: 3,
		closeOnSelect: true,
		allowClear: true,
		quietMillis: 250,
	  ajax: {
		  url: url,
		  dataType: 'json',
		  delay: 250,
		  type:'post',
		  data: function (params) {
			return {
				keyword: params.term, //search term
				per_page: 5, // page size
				page: params.page, // page number
				parent : parent,
				_token : '{!!csrf_token()!!}'
			};
		  },
		  processResults: function (data, params) {
			// parse the results into the format expected by Select2
			// since we are using custom formatting functions we do not need to
			// alter the remote JSON data, except to indicate that infinite
			// scrolling can be used
			params.page = params.page || 1;
			return {
					results: data.rows,
					pagination: {
					more: (params.page * 5) < data.result
				}
			};
		  },
		  cache: true
		},
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		// formatResult: FormatResult,
		// formatSelection: FormatSelection
	});

	if(id != '' && id != null){
		$(element).data('select2').trigger('select', {
			data: {"id":id,"text":text}
		});
	}
  }

