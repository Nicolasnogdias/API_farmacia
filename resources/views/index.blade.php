<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia - CRUD</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    <header>
        <h1>Gerenciamento de Medicamentos</h1>
    </header>

    <div class="container">

        <h2>Cadastrar Medicamento</h2>

        <div class="form">
            <input id="name" placeholder="Nome">
            <input id="price" placeholder="Preço">
            <input id="brand" placeholder="Marca">
            <input id="stock" placeholder="Estoque">
            <input id="utility" placeholder="Utilidade">

            <button onclick="createMedicamento()">Cadastrar</button>
        </div>

        <h2>Lista de Medicamentos</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Marca</th>
                    <th>Estoque</th>
                    <th>Utilidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="listaMedicamentos"></tbody>
        </table>
    </div>

    <!-- Modal de edição -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Editar Medicamento</h2>

            <input id="edit_id" type="hidden">
            <input id="edit_name" placeholder="Nome">
            <input id="edit_price" placeholder="Preço">
            <input id="edit_brand" placeholder="Marca">
            <input id="edit_stock" placeholder="Estoque">
            <input id="edit_utility" placeholder="Utilidade">

            <button onclick="updateMedicamento()">Salvar</button>
            <button onclick="closeModal()">Cancelar</button>
        </div>
    </div>

</body>

</html>
