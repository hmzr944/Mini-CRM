<template>
  <div class="auth-container">
    <div class="auth-card">
      <h1 class="title">Connexion</h1>
      <p class="subtitle">Accédez à votre espace sécurisé</p>

      <form @submit.prevent="submit">
        <!-- Email -->
        <div class="input-group">
          <label for="email">Adresse e-mail</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            placeholder="Entrez votre email"
            required
          />
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
              placeholder="Votre mot de passe"
              required
            />
            <button type="button" class="toggle-password" @click="togglePassword">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path
                  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 3a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"
                />
              </svg>
            </button>
          </div>
          <span v-if="form.errors.password" class="error">{{ form.errors.password }}</span>
        </div>

        <!-- Mot de passe oublié -->
        <div class="options">
          <Link href="/forgot-password" class="link">Mot de passe oublié ?</Link>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn-primary" :disabled="form.processing">
          <span v-if="form.processing">Connexion...</span>
          <span v-else>Se connecter</span>
        </button>
      </form>

      <div class="footer">
        Pas encore de compte ? <Link href="/register" class="link">Créer un compte</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const showPassword = ref(false);
const togglePassword = () => (showPassword.value = !showPassword.value);

const form = useForm({
  email: '',
  password: '',
});

function submit() {
  form.post('/login', {
    onSuccess: () => {
      window.location.href = '/dashboard'; // ✅ Redirige vers dashboard
    },
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
  max-width: 420px;
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

.input-group input:focus {
  border-color: #38bdf8;
  outline: none;
}

.password-wrapper {
  position: relative;
  width: 100%;
}

.password-wrapper input {
  width: 100%;
  padding: 12px;
  padding-right: 45px; /* Espace pour le bouton */
  border-radius: 8px;
  border: 1px solid #334155;
  background: #0f172a;
  color: #fff;
  font-size: 16px;
  box-sizing: border-box;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #94a3b8;
  font-size: 18px;
  cursor: pointer;
}

.error {
  display: block;
  color: #f87171;
  font-size: 14px;
  margin-top: 5px;
}

.options {
  text-align: right;
  margin-bottom: 15px;
}

.link {
  color: #38bdf8;
  text-decoration: none;
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
</style>
