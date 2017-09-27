/**
 * Hypermarket Welcome Screen
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.7.0
 */

jQuery(document).ready(function($) {
    'use strict';

    var current_tab = 'welcome';
    // Hide all content(s) and sidebar(s).
    hypermarketHideAllWelcomeScreenTabs();
    // Show current selected tab content and sidebar.
    hypermarketShowSelectedWelcomeScreenContent(current_tab);
    // Handle click event on welcome screen navigation item(s).
    $('#hypermarket-welcome-screen-nav > a').on('click', function(event){
    	event.preventDefault();
    	$('#hypermarket-welcome-screen-nav > a').removeClass('nav-tab-active');
    	$(this).addClass('nav-tab-active');
    	current_tab = $(this).attr('href').replace('#', '');
    	hypermarketHideAllWelcomeScreenTabs();
    	hypermarketShowSelectedWelcomeScreenContent(current_tab);
    });
    function hypermarketHideAllWelcomeScreenTabs() {
    	$('#hypermarket-welcome-screen-nav > a').each(function(){
    		var tabID = $(this).attr('href').replace('#', '');
    		$('#' + tabID + '-content, #' + tabID + '-sidebar').hide();
    	});
    }
    function hypermarketShowSelectedWelcomeScreenContent(selector) {
    	$('#' + selector + '-content, #' + selector + '-sidebar').show();
    }
    // Redirect to "Go Plus" tab on page load
    if(window.location.href.indexOf('#goplus') > -1){
        setTimeout(function(){
            $('#hypermarket-welcome-screen-nav > a.goplus').trigger('click');
        }, 500);
    }

}); /*Document Ready End*/