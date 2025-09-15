<template>
  <div class="settings-container">
    <div class="settings-card">
      <h1 class="title">⚙️ Configuration SMTP</h1>
      <p class="subtitle">Modifiez les paramètres d'envoi des emails.</p>

      <form @submit.prevent="submit" class="settings-form">
        <div class="input-group" v-for="field in fields" :key="field.key">
          <label :for="field.key">{{ field.label }}</label>
          <input
            v-model="form[field.key]"
            :id="field.key"
            :type="field.type"
            :placeholder="field.placeholder"
            required
          />
        </div>

        <button class="btn-primary" type="submit" :disabled="processing">
          <span v-if="processing">Mise à jour...</span>
          <span v-else>✅ Sauvegarder</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  settings: Object
});

const form = useForm({
  mail_mailer: props.settings.mail_mailer || 'smtp',
  mail_host: props.settings.mail_host || '',
  mail_port: props.settings.mail_port || 587,
  mail_username: props.settings.mail_username || '',
  mail_password: props.settings.mail_password || '',
  mail_encryption: props.settings.mail_encryption || 'tls',
  mail_from_address: props.settings.mail_from_address || '',
  mail_from_name: props.settings.mail_from_name || ''
});

const fields = [
  { key: 'mail_mailer', label: 'Mailer', type: 'text', placeholder: 'smtp' },
  { key: 'mail_host', label: 'Hôte SMTP', type: 'text', placeholder: 'smtp.gmail.com' },
  { key: 'mail_port', label: 'Port', type: 'number', placeholder: '587' },
  { key: 'mail_username', label: 'Nom d’utilisateur', type: 'text', placeholder: 'Votre email' },
  { key: 'mail_password', label: 'Mot de passe', type: 'password', placeholder: 'Votre mot de passe' },
  { key: 'mail_encryption', label: 'Encryption', type: 'text', placeholder: 'tls' },
  { key: 'mail_from_address', label: 'Email expéditeur', type: 'email', placeholder: 'noreply@exemple.com' },
  { key: 'mail_from_name', label: 'Nom expéditeur', type: 'text', placeholder: 'CRM App' }
];

const submit = () => {
  form.post('/admin/mail-settings', {
    onSuccess: () => alert('✅ Paramètres mis à jour !')
  });
};
</script>

<style scoped>
.settings-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
}

.settings-card {
  background: #1e293b;
  padding: 35px;
  border-radius: 12px;
  width: 100%;
  max-width: 500px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
  color: #fff;
}

.title {
  font-size: 24px;
  margin-bottom: 10px;
  text-align: center;
}

.subtitle {
  color: #94a3b8;
  margin-bottom: 20px;
  text-align: center;
}

.input-group {
  margin-bottom: 20px;
}

.input-group label {
  display: block;
  font-size: 14px;
  margin-bottom: 6px;
}

.input-group input {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #334155;
  background: #0f172a;
  color: #fff;
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
}
</style>
