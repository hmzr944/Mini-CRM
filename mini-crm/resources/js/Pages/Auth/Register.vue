<template>
  <div class="auth-container">
    <div class="form-wrapper">
      <h1 class="title">Créer un compte</h1>
      <p class="subtitle">Rejoignez notre CRM pour une meilleure gestion.</p>

      <form @submit.prevent="submitForm" class="auth-form">
        <!-- Nom complet -->
        <div class="input-group">
          <label for="name">Nom complet</label>
          <input v-model="form.name" id="name" type="text" placeholder="Votre nom" required />
          <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
        </div>

        <!-- Email -->
        <div class="input-group">
          <label for="email">Adresse email</label>
          <input v-model="form.email" id="email" type="email" placeholder="exemple@mail.com" required />
          <span v-if="form.errors.email" class="error">{{ form.errors.email }}</span>
        </div>

        <!-- Mot de passe -->
        <div class="input-group">
          <label for="password">Mot de passe</label>
          <div class="password-wrapper">
            <input
              id="password"
              :type="showPassword ? 'text' : 'password'"
              v-model="form.password"
              placeholder="******"
              required
            />
            <button type="button" class="toggle-password" @click="togglePassword">
              👁
            </button>
          </div>
          <span v-if="form.errors.password" class="error">{{ form.errors.password }}</span>
        </div>

        <!-- Confirmation mot de passe -->
        <div class="input-group">
          <label for="password_confirmation">Confirmer le mot de passe</label>
          <div class="password-wrapper">
            <input
              id="password_confirmation"
              :type="showPasswordConfirm ? 'text' : 'password'"
              v-model="form.password_confirmation"
              placeholder="******"
              required
            />
            <button type="button" class="toggle-password" @click="togglePasswordConfirm">
              👁
            </button>
          </div>
          <span v-if="form.errors.password_confirmation" class="error">{{ form.errors.password_confirmation }}</span>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn-primary" :disabled="form.processing">
          <span v-if="form.processing">Inscription...</span>
          <span v-else>S'inscrire</span>
        </button>

        <!-- Lien vers login -->
        <p class="switch-auth">
          Déjà un compte ? <Link href="/login" class="link">Se connecter</Link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, Link, router } from '@inertiajs/vue3';

const showPassword = ref(false);
const showPasswordConfirm = ref(false);

const togglePassword = () => (showPassword.value = !showPassword.value);
const togglePasswordConfirm = () => (showPasswordConfirm.value = !showPasswordConfirm.value);

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

const submitForm = () => {
  form.post('/register', {
    onSuccess: () => {
      router.visit('/login'); // ✅ Redirige après inscription
    }
  });
};
</script>

<style scoped>
/* Même style que Login.vue */
.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
}

.form-wrapper {
  background: #1e293b;
  padding: 35px 40px;
  border-radius: 12px;
  width: 100%;
  max-width: 420px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
  color: #fff;
  text-align: center;
}

.title {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 10px;
}

.subtitle {
  font-size: 15px;
  color: #94a3b8;
  margin-bottom: 25px;
}

.input-group {
  text-align: left;
  margin-bottom: 20px;
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

.password-wrapper {
  position: relative;
  width: 100%;
}

.password-wrapper input {
  width: 100%;
  padding-right: 45px;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #94a3b8;
  cursor: pointer;
}

.error {
  display: block;
  color: #f87171;
  font-size: 14px;
  margin-top: 5px;
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

.switch-auth {
  margin-top: 20px;
  color: #94a3b8;
}
.link {
  color: #38bdf8;
}
</style>
