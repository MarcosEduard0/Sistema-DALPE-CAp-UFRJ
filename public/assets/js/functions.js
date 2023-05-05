function deleteModal(id) {

    var data = document.getElementById(id);
    var json = JSON.parse(data.getAttribute('data-detalhes'));

    if(!json.nome){
    document.getElementById("nome").textContent = json.nome_completo;
    }else{
        document.getElementById("nome").textContent = json.nome;
    }
    document.getElementById("confirmDelete").href = window.location.href + '/excluir/' + id;

}

function documentoModel(licenciando_id,documento_id, setor_id, baseUrl) {

    var data = document.getElementById(documento_id);
    var json = JSON.parse(data.getAttribute('data-detalhes'));
    data = document.getElementById('document_action');
    data.action = baseUrl + '/documentos/emitir/'+licenciando_id+'/'+ setor_id + '/'+ documento_id;

    data = document.getElementById('nomeDocumento');
    data.innerText  = json.nome;
}

demo = {
     
    showNotification: function(from, align, msg, color) {
        icone = "fa fa-check-circle"
        if (color == 'danger'){
            icone = "fa fa-exclamation-circle";
        }
      $.notify({
        icon: icone,
        message: msg
  
      }, {
        type: color,
        timer: 5000,
        placement: {
          from: from,
          align: align
        }
      });
    }
  
  };

 /*===== NAVBAR =====*/
  document.addEventListener("DOMContentLoaded", function(event) {
   
    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)
    
    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // show navbar
    nav.classList.toggle('show-nav')
    // change icon
    toggle.classList.toggle('bx-x')
    // add padding to body
    bodypd.classList.toggle('body-pd')
    // add padding to header
    headerpd.classList.toggle('body-pd')
    })
    }
    }
    
    showNavbar('header-toggle','nav-bar','body-pd','header')
    
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))
    
     // Your code to run since DOM is loaded and ready
    });