$(function () {
    // dom is ready
    $('.page-edit-btn').click(function (e) {
        $('#id').val($(this).parent().find('.id').val());
        $('#title').val($(this).parent().find('.title').val());
        $('#body').val($(this).parent().find('.body').val());
        $('#category').val($(this).parent().find('.category').val());
        $('#submit').val('Edit Page');
        e.preventDefault();
    });
});