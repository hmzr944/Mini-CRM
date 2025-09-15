<template>
  <div class="auth-container">
    <div class="auth-card">
      <h1 class="title">🔒 Réinitialiser le mot de passe</h1>
      <p class="subtitle">Choisissez un nouveau mot de passe sécurisé.</p>

      <!-- Message Laravel -->
      <div v-if="status" class="alert-success">{{ status }}</div>

      <form @submit.prevent="resetPassword">
        <!-- Email -->
        <div class="input-group">
          <label for="email">Adresse e-mail</label>
          <input id="email" type="email" v-model="form.email" disabled />
          <span v-if="form.errors.email" class="error">{{ form.errors.email }}</span>
        </div>

        <!-- Nouveau mot de passe -->
        <div class="input-group">
          <label for="password">Nouveau mot de passe</label>
          <input id="password" type="password" v-model="form.password" required />
          <span v-if="form.errors.password" class="error">{{ form.errors.password }}</span>
        </div>

        <!-- Confirmer mot de passe -->
        <div class="input-group">
          <label for="password_confirmation">Confirmez le mot de passe</label>
          <input id="password_confirmation" type="password" v-model="form.password_confirmation" required />
          <span v-if="form.errors.password_confirmation" class="error">{{ form.errors.password_confirmation }}</span>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn-primary" :disabled="form.processing">
          <span v-if="form.processing" class="loader"></span>
          <span v-else>Changer le mot de passe</span>
        </button>

        <p class="footer">
          <Link href="/login" class="link">Retour à la connexion</Link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link, router } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();
const props = defineProps({
  token: String,
  email: String,
  status: String,
});

const form = useForm({
  token: props.token,
  email: props.email || '',
  password: '',
  password_confirmation: ''
});

function resetPassword() {
  form.post(route('password.update'), {
    onSuccess: () => {
      toast.success("✅ Mot de passe réinitialisé avec succès !");
      router.visit('/login');
    },
    onError: () => {
      toast.error("❌ Erreur, veuillez vérifier vos informations.");
    }
  });
}
</script>

<style scoped>
.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
}

.auth-card {
  background: #1e293b;
  padding: 40px;
  border-radius: 12px;
  width: 100%;
  max-width: 450px;
  text-align: center;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
  animation: fadeIn 0.6s ease;
}

.title {
  font-size: 28px;
  color: #fff;
  font-weight: bold;
}

.subtitle {
  color: #94a3b8;
  margin-bottom: 20px;
}

.input-group {
  text-align: left;
  margin-bottom: 20px;
}

.input-group label {
  display: block;
  color: #cbd5e1;
  margin-bottom: 8px;
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

.error {
  color: #f87171;
  font-size: 14px;
}

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
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn-primary:hover {
  transform: scale(1.03);
}

.loader {
  border: 3px solid #fff;
  border-top: 3px solid transparent;
  border-radius: 50%;
  width: 18px;
  height: 18px;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg);}
  100% { transform: rotate(360deg);}
}

.alert-success {
  background: #16a34a;
  color: #fff;
  padding: 10px;
  border-radius: 6px;
  margin-bottom: 15px;
}

.footer {
  margin-top: 20px;
  color: #94a3b8;
}

.link {
  color: #38bdf8;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
