// Invoca Modal Dinâmico para inclusão de Contato, Equipamento e Atendimento
$('.open-modal').on('click', function() {
    let cliente = $('input[name="cliente_id"]').val()
    let view = $(this).val()
    let header = ''
        if (view =='contatos'){
         header = '<i class="fa fa-address-card"></i> Incluir Novo Contato'
    } else if(view == 'equipamento'){
        header = '<i class="fa fa-snowflake-o"></i> Incluir Novo Equipamento de Ar-Condicionado'
    } else if(view == 'atendimento'){
        header = '<i class="si si-calendar"></i> Agendar Novo Atendimento'
    }
   
   let request = $.ajax({
        url:`../../${view}/${cliente}/create`,
    })

    console.log(`${view}/${cliente}/create`)
    request.done(function (data) {
        $('.modal-header').addClass('bg-info text-primary')
        $('.modal-header h3').html(header)
        $(".modal-content").html(data)
        $('#modal-cliente').modal('show')
    });
    request.fail(function () {
        $(".modal-content").html("Ocorreu um erro no carregamanto da função");
        $('#modal-cliente').modal('show');
    });

});

