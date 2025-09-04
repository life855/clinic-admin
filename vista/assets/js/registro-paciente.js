document.addEventListener("DOMContentLoaded", () => {
  // === Autocompletar DNI ===
  const inputDni = document.getElementById("tipo_doc");
  inputDni.addEventListener("blur", () => {
    let dni = (inputDni.value).trim();

    if (dni.length === 8) { //"consulta_dni.php?dni=" + dni
      let existe = consultarDataUserStorage(dni);
           
      if(existe){
        console.log('existe DNI');
        let data = JSON.parse(localStorage.getItem("_dataUser"));
        let obj = data.find(a => a.numero === dni);
        console.log(obj);

        document.getElementById("nombres").value = obj.nombres;
        document.getElementById("apellidos").value = obj.apellido_paterno + " " + obj.apellido_materno;
      } else {
        console.log('no existe')
        fetch(
          "https://apiperu.dev/api/dni/"+dni+"?api_token=4ac309fef4b4d9370d9369fcc5e13eeb3b25d2f1ed12fb8f2627fa1c53368bde"
        ) 
          .then(res => res.json())
          .then(data => {
            console.log(data);
            if (data.success) {
              let infoStorage = obtenerDataUserStorage();
              infoStorage.push(data.data);
              localStorage.setItem("_dataUser", JSON.stringify(infoStorage));

              document.getElementById("nombres").value = data.data.nombres;
              document.getElementById("apellidos").value = data.data.apellido_paterno + " " + data.data.apellido_materno;
            } else {
              alert("DNI no encontrado");
            }
          })
          .catch(err => console.error("Error:", err));
      }

    }
  });

  function consultarDataUserStorage(dni){
    try{
      let  data = localStorage.getItem("_dataUser") === null ? [] : JSON.parse(localStorage.getItem("_dataUser"));
      let  obj = data.find(a => a.numero == dni);
      let existeDNI = typeof obj === "undefined" ? false : true;
      return existeDNI;
    }catch(e){console.log(e);}
  }

  function obtenerDataUserStorage(){
    return localStorage.getItem("_dataUser") === null ? [] : JSON.parse(localStorage.getItem("_dataUser"));
  }

  // === Calcular edad ===
  const fechaNacimientoInput = document.getElementById("fecha_nacimiento");
  const edadInput = document.getElementById("edad");
  fechaNacimientoInput.addEventListener("input", () => {
    const fechaNacimiento = new Date(fechaNacimientoInput.value);
    const hoy = new Date();

    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
      edad--;
    }
    edadInput.value = isNaN(edad) ? "" : edad;
  });

  

  // === Toggle correo secundario ===
  // const btnCorreo = document.getElementById("toggleBtnCorreo");
  // const filaCorreo = document.getElementById("correo2");
  // btnCorreo.addEventListener("click", () => {
  //   if (filaCorreo.classList.contains("visible")) {
  //     filaCorreo.classList.remove("visible");
  //     btnCorreo.textContent = "Agregar correo";
  //   } else {
  //     filaCorreo.classList.add("visible");
  //     btnCorreo.textContent = "Quitar correo";
  //   }
  // });

  // === Toggle teléfono secundario ===
  // const btnTelefono = document.getElementById("toggleBtnTelefono");
  // const filaTelefono = document.getElementById("telefonoSecundario");
  // btnTelefono.addEventListener("click", () => {
  //   if (filaTelefono.classList.contains("visible")) {
  //     filaTelefono.classList.remove("visible");
  //     btnTelefono.textContent = "Agregar teléfono secundario";
  //   } else {
  //     filaTelefono.classList.add("visible");
  //     btnTelefono.textContent = "Quitar teléfono secundario";
  //   }
  // });

  // === Ajustar ancho del select tipo-doc ===
  // const select = document.getElementById("select-tipo-doc");
  // const measurer = document.getElementById("hidden-measurer");

  // function ajustarAncho() {
  //   const selectedText = select.options[select.selectedIndex].text;
  //   measurer.textContent = selectedText;

  //   measurer.style.font = getComputedStyle(select).font;
  //   measurer.style.padding = getComputedStyle(select).padding;

  //   select.style.width = (measurer.offsetWidth + 25) + "px";
  // }

  // ajustarAncho();
  // select.addEventListener("change", ajustarAncho);
});


document.getElementById('registrar-paciente').addEventListener('submit', async function(e){
    e.preventDefault();
    const nombres = document.getElementById('nombres').value.trim();
    const apellido = document.getElementById('apellidos').value.trim();
    const nacimiento = document.getElementById('fecha_nacimiento').value.trim();
    const genero = document.querySelector('input[name="sexo"]:checked') === null ? 0 : document.querySelector('input[name="sexo"]:checked').value;
    const estadoCivil = document.getElementById("estadoCivil").value.trim();

    const pd_tipo = document.getElementById("select-tipo-doc").value;
    const pd_codigo = document.getElementById("tipo_doc").value.trim();
    const docs = [{pd_tipo, pd_codigo}];

    const pt_tipo = document.getElementById("select-tel-principal").value;
    const pt_codigo = document.getElementById("telefono_principal").value.trim();
    const tels = [{pt_tipo, pt_codigo}];

    const pd_departamento = "0";
    const pd_provincia = "0";
    const pd_distrito = document.getElementById("localidad-distrito").value;
    const pd_anexo = "0";
    const pd_direccion = document.getElementById("direccion").value.trim();
    const dirs = [{pd_departamento, pd_provincia, pd_distrito, pd_anexo, pd_direccion}];

    const persona = { nombres, apellido, nacimiento, genero, estadoCivil, docs, tels, dirs};
    
    try {
        const resp = await fetch(url_base + 'controlador/personaController.php?action=register', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(persona)
        });
        const data = await resp.json();
        //const msgEl = document.getElementById('loginMsg');
        if (data.success) {
            //msgEl.innerHTML = '<div class="alert alert-success">Ingreso correcto. Redireccionando...</div>';
          console.log('Ingreso correcto. Redireccionando');
            // redirigir a dashboard
            //setTimeout(()=> window.location.href = url_base + 'vista/index.php', 700);
        } else {
            //msgEl.innerHTML = '<div class="alert alert-danger">' + (data.message || 'Error en registro') + '</div>';
          console.log(data.message);
        }
    } catch (err) {
        console.log(err);
        //document.getElementById('loginMsg').innerHTML = '<div class="alert alert-danger">Error de comunicación</div>';
    }
  });