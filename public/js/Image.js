$("form").submit(function(e) {
    e.preventDefault();

    $.post("ajax\\addimage.php", $('#add_image').val(), function(data) {
        console.log(data);
    });
});