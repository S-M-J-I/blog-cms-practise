console.log("Wporks")

document.getElementById("delete").addEventListener('click', (e) => {
    return confirm("Are you sure you want to delete this post?")
})

$('#bulk_select').on('change', function () {
    window.location = `/cms/admin/posts.php?source=filter&by=${$(this).val()}`
});