( function( api ) {

	// Extends our custom "fse-education-school" section.
	api.sectionConstructor['fse-education-school'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );