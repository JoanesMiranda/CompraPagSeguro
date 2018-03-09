$(document).ready(function () {
    $("#nomeProduto").change(function () {
        var precoServico;
        if (this.value === "Formatação de Computador") {
            precoServico = 100.01;
        } else if (this.value === "Remoção de Virus") {
            precoServico = 50.01;
        } else if (this.value === "Limpeza de Hardware") {
            precoServico = 50.01;
        } else if (this.value === "Instalação e configuração de rede") {
            precoServico = 200.01;
        } else if (this.value === "Instalação e Configuração de Perifericos") {
            precoServico = 50.01;
        }
        $("#myInput").val(precoServico);
    });
});
