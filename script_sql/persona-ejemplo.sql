select * FROM clinic_admin_db.persona_direccion ;
select * FROM clinic_admin_db.persona_documento ;
select * FROM clinic_admin_db.persona_telefono ;
select * FROM clinic_admin_db.persona 

create table historial
- per_codigo (codigo de la persona)
- his_codigo (codigo de historial)
- his_motivo
- his_comentario

create table historial_enfermedades
- he_codigo (codigo de historial_enfermedades)
- his_codigo (codigo de historial)
- cod_enfermedad (Int) nCatValor de la tabla catalogo & nCatGuia = 1 

create table historial_medico
- hm_codigo
- his_codigo (codigo de historial)
- cod_medico (Int) nCatValor de la tabla catalogo & nCatGuia = 2 