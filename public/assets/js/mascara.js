// Remove o que não é número
function somenteNumeros(valor) {
    return valor.replace(/\D/g, "");
}

//CPF
function mascaraCPF(valor) {
    valor = somenteNumeros(valor);

    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    return valor;
}



