var escogioArchivo = false;



function subirImagen(tipo, datos, file) {
  console.log(datos);
  var storageRef = firebase.storage().ref("Usuarios/" + datos.UserName);
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
          guardarUsuario(datos);
        } else {
          editarUsuario(datos);
        }
      });
    }
  );
}

function validarImagen() {
  let f = document.getElementById("image_browser_usuario_c");
  //this.file = f.files[0].name;
  getBase64(f.files[0]);

  escogioArchivo = true;
}

function validarImagenUsuarioE() {
  let f = document.getElementById("image_browser_usuario_e");
  //this.file = f.files[0].name;
  getBase64(f.files[0]);

  escogioArchivo = true;
}

function getBase64(file) {
  var url = "";
  if (file) {
    const reader = new FileReader();
    reader.onloadend = () => {
      let foto = document.getElementById("imagen_usuario");
      foto.src = reader.result.toString();
    };
    reader.readAsDataURL(file);

    return url;
  }
}

$("#formusuariocrear").on("submit", function (e) {
  e.preventDefault();
  console.log("guardaraa");
  validarUsuario();
});

function validarUsuario() {
  Swal.fire("Espere..");
  Swal.showLoading();
  var tipoDoc = $("#DocTipo").val();
  var numeroDoc = $("#DocNumero").val();
  var empresa = $("#IdEmpresa").val();
  var fecha = $("#FechaNacimiento").val();
  var email = $("#Email").val();
  var nombres = $("#Nombres").val();
  var apellidos = $("#Apellidos").val();
  var telefono = $("#Telefono").val();
  var genero = $("#Genero").val();
  var rol = $("#IdRol").val();
  var usuario = $("#UserName").val();
  var clave = $("#Clave").val();
  var clave2 = $("#Clave2").val();

  let datos = {
    Imagen: "",
    UserName: usuario,
    Clave: clave,
    Clave2: clave2,
    DocTipo: tipoDoc,
    DocNumero: numeroDoc,
    IdEmpresa: empresa,
    FechaNacimiento: fecha,
    Email: email,
    Nombres: nombres,
    Apellidos: apellidos,
    Telefono: telefono,
    Genero: genero,
    IdRol: rol,
    IdCiudad: 1,
    Direccion: "",
    CodigoPostal: "",
    IdTipoRegistro: 1,
  };

  $.ajax({
    url: "https://futprojs.com/Usuario/validar",
    type: "POST",
    data: datos,
    success: function (res) {
      console.log(res);
      if (res == "ok[]") {
        //window.location.href = "index.php";
        console.log("ok");
        let f = document.getElementById("image_browser_usuario_c");
        let boton = document.getElementById("btnsave");
        console.log(boton.textContent);
        if (!f.files[0]) {
          Swal.fire(
            "FALTA FOTO DE PERFIL!",
            "Por favor debe subir una foto de perfil.",
            "warning"
          );
        } else {
          subirImagen("create", datos, f);
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

function guardarUsuario(datos) {
  console.log(datos);
  $.ajax({
    url: "https://futprojs.com/Usuario/store",
    type: "POST",
    data: datos,
    success: function (res) {
      console.log(res);
      if (res == "ok[]") {
        window.location.href = "https://futprojs.com/Usuario";
        console.log("guardado");
        alertaOK("Usuario registrado");
      } else {
        console.log(JSON.parse(res));
      }
    },
  });
}

function cerrarAlerta() {
  let div = document.getElementById("alerta");
  div.style.display = "none";
}

function alertaOK(msm) {
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
    title: msm,
  });
}

//EDITAR

$("#formusuarioeditar").on("submit", function (e) {
  e.preventDefault();

  validarEditarUsuario();
});

function validarEditarUsuario() {
  console.log("editar");
  Swal.fire("Espere..");
  Swal.showLoading();
  var tipoDoc = $("#DocTipoE").val();
  var numeroDoc = $("#DocNumeroE").val();
  var empresa = $("#IdEmpresaE").val();
  var fecha = $("#FechaNacimientoE").val();
  var email = $("#EmailE").val();
  var nombres = $("#NombresE").val();
  var apellidos = $("#ApellidosE").val();
  var telefono = $("#TelefonoE").val();
  var genero = $("#GeneroE").val();
  var rol = $("#IdRolE").val();
  var user = $("#usuarioE").val();
  let img = document.getElementById("imagen_usuario");
  let datos = {
    UserName: user,
    Imagen: img.src,
    DocTipo: tipoDoc,
    DocNumero: numeroDoc,
    IdEmpresa: empresa,
    FechaNacimiento: fecha,
    Email: email,
    Nombres: nombres,
    Apellidos: apellidos,
    Telefono: telefono,
    Genero: genero,
    IdRol: rol,
    IdCiudad: 1,
    Direccion: "",
    CodigoPostal: "",
    IdTipoRegistro: 1,
  };
  console.log(datos);
  $.ajax({
    url: "https://futprojs.com/Usuario/validareditar",
    type: "POST",
    data: datos,
    success: function (res) {
      console.log("ok");
      console.log(res);
      if (res == "ok[]") {
        //window.location.href = "index.php";
        let f = document.getElementById("image_browser_usuario_e");

        if (!f.files[0]) {
          editarUsuario(datos);
        } else {
          subirImagen("editar", datos, f);
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

function editarUsuario(datos) {
  console.log(datos);
  var id = document.getElementById("idusuarioE");
  console.log(id.textContent);
  $.ajax({
    url: "https://futprojs.com/Usuario/update/" + Number(id.textContent),
    type: "POST",
    data: datos,
    success: function (res) {
      console.log(res);

      window.location.href = "https://futprojs.com/Usuario";
      console.log("guardado");
      alertaOK("Usuario actualizado");
    },
  });
}
