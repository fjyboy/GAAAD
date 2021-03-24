$(function() {
	$("#example-basic-expandable").treetable({ expandable: true,column: $("#example-basic-expandable").attr('data-column') || 0 });
})

$('.toggle-btn').on('click', function(){
	if($(this).attr('data-flag') == 1){
		$(this).attr('data-flag',0);
		$(this).children('.text').text('全部折叠');
		$(this).children('.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');
		$('#example-basic-expandable').treetable('expandAll'); return false;
	} else {
		$(this).attr('data-flag', 1);
		$(this).children('.text').text('全部展开');
		$(this).children('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
		$('#example-basic-expandable').treetable('collapseAll'); return false;
	}
})