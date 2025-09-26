$('#sumbit-contact').click(function(e){
    e.preventDefault();
    $('.newsletter-img').html('<img src="http://mslclimatizacao.com.br/images/page/mail.gif">')
    console.log('teste');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        url:`/contato`+location.search,
        method:'POST',
        data:$('form[name="form-contact"]').serialize(),
        success: function(response){
            if (response )
            {
                $('input[name="name"]').val('')
                $('input[name="email"]').val('')
                $('input[name="fone"]').val('')
                $('input[name="message"]').val('')

                Swal.fire({
                    type: 'success',
                    title: `Contato enviado com sucesso!`,
                    text: 'Em breve retornaremos o contato',
                    confirmButtonColor: '#5f6627',
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: `Contato não enviado!`,
                    text: 'Sua solicitação de contato não foi enviado. Tente mais tarde!  ',
                    confirmButtonColor: '#5f6627',
                });
            }
        }
    })
})
