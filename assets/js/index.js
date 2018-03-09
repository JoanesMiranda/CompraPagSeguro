function validaLogin()
{
    if(document.formLogin.nome.value == "" || document.formLogin.nome.value.length < 6)
    {
        alert("preencha o campo nome corretamente - minimo 6 caracteres");
        document.formLogin.nome.focus();
        return false;
    }
    if(document.formLogin.senha.value == "")
    {
        alert("preencha o campo senha corretamente");
        document.formLogin.senha.focus();
        return false;
    }
}


