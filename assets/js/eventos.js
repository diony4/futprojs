var idevento = 0;

const firebaseConfig = {
  apiKey: "AIzaSyCVPQ_oBL8bPeIWzlfQleRK8m3LygRDodQ",
  authDomain: "futprojs.firebaseapp.com",
  projectId: "futprojs",
  storageBucket: "futprojs.appspot.com",
  messagingSenderId: "878832689105",
  appId: "1:878832689105:web:4c0339051f7461e5478af0",
  measurementId: "G-CRKQF6XC6D",
};
firebase.initializeApp(firebaseConfig);

function subirImagenEvento(tipo, datos, file) {
  console.log(datos);
  var storageRef = firebase.storage().ref("Eventos/" + datos.Titulo);
  var uploadTask = storageRef.put(file.files[0]);

  uploadTask.on(
    "state_changed",
    function (snapshot) {
      var progressValue = String(
        (snapshot.bytesTransferred / snapshot.totalBytes) * 100
      ).split(".")[0];
      console.log(progressValue);
    },
    function (error) {
      console.log(error);
    },
    function () {
      console.log("imagen subida");

      uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
        datos.Imagen = downloadURL;

        if (tipo == "create") {
          guardarEvento(datos);
        } else {
          editarEvento(datos);
        }
      });
    }
  );
}

function guardarEvento(datos) {
  console.log(datos);
  $.ajax({
    url: "https://futprojs.com/Evento/store",
    type: "POST",
    data: datos,
    success: function (res) {
      console.log(res);
      if (res == "ok[]") {
        window.location.href = "https://futprojs.com/Evento";
        console.log("guardado");
        alertaOK("Evento registrado");
      } else {
        console.log(JSON.parse(res));
      }
    },
  });
}

function editarEvento(datos) {
  console.log(datos);
  var id = document.getElementById("ideventoE");
  console.log(id.textContent);
  $.ajax({
    url: "https://futprojs.com/Evento/update/" + Number(id.textContent),
    type: "POST",
    data: datos,
    success: function (res) {
      console.log(res);

      window.location.href = "https://futprojs.com/Evento";
      console.log("guardado");
      alertaOK("Evento actualizado");
    },
  });
}

function validarImagenEvento() {
  let f = document.getElementById("image_evento_c");
  //this.file = f.files[0].name;
  getBase64Evento(f.files[0]);

  escogioArchivo = true;
}
function validarImagenEventoE() {
  let f = document.getElementById("image_evento_e");
  //this.file = f.files[0].name;
  getBase64Evento(f.files[0]);

  escogioArchivo = true;
}

function getBase64Evento(file) {
  var url = "";
  if (file) {
    const reader = new FileReader();
    reader.onloadend = () => {
      let foto = document.getElementById("imagen_evento");
      foto.src = reader.result.toString();
    };
    reader.readAsDataURL(file);

    return url;
  }
}

//AGREGAR EVENTOS

$("#formusuariocrearevento").on("submit", function (e) {
  e.preventDefault();
  console.log("guardar");
  validar();
});

function validar() {
  Swal.fire("Espere..");
  Swal.showLoading();
  var IdSede = $("#IdSede").val();
  var Titulo = $("#Titulo").val();
  var Fecha = $("#Fecha").val();
  var Hora = $("#Hora").val();
  var Aforo = $("#Aforo").val();
  var Descripcion = $("#Descripcion").val();

  let datos = {
    Imagen: "",
    IdSede: IdSede,
    Titulo: Titulo,
    Fecha: Fecha,
    Hora: Hora,
    Aforo: Aforo,
    Descripcion: Descripcion,
  };

  $.ajax({
    url: "https://futprojs.com/Evento/validar",
    type: "POST",
    data: datos,
    success: function (res) {
      console.log(res);
      if (res == "ok[]") {
        //window.location.href = "index.php";
        console.log("ok");
        let f = document.getElementById("image_evento_c");

        if (!f.files[0]) {
          Swal.fire(
            "FALTA FOTO DEL EVENTO!",
            "Por favor debe subir una imagen del evento.",
            "warning"
          );
        } else {
          subirImagenEvento("create", datos, f);
        }
      } else {
        let div = document.getElementById("alerta");
        let html = "<strong>Errors:</strong><br>";
        for (let x of JSON.parse(res)) {
          html = html + x + "<br>";
        }
        html =
          html +
          '<span type="button" class="close"  aria-label="Close" onclick="cerrarAlerta()"> <span aria-hidden="true">&times;</span></span>';
        div.innerHTML = html;
        div.style.display = "block";
        Swal.close();
      }
    },
  });
}

//EDITAR EVENTO

//EDITAR

$("#formeventoeditar").on("submit", function (e) {
  e.preventDefault();

  validarEditarEvento();
});

function validarEditarEvento() {
  console.log("editar");
  Swal.fire("Espere..");
  Swal.showLoading();
  var IdSede = $("#IdSede").val();
  var Titulo = $("#Titulo").val();
  var Fecha = $("#Fecha").val();
  var Hora = $("#Hora").val();
  var Aforo = $("#Aforo").val();
  var Descripcion = $("#Descripcion").val();
  let img = document.getElementById("imagen_evento");
  let datos = {
    Imagen: img.src,
    IdSede: IdSede,
    Titulo: Titulo,
    Fecha: Fecha,
    Hora: Hora,
    Aforo: Aforo,
    Descripcion: Descripcion,
  };
  console.log(datos);
  $.ajax({
    url: "https://futprojs.com/Evento/validar",
    type: "POST",
    data: datos,
    success: function (res) {
      console.log("ok");
      console.log(res);
      if (res == "ok[]") {
        //window.location.href = "index.php";
        let f = document.getElementById("image_evento_e");

        if (!f.files[0]) {
          editarEvento(datos);
        } else {
          subirImagenEvento("editar", datos, f);
        }
      } else {
        let div = document.getElementById("alerta");
        let html = "<strong>Errors:</strong><br>";
        for (let x of JSON.parse(res)) {
          html = html + x + "<br>";
        }
        html =
          html +
          '<span type="button" class="close"  aria-label="Close" onclick="cerrarAlerta()"> <span aria-hidden="true">&times;</span></span>';

        div.innerHTML = html;
        div.style.display = "block";
        Swal.close();
      }
    },
  });
}
//DETALLE ZONAS

function agregarZonas(id, data) {
  console.log(data);
  idevento = id;
  for (let zona of data) {
    $("#zona" + zona.IdZona).collapse("hide");
  }

  $("#mdzonas").modal("show"); // abrir
}

function guardarDetalleZona(idzona, nombre) {
  var aforo = $("#Aforo" + idzona).val();
  var precio = $("#Precio" + idzona).val();

  if (aforo == "" && precio == "") {
    Swal.fire(
      "FALTAN DATOS!",
      "Debe llenar los campos de aforo y precio.",
      "warning"
    );
  } else {
    let datos = {
      IdZona: idzona,
      IdEvento: idevento,
      Aforo: aforo,
      Precio: precio,
    };

    console.log(datos);

    $.ajax({
      url: "https://futprojs.com/Zona/guardardetallezona",
      type: "POST",
      data: datos,
      success: function (datos) {
        alertaOK(nombre);
      },
    });
  }
}

function obtenerDetalleZona(idzona) {
  let datos = {
    IdZona: idzona,
    IdEvento: idevento,
  };
  Swal.fire("Espere..");
  Swal.showLoading();
  $.ajax({
    url: "https://futprojs.com/Zona/obtenerdetallezona",
    type: "POST",
    data: datos,
    success: function (datos) {
          console.log(datos);
      var zona = JSON.parse(datos);
      console.log(zona);
      var boton = document.getElementById("borrar" + idzona);
      if (zona.length == 0) {
        boton.style.display = "none";
      } else {
        $("#Aforo" + idzona).val(zona[0].Aforo);
        $("#Precio" + idzona).val(zona[0].Precio);
        boton.style.display = "block";
      }

      Swal.close();
    },
  });
}

function eliminarDetalleZona(idzona, nombre) {
  let datos = {
    IdZona: idzona,
    IdEvento: idevento,
  };
  Swal.fire("Espere..");
  Swal.showLoading();
  $.ajax({
    url: "https://futprojs.com/Zona/eliminardetallezona",
    type: "POST",
    data: datos,
    success: function (datos) {
      //$("#zona"+idzona).collapse('hide');
      $("#Aforo" + idzona).val("");
      $("#Precio" + idzona).val("");
      alertaDelete(nombre);
    },
  });
}

function alertaOK(name) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title: "Zona " + name + " guardado",
  });
}

function alertaDelete(name) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title: "Zona " + name + " eliminada",
  });
}
