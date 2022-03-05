console.log("Wporks")

$('#bulk_select').on('change', function () {
    window.location = `/cms/admin/posts.php?source=filter&by=${$(this).val()}`
});