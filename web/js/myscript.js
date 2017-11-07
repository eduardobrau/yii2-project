$(document).ready(function() {
    $('select#selectCity').on('change', function(e){


        var id = $(this).val();
        var dest = $(this).attr('drop-dest');
        var url = $(this).attr('data-action-url');

        $.get(url, {id:id}, function(data){

            console.log(data);

            $('#'+dest)
                .find('option')
                .remove()
                .end()
                .append('<option value=""></option>');

            $.each(data, function (i, item) {
                $('#'+dest).append($('<option>', {
                    value: item.value,
                    text : item.text
                }));
            });

            //$('#'+dest).selectpicker('refresh');

        });

    });
});
