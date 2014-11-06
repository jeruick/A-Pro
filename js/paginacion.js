	$(document).ready(function($) {
		var items = $("#contenido .articles div");

    	var numItems = items.length;
    	var itemsxPage = 10;

    // only show the first 2 (or "first per_page") items initially
    	items.slice(itemsxPage).hide();

    	jQuery("#selector").pagination({
        items: numItems,
        itemsOnPage: itemsxPage,
        cssStyle: 'light-theme',
        onPageClick: function(pageNumber) { // this is where the magic happens
            // someone changed page, lets hide/show trs appropriately
            var showFrom = itemsxPage * (pageNumber - 1);
            var showTo = showFrom + itemsxPage;

            items.hide().slice(showFrom, showTo).show();
                 // first hide everything, then show for the new page
        }	
    }); 
 
	});

