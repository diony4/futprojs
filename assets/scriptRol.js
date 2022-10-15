
var listaPermisos=[];


function cambiarSwitch(id,value){
    console.log(id);
    console.log(value.checked);
    if(value.checked==true){
        document.getElementById(id).style.display='block';

    }else{
        document.getElementById(id).style.display='none';
    }
    
}

function seleccionarPermiso(padre,permiso,value){

    let data = {
        "IdOpcion": permiso.IdOpcion,
        "Descripcion":permiso.Descripcion,
        "IdOpcionPadre":permiso.IdOpcionPadre
    }

    if(value.checked==true){
   
       if(listaPermisos.length==0){
            let hijos = [];
            
            hijos.push(data);
            let dad = {
                "IdOpcion":padre.IdOpcion,
                "Descripcion":padre.Descripcion,
                "IdOpcionPadre":padre.IdOpcionPadre,
                "Hijos": hijos
            }
            listaPermisos.push(dad);
       }else{
            let id = listaPermisos.find(item => item.IdOpcion==padre.IdOpcion);
           
            if(id!=undefined){
        
                let index = listaPermisos.indexOf(id);
                listaPermisos[index].Hijos.push(data);
            }else{
                let hijos = [];
            
                hijos.push(data);
                let dad = {
                    "IdOpcion":padre.IdOpcion,
                    "Descripcion":padre.Descripcion,
                    "IdOpcionPadre":padre.IdOpcionPadre,
                    "Hijos": hijos
                }
                listaPermisos.push(dad);
            }
       }
    }else{
        let id = listaPermisos.find(item => item.IdOpcion==padre.IdOpcion);
        let indexPadre = listaPermisos.indexOf(id);
    
        let hijo = listaPermisos[indexPadre].Hijos.find(i => i.IdOpcion == permiso.IdOpcion);
      
        let index = listaPermisos[indexPadre].Hijos.indexOf(hijo);
       
        listaPermisos[indexPadre].Hijos.splice(index,1);
    }

    console.log(listaPermisos);

}

function guardarRol(){

    var descripcion = $("#Descripcion").val();
    let datos = {
        "Descripcion": descripcion,
        "Permisos":(listaPermisos.length==0?'none':listaPermisos)
    }

    $.ajax({
        url: "../../fut/Rol/store",
        type: "POST",
        data: datos,
        success: function(datos){
       
            console.log(datos);
           if(datos=="exito[]"){
                window.location.href = "index.php";
           }else{
                let div = document.getElementById("alerta");
                let html = "<strong>Errors:</strong><br>";
                for(let x of JSON.parse(datos)){
                html = html+x+"<br>";
                }
                html = html+'<span type="button" class="close"  aria-label="Close" onclick="cerrarAlerta()"> <span aria-hidden="true">&times;</span></span>';
                div.innerHTML = html;
                div.style.display="block";
           }

          
            
        
        }
    });
}


function cerrarAlerta(){
    let div = document.getElementById("alerta");
    div.style.display="none";
}