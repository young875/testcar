$('#add-image').click(function () {
    const  index = +$('#widget_counter').val();

    const  tmpl = $('#ad_images').data('prototype').replace(/__name__/g, index);

    $('#ad_images').append(tmpl);

    $('#widget_counter').val(index +1 )

    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    })
}

function updateCounter() {
    const count = +$('#ad_images div.form-group').length;
    $('#widget_counter').val(count);

}
updateCounter();
handleDeleteButtons();