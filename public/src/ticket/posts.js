$("#atualiza-ticket").click(function ()
{
    let id = $('input[name="ticket_id"]').val()
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url: `/ticket/update/${id}` + location.search,
        type: 'PUT',
        data: $('form[name="form-show-ticket"]').serialize(),
        success: function (response)
        {
            console.log(response)

        }
    })
})