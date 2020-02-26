$(function () {
    setTimeout(function () {
        $('#fader').fadeOut();
        $('#site').css('filter','none');
    },500);

    const pickr3 = new Pickr({
        el: '#color-picker-3',
        useAsButton: true,
        default: $('.bg-custom').css('background-color'),
        components: {
            preview: true,
            opacity: true,
            hue: true,

            interaction: {
                hex: true,
                rgba: true,
                hsla: true,
                hsva: true,
                cmyk: true,
                input: true,
                clear: true,
                save: true
            }
        },

        onChange(hsva, instance) {
            $('.bg-custom').css('background-color', hsva.toRGBA().toString());
            $('.text-custom,b').css('color', hsva.toRGBA().toString());
            $('.header').css('background','linear-gradient(177deg, '+hsva.toRGBA().toString()+' 80%, white 80%)');
            $('#page_customColor').val(hsva.toRGBA().toString());
        }
    });

    $('.editor').summernote();
    $('.note-editable').addClass('overflow-hidden');
    $('.note-editable button, .note-editable a').click(function (e) {
        e.preventDefault();
        return false;
    });


});
$(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);
})