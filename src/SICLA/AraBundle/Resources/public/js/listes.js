jQuery(document).ready(function() {
	$("div.liste").children().each(function(){
		var collectionHolder2=$(this);
		var btadd=$('<button class="btn btn-success" type="submit">Modifier</button>')
		var $addTagLink = $('<a href="#" class="btn">+</a>');
		var $newLink = $('<div class="btn-group"></div>').append($addTagLink);
		$newLink.append(btadd);
		
		collectionHolder2.append($newLink);
		collectionHolder2.find('div.input-append').each(function() {
						addTagFormDeleteLink($(this));
		});

		$addTagLink.on('click', function(e) {
			e.preventDefault();
			addForm(collectionHolder2, $newLink);
		});
	});
});

function addForm(collectionHolder, $newLink) {
	
    var prototype = collectionHolder.attr('data-prototype');
    var newForm = prototype.replace(/__name__/g, collectionHolder.children().length);
    var $newFormLi = $('<div class="input-append"></div>').append(newForm);
	
    $newLink.before($newFormLi);
	addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagForm) {
    var $removeFormA = $('<a href="#" class="btn btn-danger">X</a>');
    $tagForm.append($removeFormA);
    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $tagForm.remove();
    });
}

