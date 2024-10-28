      $(function () {
	    $('.jstree1').jstree({
           'core': {
                   'check_callback': true, 
                },
	        'plugins' : [ 'themes', 'html_data', 'checkbox', 'sort', 'ui', 'types' ],
	        'types': {
                    'default': {
                        'icon': false
                    }
                }

	    });
	});