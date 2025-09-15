<template>
  <div class="auth-container">
    <div class="auth-card">
      <h1 class="title">Mot de passe oublié ?</h1>
      <p class="subtitle">Entrez votre email pour recevoir un lien de réinitialisation.</p>

      <form @submit.prevent="submit">
        <!-- Email -->
        <div class="input-group">
          <label for="email">Adresse e-mail</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            placeholder="Votre email"
            required
          />
          <span v-if="form.errors.email" class="error">{{ form.errors.email }}</span>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn-primary" :disabled="form.processing">
          <span v-if="form.processing">Envoi en cours...</span>
          <span v-else>Envoyer le lien</span>
        </button>
      </form>

      <div class="footer">
        <Link href="/login" class="link">Retour à la connexion</Link>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();
const form = useForm({ email: '' });

function submit() {
  form.post('/forgot-password', {
    onSuccess: () => toast.success('📧 Lien envoyé ! Vérifiez vos emails'),
    onError: () => toast.error('❌ Adresse email introuvable'),
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
  padding: 20px;
}

.auth-card {
  background: #1e293b;
  padding: 40px;
  border-radius: 12px;
  width: 100%;
  max-width: 450px;
  text-align: center;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
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
}

.btn-primary:hover {
  transform: scale(1.03);
}

.footer {
  margin-top: 20px;
  color: #94a3b8;
}

.link {
  color: #38bdf8;
}
</style>
