function selecionado(elemento) {
    // Remove classe ativa de todos
    const labels = document.querySelectorAll('.tipoConta label');
    labels.forEach(label => {
        label.classList.remove('ativo');
    });

    // Adiciona classe ao clicado
    elemento.classList.add('ativo');

    // Marca o input interno como checked
    const input = elemento.querySelector('input');
    input.checked = true;
}

const labels = document.querySelectorAll('.tipoConta label');

labels.forEach(label => {
    label.addEventListener('click', function () {

        labels.forEach(l => l.classList.remove('ativo'));
        this.classList.add('ativo');

    });
});