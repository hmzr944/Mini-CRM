<template>
  <div class="clients-container">
    <div class="clients-wrapper">
      <!-- Titre -->
      <h1 class="title">👥 Gestion des Clients</h1>
      <p class="subtitle">Ajoutez, modifiez ou supprimez vos clients facilement.</p>

      <!-- Formulaire d'ajout -->
      <div class="card">
        <h2 class="card-title">Ajouter un client</h2>
        <form @submit.prevent="addClient" class="form">
          <div class="input-group">
            <label>Nom</label>
            <input v-model="form.name" type="text" placeholder="Nom complet" required />
          </div>
          <div class="input-group">
            <label>Email</label>
            <input v-model="form.email" type="email" placeholder="exemple@mail.com" required />
          </div>
          <div class="input-group">
            <label>Téléphone</label>
            <input v-model="form.phone" type="text" placeholder="06 12 34 56 78" />
          </div>
          <div class="input-group">
            <label>Entreprise</label>
            <input v-model="form.company" type="text" placeholder="Nom de l'entreprise" />
          </div>
          <button type="submit" class="btn-primary" :disabled="loading">
            {{ loading ? 'Ajout en cours...' : 'Ajouter le client' }}
          </button>
        </form>
      </div>

      <!-- Liste des clients -->
      <div class="card">
        <h2 class="card-title">Liste des clients</h2>
        <table class="clients-table">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Entreprise</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="client in clients" :key="client.id">
              <td>{{ client.name }}</td>
              <td>{{ client.email }}</td>
              <td>{{ client.phone || '-' }}</td>
              <td>{{ client.company || '-' }}</td>
              <td>
                <button class="btn-edit" @click="openEdit(client)">Modifier</button>
                <button class="btn-danger" @click="deleteClient(client.id)">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- MODALE ÉDITION -->
      <div v-if="showEdit" class="modal">
        <div class="modal-content">
          <h2>Modifier le client</h2>
          <form @submit.prevent="updateClient">
            <div class="input-group">
              <label>Nom</label>
              <input v-model="editForm.name" type="text" required />
            </div>
            <div class="input-group">
              <label>Email</label>
              <input v-model="editForm.email" type="email" required />
            </div>
            <div class="input-group">
              <label>Téléphone</label>
              <input v-model="editForm.phone" type="text" />
            </div>
            <div class="input-group">
              <label>Entreprise</label>
              <input v-model="editForm.company" type="text" />
            </div>
            <div class="modal-actions">
              <button type="submit" class="btn-primary">Enregistrer</button>
              <button type="button" class="btn-secondary" @click="closeEdit">Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';

const toast = useToast();

const props = defineProps({
  clients: Array
});

const clients = ref(props.clients);
const form = ref({ name: '', email: '', phone: '', company: '' });
const editForm = ref({ id: null, name: '', email: '', phone: '', company: '' });
const loading = ref(false);
const showEdit = ref(false);

// Ajouter un client
async function addClient() {
  loading.value = true;
  try {
    const { data } = await axios.post('/clients', form.value);
    clients.value.push(data);
    toast.success('✅ Client ajouté avec succès');
    form.value = { name: '', email: '', phone: '', company: '' };
  } catch (error) {
    toast.error('❌ Erreur lors de l’ajout');
  }
  loading.value = false;
}

// Supprimer un client
async function deleteClient(id) {
  if (!confirm('Voulez-vous vraiment supprimer ce client ?')) return;
  try {
    await axios.delete(`/clients/${id}`);
    clients.value = clients.value.filter(client => client.id !== id);
    toast.warning('❌ Client supprimé');
  } catch (error) {
    toast.error('Erreur lors de la suppression');
  }
}

// Ouvrir la modale pour modifier
function openEdit(client) {
  editForm.value = { ...client }; // Copie du client
  showEdit.value = true;
}

// Fermer la modale
function closeEdit() {
  showEdit.value = false;
}

// Mettre à jour le client
async function updateClient() {
  try {
    const { data } = await axios.put(`/clients/${editForm.value.id}`, editForm.value);
    const index = clients.value.findIndex(c => c.id === editForm.value.id);
    clients.value[index] = data;
    toast.success('✅ Client mis à jour');
    closeEdit();
  } catch (error) {
    toast.error('Erreur lors de la mise à jour');
  }
}
</script>

<style scoped>
/* === CONTAINER & TITRE === */
.clients-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  display: flex;
  justify-content: center;
  padding: 30px;
}

.clients-wrapper {
  width: 100%;
  max-width: 1000px;
  color: #fff;
}

.title {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 8px;
  text-align: center;
}

.subtitle {
  text-align: center;
  color: #94a3b8;
  margin-bottom: 30px;
}

/* === CARDS === */
.card {
  background: #1e293b;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.6);
  margin-bottom: 20px;
}

.card-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 15px;
  color: white;
}

/* === FORM INPUTS === */
.form .input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  font-size: 14px;
  margin-bottom: 6px;
  color: #cbd5e1;
}

.input-group input {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #334155;
  background: #0f172a;
  color: #fff;
  font-size: 16px;
}

/* === BOUTONS === */
.btn-primary {
  width: 100%;
  padding: 14px;
  background: linear-gradient(90deg, #2563eb, #3b82f6);
  color: #fff;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: transform 0.2s;
}

.btn-primary:hover {
  transform: scale(1.03);
}

.btn-danger {
  padding: 8px 12px;
  background: linear-gradient(90deg, #dc2626, #ef4444);
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  margin-left: 10px;
}

.btn-danger:hover {
  opacity: 0.9;
}

.btn-edit {
  padding: 8px 12px;
  background: linear-gradient(90deg, #10b981, #34d399);
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
}

/* === TABLE === */
.clients-table {
  width: 100%;
  border-collapse: collapse;
  color: #e2e8f0;
}

.clients-table th, .clients-table td {
  padding: 12px;
  text-align: left;
}

.clients-table th {
  background: #334155;
  color: #fff;
}

.clients-table tr:nth-child(even) {
  background: #273549;
}

/* === MODALE === */
.modal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: #1e293b;
  padding: 20px;
  border-radius: 12px;
  width: 400px;
  color: #fff;
}

.modal-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 15px;
}

.btn-secondary {
  padding: 10px;
  background: #334155;
  color: #fff;
  border: none;
  border-radius: 8px;
}
</style>
