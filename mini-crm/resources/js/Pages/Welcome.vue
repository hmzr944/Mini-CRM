<template>
  <div class="welcome-container">
    <div class="welcome-wrapper">
      <h1 class="title">Bienvenue sur <span class="highlight">Mini CRM</span></h1>
      <p class="subtitle">Gérez vos clients en toute simplicité avec un tableau de bord élégant et performant.</p>

      <div class="action-buttons">
        <a href="/login" class="btn-primary">Se connecter</a>
        <a href="/register" class="btn-secondary">Créer un compte</a>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
/* Container principal */
.welcome-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  font-family: 'Segoe UI', Tahoma, sans-serif;
  text-align: center;
  padding: 20px;
  color: #fff;
}

/* Wrapper */
.welcome-wrapper {
  background: #1e293b;
  padding: 40px 50px;
  border-radius: 12px;
  max-width: 550px;
  width: 100%;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
  animation: fadeIn 0.8s ease-in-out;
}

/* Titre */
.title {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 15px;
  color: #fff;
}

.highlight {
  color: #38bdf8;
}

/* Sous-titre */
.subtitle {
  font-size: 16px;
  color: #94a3b8;
  margin-bottom: 35px;
  line-height: 1.5;
}

/* Boutons */
.action-buttons {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.btn-primary,
.btn-secondary {
  display: block;
  width: 100%;
  text-align: center;
  padding: 14px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: bold;
  text-decoration: none;
  transition: background 0.3s, transform 0.2s;
}

.btn-primary {
  background: linear-gradient(90deg, #2563eb, #3b82f6);
  color: #fff;
}

.btn-primary:hover {
  background: linear-gradient(90deg, #1d4ed8, #2563eb);
  transform: scale(1.03);
}

.btn-secondary {
  background: #0f172a;
  color: #38bdf8;
  border: 1px solid #38bdf8;
}

.btn-secondary:hover {
  background: #1e293b;
  transform: scale(1.03);
}

/* Animation */
@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(-20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive */
@media (max-width: 480px) {
  .welcome-wrapper {
    padding: 30px 20px;
  }
  .title {
    font-size: 26px;
  }
}
</style>
