$(document).ready(function() {

    $('select#selectCity').on('change', function(e){

        var cidadeID = $(this).val();
        var dropChange = $(this).attr('data-drop-change');
        var url = $(this).attr('data-action-url');

        $.get(url, {cidade_id:cidadeID}, function(data){

            console.log(data);

            $('#'+dropChange)
                .find('option')
                .remove()
                .end()
                .append('<option value=""></option>');

            $.each(data, function (i, item) {
                $('#'+dropChange).append($('<option>', {
                    value: item.value,
                    text : item.text
                }));
            });

            //$('#'+dropChange).selectpicker('refresh');

        });

    });
    $('#cadastroanuncioform-bairro_id').select2({
        placeholder: "Selecione um Bairro",
        allowClear: true
    });
    $('.selectBairro').select2({
        placeholder: "Selecione um Bairro",
        allowClear: true
    }); 
    $('#AnunciosTags-tag_id').select2();
    $('#selectTag').select2({
        placeholder: "Selecione uma Tag",
        allowClear: true
    });
    $('#selectCategory').select2({
        placeholder: "Selecione uma Tag",
        allowClear: true
    });
});
