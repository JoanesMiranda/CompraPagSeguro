function validaCompra()
{
    if(document.formCompra.nomeProduto.value == "")
    {
        alert("Preencha o campo nome do produto corretamente");
        document.formCompra.nomeProduto.focus();
        return false;
    }
    if(document.formCompra.valor.value == "")
    {
        alert("Preencha o campo valor corretamente");
        document.formCompra.valor.focus();
        return false;
    }
     if(document.formCompra.nomeProduto.value == "")
    {
        alert("preencha o campo senha corretamente");
        document.formCompra.nomeProduto.focus();
        return false;
    }
}

 
         
       

