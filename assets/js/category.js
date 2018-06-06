// javascript document

$(function () {
    // dom is now ready
    $('a.edit-category').click (function (e) {
        $(this).hide();
        $(this).parent().find('.edit-category-form').show();
        e.preventDefault();
    });
});
