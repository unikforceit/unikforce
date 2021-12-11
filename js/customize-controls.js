(function (api) {

    // Extends our custom section.
    api.sectionConstructor['unikforce_button'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function () {
        },

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

})(wp.customize);
