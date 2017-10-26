/**
 * Hypermarket Customizer
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.3.8
 */
(function(api) {

    // Extends our custom section.
    api.sectionConstructor['hypermarket_go_plus_control'] = api.Section.extend({
        // No events for this type of section.
        attachEvents: function() {},
        // Always make the section active.
        isContextuallyActive: function() {
            return true;
        }
    });

})(wp.customize);