$(function() {
    // Open sidebar
    $("#openSidebar").on('click', function() {
        $("#sidebar").animate({ width: 'toggle' }, 350);
    });

    // Close sidebar
    $("#closeSidebar").on('click', function() {
        $("#sidebar").animate({ width: 'toggle' }, 350);
    });
});