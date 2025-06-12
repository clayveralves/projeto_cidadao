// Abrir modal cadastro
function abrirModalCadastro() {
    document.getElementById('modalCadastro').style.display = 'block';
}
function fecharModalCadastro() {
    document.getElementById('modalCadastro').style.display = 'none';
}

// Abrir modal listagem com DataTable
function abrirModalListagem() {
    $('#modalListagem').css('display', 'block');

    // Destrói a tabela anterior caso exista para reiniciar
    if ($.fn.DataTable.isDataTable('#tabelaCidadaos')) {
        $('#tabelaCidadaos').DataTable().destroy();
    }

    $('#tabelaCidadaos').DataTable({
        ajax: {
            url: 'listar.php',
            dataSrc: ''
        },
        columns: [
            { data: 'nis', title: 'NIS' },
            { data: 'nome', title: 'Nome' }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        },
        pageLength: 10,
        lengthChange: false,
        searching: false,
        ordering: true,
        order: [[1, 'asc']]
    });
}
function fecharModalListagem() {
    document.getElementById('modalListagem').style.display = 'none';
}

// Modal sucesso
function mostrarModalSucesso(mensagem) {
    document.getElementById('mensagemSucesso').textContent = mensagem;
    document.getElementById('modalSucesso').style.display = 'block';
}
function fecharModalSucesso() {
    document.getElementById('modalSucesso').style.display = 'none';
}

// Modal erro
function mostrarModalErro(mensagem) {
    document.getElementById('mensagemErro').textContent = mensagem;
    document.getElementById('modalErro').style.display = 'block';
}
function fecharModalErro() {
    document.getElementById('modalErro').style.display = 'none';
}

// Abrir/fechar modal pesquisa
function abrirModalPesquisa() {
    document.getElementById('modalPesquisa').style.display = 'block';
}
function fecharModalPesquisa() {
    document.getElementById('modalPesquisa').style.display = 'none';
}

// Função pesquisar cidadão
function pesquisarCidadao() {
    const nis = document.getElementById('nisBusca').value.trim();

    if (nis.length !== 11) {
        alert("Por favor, insira um NIS válido com 11 dígitos.");
        return;
    }

    fetch('pesquisar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ nis })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Preenche o modal com os dados do cidadão
            document.getElementById('pesquisaNis').textContent = data.cidadao.nis;
            document.getElementById('pesquisaNome').textContent = data.cidadao.nome;
            abrirModalPesquisa();
        } else {
            mostrarModalErro(data.error || "Cidadão não encontrado.");
        }
    })
    .catch(() => {
        alert("Erro na comunicação com o servidor.");
    });
}

// Fecha o modal se clicar fora dele (todos os modais)
window.onclick = function(event) {
    ['modalCadastro', 'modalListagem', 'modalSucesso', 'modalPesquisa', 'modalErro'].forEach(id => {
        const modal = document.getElementById(id);
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Cadastro via AJAX
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formCadastroCidadao');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const nome = document.getElementById('nome').value.trim();
        if (!nome) {
            alert("O nome é obrigatório.");
            return;
        }

        fetch('cadastrar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ nome })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fecharModalCadastro();
                mostrarModalSucesso(`Cidadão cadastrado com sucesso! NIS: ${data.nis}`);
                if ($.fn.DataTable.isDataTable('#tabelaCidadaos')) {
                    $('#tabelaCidadaos').DataTable().ajax.reload(null, false);
                }
                form.reset();
            } else {
                alert(data.error || "Erro ao cadastrar cidadão.");
            }
        })
        .catch(() => {
            alert("Erro na comunicação com o servidor.");
        });
    });
});
