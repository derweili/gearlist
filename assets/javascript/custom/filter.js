var filterValue;
var oldFilterValue;
oldFilterValue = '';
$( ".filteritem" ).click(function() {

		filterValue = $( this ).data( "filter" );


	if (filterValue == oldFilterValue) {
		$( ".filteritem" ).removeClass( "active" );
		$( ".singlegearitem" ).css( "display", "block" );
		oldFilterValue = '';
	}else{
		//$( this ).css( "color", "red" );
		$( ".filteritem" ).removeClass( "active" );
		$( this ).addClass( "active" );

		$( ".singlegearitem" ).css( "display", "none" );
		$( "." + filterValue ).css( "display", "block" );
		oldFilterValue = $( this ).data( "filter" );
	};
});




