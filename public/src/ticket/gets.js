function deleteCommentTicket (id)
{
    let ticket_id = $('input[name="ticket_id"]').val()
    swal({
        title: 'CUIDADO!',
        showCancelButton: true,
        confirmButtonText: 'Sim, pode cancelar!',
        cancelButtonText: 'Não cancelar',
        text: 'Deseja apagar comentário técnico?.',
        type: 'warning',
        confirmButtonColor: '#F54400',
        showLoaderOnConfirm: true,
        preConfirm: () =>
        {
            $.ajax({
                url: `/ticket/comentarios/destroy/${id}`,
                method: 'GET',
                data: {},
                success: function (msg)
                {
                    if (msg == '200')
                    {
                        swal(
                            'OK!',
                            'Comentário pagado com sucesso!.',
                            'success').then(function ()
                            {
                                location.href = `/ticket/show/${ticket_id}`
                            });

                    } else
                    {
                        swal(
                            'Comentário de chamado não executado!',
                            `Problemas ao remover o registro!. `,
                            'error'
                        )
                    }
                }
            })
        }
    })
}


$('select[name="pessoa_id"]').change(function ()
{
    let pessoa_id = $('select[name="pessoa_id"]').val();
    let contrato = ''
    let usuario = ''
    $.ajax({
        url: `/contrato/pessoa/${pessoa_id}`,
        method: 'GET',
        dataType: 'json'
    }).done(function (response)
    {
        if (response.message)
        {
            swal(
                'OPS!',
                `Cliente não possui serviço Cadastrado!. `,
                'error'
            )
        } else
        {
            response.forEach(function (sistema)
            {
                console.log(sistema.sistema)

            })

        }
    })
})