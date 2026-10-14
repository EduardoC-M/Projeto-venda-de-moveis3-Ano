idocument.addEventListener('DOMContentLoaded', () => {
    // Validação de Formulário Genérica para Novo Dado e Editar
    const formCRUD = document.querySelector('form[name="novoMovel"], form[name="atualizarDado"]');

    if (formCRUD) {
        formCRUD.addEventListener('submit', function(event) {
            let nome = this.nome.value.trim();
            let valor = parseFloat(this.valor.value);
            let quant = parseInt(this.quant.value);

            // 1. Validação de campos vazios (já garantido pelo 'required', mas bom reforçar)
            if (nome === "" || isNaN(valor) || isNaN(quant)) {
                alert('Todos os campos (Nome, Valor e Quantidade) devem ser preenchidos!'); // Mensagem de erro (Etapa 5b)
                event.preventDefault(); // Impede o envio
                return;
            }

            // 2. Validação Lógica (ex: valor e quantidade positivos)
            if (valor <= 0) {
                alert('O valor do móvel deve ser um número positivo!'); // Mensagem de erro (Etapa 5b)
                event.preventDefault();
                return;
            }
            if (quant < 0) {
                alert('A quantidade não pode ser negativa!'); // Mensagem de erro (Etapa 5b)
                event.preventDefault();
                return;
            }

            // 3. Confirmação de Sucesso antes do envio (Etapa 5b)
            if (!confirm('Tem certeza que deseja salvar este dado?')) {
                 event.preventDefault();
            }
        });
    }

    // Adiciona confirmação para deletar
    const linksDeletar = document.querySelectorAll('a[href^="deletar.php"]');
    linksDeletar.forEach(link => {
        // Verifica se o link é para a ação de deletar na lista
        if (!link.href.includes('&delete=sim')) {
            link.addEventListener('click', function(event) {
                if (!confirm('ATENÇÃO: Você tem certeza que deseja DELETAR este registro?')) {
                    event.preventDefault();
                }
            });
        }
    });
});