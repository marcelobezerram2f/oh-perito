let html = ''
$.ajax({
    url:`/tecnicos/getAll`+location.search,
    method:'GET',
    success: function(response){
        html = `<option value=''>Selecione Técnico</option>`
        response.forEach(function(tecnicos){
            html+= `
                <option value='${tecnicos.id}'>${tecnicos.nome}</option>
            `
        })

        $('#tecnico_id').html(html)
    }
})



$('.novo-atendimento').click(function(e){
    let cliente_id = $('#cliente_id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        url:'/atendimento/store'+location.search,
        method:'POST',
        data:$('form[name="form-atendimento"]').serialize(),
        success: function(response){
            console.log(response)
            $('form[name="form-atendimento"]').each(function () {
                this.reset()
            })
               $('#modal-cliente').modal('hide')
               location.href = `/cliente/${cliente_id}/show`

        }
    })
})

$('.close-modal').click(function(){
    $('form[name="form-contato"]').each(function () {
        this.reset()
    })
    $('#modal-cliente').modal('hide')
})
