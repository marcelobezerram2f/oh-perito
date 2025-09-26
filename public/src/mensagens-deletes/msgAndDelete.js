/**
 * Sweet message and Ajax delete method request
 * Categorias
 * @param {*} id
 */
function deleteCategoria (id)
{
  console.log(id)
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover categoria?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {   
      $.ajax({
        url: `/categorias/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          if (msg == '200')
          {
            swal(
              'Categoria Removida!',
              'Categoria removida com sucesso.',
              'success').then(function ()
              {
                location.href = '/categorias';
              });
          } else
          {
            swal(
              'Categoria NÃO Removida!',
              'Problemas ao remover a categoria!.',
              'error'
            )
          }
        }
      })
    }
  })
}
/**
 * Sweet message and Ajax delete method request
 * Sub Categorias
 * @param {*} id
 */

function deleteSubCategoria (id)
{
  console.log(id)
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover sub categoria?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/subcategorias/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          console.log(msg)
          if (msg == '200')
          {
            swal(
              'Sub categoria Removida!',
              'Sub categoria removida com sucesso.',
              'success').then(function ()
              {
                location.href = '/categorias';
              });
          } else
          {
            swal(
              'Sub categoria NÃO Removida!',
              `Problemas ao remover a sub categoria!. code ${msg}`,
              'error'
            )
          }
        }
      })
    }
  })
}

/**
 * Sweet message and Ajax delete method request
 * Agenda
 * @param {*} id
 */

function deleteAgenda (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode cancelar!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja cancelar atendimento?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/agendas/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          console.log(msg)
          if (msg == '200')
          {
            swal(
              'Atendimento Cancelado!',
              'Atendimento cancelado com sucesso.',
              'success').then(function ()
              {
                location.href = '/agendas';
              });
          } else
          {
            swal(
              'Atendimento NÃO Cancelado!',
              `Problemas ao efetuar o cancelamento do atendimento!. `,
              'error'
            )
          }
        }
      })
    }
  })
}

/**
 * Sweet message and Ajax delete method request
 * Pessoas
 * @param {*} id
 */

function deleteCliente (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover cliente selecionado?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/cliente/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          console.log(msg)
          if (msg == '200')
          {
            swal(
              'Registro removido!',
              'Cliente removido com sucesso.',
              'success').then(function ()
              {
                location.href = '/clientes';
              });
          } else
          {
            swal(
              'Cliente NÃO removido!',
              `Problemas ao remover o registro!. `,
              'error'
            )
          }
        }
      })
    }
  })
}


/**
 * Sweet message and Ajax delete method request
 * Pessoas
 * @param {*} id
 */

function deleteTecnico (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover técnico selecionado?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/tecnico/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          console.log(msg)
          if (msg == '200')
          {
            swal(
              'Registro removido!',
              'Técnico removido com sucesso.',
              'success').then(function ()
              {
                location.href = '/tecnicos';
              });
          } else
          {
            swal(
              'Técnico NÃO removido!',
              `Problemas ao remover o registro!. `,
              'error'
            )
          }
        }
      })
    }
  })
}



/**
 * Sweet message and Ajax delete method request
 * Servicos
 * @param {*} id
 */

function deleteServicos (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover o serviço selecionado?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/servicos/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          console.log(msg)
          if (msg == '200')
          {
            swal(
              'Registro removido!',
              'Serviço removido com sucesso.',
              'success').then(function ()
              {
                location.href = '/servicos';
              });
          } else
          {
            swal(
              'Serviço NÃO removido!',
              `${msg}`,
              'error'
            )
          }
        }
      })
    }
  })
}

/**
 * Sweet message and Ajax delete method request
 * Pacotes
 * @param {*} id
 */

function deletePacotes (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover o pacote selecionado?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/pacotes/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (msg)
        {

          if (msg == '200')
          {
            swal(
              'Registro removido!',
              'Pacote removido com sucesso.',
              'success').then(function ()
              {
                location.href = '/pacotes';
              });
          } else
          {
            swal(
              'Pacote NÃO removido!',
              `Problemas ao efetuar a remoção do pacote!. `,
              'error'
            )
          }
        }
      })
    }
  })
}


/**
 * Sweet message and Ajax delete method request
 * Contas-Pagar
 * @param {*} id
 */

function deleteContaPagar (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode remover!',
    cancelButtonText: 'Cancelar',
    text: 'Deseja remover a despesa selecionado?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/contas-pagar/${id}/destroy`,
        method: 'GET',
        data: {},
        success: function (response)
        {
          if (response.message)
          {
            swal(
              'Registro não removido!',
              'Despesa consolidada não pode ser excluida.',
              'warning').then(function ()
              {
                location.href = '/contas-pagar';
              });
          } else
          {
            swal(
              'Registro removido!',
              'Despesa removida com sucesso.',
              'success').then(function ()
              {
                location.href = '/contas-pagar';
              });
          }
        },

        error:
          swal(
            'Despesa NÃO removida!',
            `Problemas ao efetuar a remoção da despesa!. `,
            'error').then(function ()
            {
              location.href = '/contas-pagar'
            })

      })
    }
  })
}

/**
 * Sweet message and Ajax delete method request
 * Bloqueio de agenda
 * @param {*} id
 */

function deletaBloqueio (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode cancelar!',
    cancelButtonText: 'Não cancelar',
    text: 'Deseja cancelar o bloqueio de agenda?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `/agendas/delete-bloqueio/${id}`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          if (msg == '200')
          {
            swal(
              'Registro removido!',
              'Cancelamento de bloqueio realizado com sucesso!.',
              'success').then(function ()
              {
                location.href = '/agendas'
              });

          } else
          {
            swal(
              'Cancelamento de bloqueio não executado!',
              `Problemas ao remover o registro!. `,
              'error'
            )
          }
        }
      })
    }
  })
}

/**
 * Sweet message and Ajax delete method request
 * Cancelamento de Chamado
 * @param {*} id
 */

function deleteTicket (id)
{
  swal({
    title: 'CUIDADO!',
    showCancelButton: true,
    confirmButtonText: 'Sim, pode cancelar!',
    cancelButtonText: 'Não cancelar',
    text: 'Deseja cancelar o chamado técnico?.',
    type: 'warning',
    confirmButtonColor: '#F54400',
    showLoaderOnConfirm: true,
    preConfirm: () =>
    {
      $.ajax({
        url: `https://softworksistemas.com.br/api/tickets/destroy/${id}`,
        method: 'GET',
        data: {},
        success: function (msg)
        {
          if (msg == '200')
          {
            swal(
              'Chamado cancelado!',
              'Cancelamento de chamado realizado com sucesso!.',
              'success').then(function ()
              {
                location.href = '/tickets' + location.search
              });

          } else
          {
            swal(
              'Cancelamento de chamado não executado!',
              `Problemas ao remover o registro!. `,
              'error'
            )
          }
        }
      })
    }
  })
}

/**
 * Sweet message and Ajax delete method request
 * Apaga de comentário ticket
 * @param {*} id
 */

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
        url: `https://softworksistemas.com.br/api/comments/destroy/${id}`,
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
