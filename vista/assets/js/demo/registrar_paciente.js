document.getElementById('registrar-paciente').addEventListener('submit', async function(e){
    e.preventDefault();

    try {
        const resp = await fetch(url_base + 'controlador/personaController.php?action=login', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        });
        
        const data = await resp.json();
        const msgEl = document.getElementById('loginMsg');

        if (data.success) {
            msgEl.innerHTML = '<div class="alert alert-success">Ingreso correcto. Redireccionando...</div>';
            // redirigir a dashboard
            setTimeout(()=> window.location.href = url_base + 'vista/index.php', 700);
        } else {
            msgEl.innerHTML = '<div class="alert alert-danger">' + (data.message || 'Error en login') + '</div>';
        }
    } catch (err) {
        console.log(err);
    }
});