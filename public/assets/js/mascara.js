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

//CNPJ
function mascaraCNPJ(valor) {
    valor = somenteNumeros(valor);

    valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");
    valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    valor = valor.replace(/\.(\d{3})(\d)/, "$1/$2");
    valor = valor.replace(/(\d{4})(\d)/, "$1-$2");

    return valor;
}

//TELEFONE
function mascaraTelefone(valor) {
    valor = somenteNumeros(valor);

    valor = valor.replace(/^(\d{2})(\d)/, "($1) $2");
    valor = valor.replace(/(\d{5})(\d)/, "$1-$2");
}


//Colocar máscaras em prática
//DOMContentLoaded -> executa quando o html carregar
document.addEventListener("DOMContentLoaded", function () {

    const cpf = document.getElementById("cpf");
    const telefone = document.getElementById("telefone");
    const cnpj = document.getElementById("cnpj");

    if (cpf) {
        cpf.addEventListener("input", function (e) {
            e.target.value = mascaraCPF(e.target.value); //"Valor do input = mascaraCPF(valor do input)";
        });
    }

    if (telefone) {
        cpf.addEventListener("input", function (e) {
            e.target.value = mascaraTelefone(e.target.value);
        });
    }

    if (cnpj) {
        cpf.addEventListener("input", function (e) {
            e.target.value = mascaraCNPJ(e.target.value);
        });
    }
});

