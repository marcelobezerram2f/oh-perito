

$('.novo-equipamento').click(function(e){
    let cliente_id = $('#cliente_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        url:'/equipamento/store'+location.search,
        method:'POST',
        data:$('form[name="form-equipamento"]').serialize(),
        success: function(response){
                $('form[name="form-equipamento"]').each(function () {
                    this.reset()
                })
            $('#modal-cliente').modal('hide')

            location.href = `cliente/${cliente_id}/show`

        }
    })
})


$('.close-modal').click(function(){

    $('form[name="form-equipamento"]').each(function () {
        this.reset()
    })
    $('#modal-cliente').modal('hide')
})

$('.equipamento-update').click(function(e){

    let cliente_id = $('#cliente_id').val();
    let id= $('input[name="id"]').val()
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        url:`/equipamento/${id}/update`+location.search,
        method:'POST',
        data:$('form[name="form-equipamento"]').serialize(),
        success: function(response){
            $('form[name="form-equipamento"]').each(function () {
                this.reset()
            })
               $('#modal-cliente').modal('hide')
               location.href = `/cliente/${cliente_id}/show`
               this.folderActive();
            }
    })
})


function folderActive(){
    $('#pasta-contatos').addClass('nav-link')
    $('#pasta-equipamentos').addClass('nav-link active')
    $('#pasta-faturamento').addClass('nav-link')

    $('#contatos').addClass('tab-pane')
    $('#equipamentos').addClass('tab-pane active')
    $('#faturamento').addClass('tab-pane')


}

