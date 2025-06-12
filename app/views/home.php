<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Gestão de Cidadãos</title>
    <link rel="stylesheet" href="/css/cidadao_style.css" />
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
</head>
<body>

<div class="card">
    <h1>Gestão de Cidadãos</h1>

    <button onclick="abrirModalCadastro()">Cadastrar novo cidadão</button>
    <button onclick="abrirModalListagem()">Listar todos os cidadãos</button>

    <form id="searchForm" onsubmit="event.preventDefault(); pesquisarCidadao();">
        <input type="text" id="nisBusca" placeholder="Digite o NIS (11 dígitos)" maxlength="11" required />
        <button type="submit">Pesquisar cidadão</button>
    </form>

    <div id="result"></div>
</div>

<!-- Modal Cadastro -->
<div id="modalCadastro" class="modal">
  <div class="modal-content">
    <span class="close" onclick="fecharModalCadastro()">&times;</span>
    <h2>Cadastrar Novo Cidadão</h2>
    <form id="formCadastroCidadao">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required />
      <button type="submit">Salvar</button>
    </form>
  </div>
</div>

<!-- Modal Listagem (DataTable) -->
<div id="modalListagem" class="modal">
  <div class="modal-content" style="max-width: 700px;">
    <span class="close" onclick="fecharModalListagem()">&times;</span>
    <h2>Lista de Cidadãos</h2>
    <table id="tabelaCidadaos" class="display" style="width:100%">
      <thead>
        <tr>
          <th>NIS</th>
          <th>Nome</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Sucesso -->
<div id="modalSucesso" class="modal">
  <div class="modal-content">
    <span class="close" onclick="fecharModalSucesso()">&times;</span>
    <h3 id="mensagemSucesso"></h3>
  </div>
</div>

<!-- Modal Resultado Pesquisa -->
<div id="modalPesquisa" class="modal">
  <div class="modal-content">
    <span class="close" onclick="fecharModalPesquisa()">&times;</span>
    <h3>Cidadão encontrado:</h3>
    <p><strong>NIS:</strong> <span id="pesquisaNis"></span></p>
    <p><strong>Nome:</strong> <span id="pesquisaNome"></span></p>
  </div>
</div>

<!-- Modal Erro -->
<div id="modalErro" class="modal">
  <div class="modal-content">
    <span class="close" onclick="fecharModalErro()">&times;</span>
    <h3 id="mensagemErro">Cidadão não encontrado.</h3>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="/js/cidadao_script.js"></script>
</body>
</html>
