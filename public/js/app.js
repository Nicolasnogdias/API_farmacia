const BASE_URL = "https://apifarmacia.webapptech.site/api";

// ===============================
// Criar medicamento
// ===============================
async function createMedicamento() {
    const data = {
        name: document.getElementById("name").value,
        price: document.getElementById("price").value,
        brand: document.getElementById("brand").value,
        stock: document.getElementById("stock").value,
        utility: document.getElementById("utility").value
    };

    const res = await fetch(`${BASE_URL}/remedio`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });

    const json = await res.json();

    if (res.ok) {
        alert("Medicamento cadastrado!");
        loadMedicamentos();
    } else {
        alert("Erro ao cadastrar: " + JSON.stringify(json));
    }
}

// ===============================
// Listar medicamentos
// ===============================
async function loadMedicamentos() {
    const res = await fetch(`${BASE_URL}/medicamentos`);
    const json = await res.json();

    const tbody = document.getElementById("listaMedicamentos");
    tbody.innerHTML = "";

    if (!res.ok) return alert("Erro ao carregar medicamentos");

    json.data.forEach(item => {
        tbody.innerHTML += `
            <tr>
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td>${item.brand}</td>
                <td>${item.stock}</td>
                <td>${item.utility}</td>
                <td>
                    <button onclick="openEditModal(${item.id}, '${item.name}', '${item.price}', '${item.brand}', '${item.stock}', '${item.utility}')">Editar</button>
                    <button onclick="deleteMedicamento(${item.id})">Excluir</button>
                </td>
            </tr>
        `;
    });
}

// ===============================
// Excluir medicamento
// ===============================
async function deleteMedicamento(id) {
    if (!confirm("Deseja excluir?")) return;

    const res = await fetch(`${BASE_URL}/remedio/${id}`, {
        method: "DELETE"
    });

    if (res.ok) {
        alert("Excluído!");
        loadMedicamentos();
    } else {
        alert("Erro ao excluir");
    }
}

// ===============================
// Abrir modal de edição
// ===============================
function openEditModal(id, name, price, brand, stock, utility) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_price").value = price;
    document.getElementById("edit_brand").value = brand;
    document.getElementById("edit_stock").value = stock;
    document.getElementById("edit_utility").value = utility;

    document.getElementById("editModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("editModal").style.display = "none";
}

// ===============================
// Atualizar medicamento (PUT)
// ===============================
async function updateMedicamento() {
    const id = document.getElementById("edit_id").value;

    const data = {
        name: document.getElementById("edit_name").value,
        price: document.getElementById("edit_price").value,
        brand: document.getElementById("edit_brand").value,
        stock: document.getElementById("edit_stock").value,
        utility: document.getElementById("edit_utility").value
    };

    const res = await fetch(`${BASE_URL}/remedio/${id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });

    if (res.ok) {
        alert("Atualizado!");
        closeModal();
        loadMedicamentos();
    } else {
        alert("Erro ao atualizar");
    }
}

// Carregar ao abrir página
window.onload = loadMedicamentos;
