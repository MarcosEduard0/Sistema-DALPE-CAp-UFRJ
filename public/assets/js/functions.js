function deleteModal(id) {

    // id = 'deleteDocumento' + id;
    // console.log(id)

    var data = document.getElementById(id);
    var json = JSON.parse(data.getAttribute('data-detalhes'));
    // console.log(window.location.href);
    // $("#amendoin").textContent(json.documento_id);
    if(!json.nome){
    document.getElementById("nome").textContent = json.nome_completo;
    }else{
        document.getElementById("nome").textContent = json.nome;
    }

    // document.getElementById("amendoin").innerHTML = json.documento_id;
    // var link = document.getElementById("amendoin");
    // link.setAttribute("href", "xyz.php");
    document.getElementById("confirmDelete").href = window.location.href + '/excluir/' + id;

    // $("#amendoin").innerHTML(json.documento_id);

}

function documentoModel(licenciando_id,documento_id, setor_id, baseUrl) {

    var data = document.getElementById(documento_id);
    var json = JSON.parse(data.getAttribute('data-detalhes'));
    data = document.getElementById('document_action');
    data.action = baseUrl + '/documentos/emitir/'+licenciando_id+'/'+ setor_id + '/'+ documento_id;

    data = document.getElementById('nomeDocumento');
    data.innerText  = json.nome;

    
}

