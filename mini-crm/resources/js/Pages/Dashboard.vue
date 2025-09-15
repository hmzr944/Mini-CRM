<template>
  <div class="dashboard-container">
    <div class="dashboard-wrapper">
      <!-- Titre -->
      <h1 class="dashboard-title">📊 Tableau de bord</h1>
      <p class="dashboard-subtitle">Vue d’ensemble des statistiques et activités récentes.</p>

      <!-- Statistiques -->
      <div class="stats-grid">
        <div v-for="(stat, index) in stats" :key="index" class="stat-card">
          <h2 class="stat-name">{{ stat.name }}</h2>
          <p class="stat-value">{{ stat.value }}</p>
          <div class="progress-bar">
            <div :class="['progress-fill', stat.color]" :style="{ width: Math.min(stat.value, 100) + '%' }"></div>
          </div>
        </div>
      </div>

      <!-- Graphique simplifié -->
      <div class="chart-card">
        <h2 class="card-title">Évolution des Clients</h2>
        <svg viewBox="0 0 300 100" class="chart-svg">
          <polyline fill="none" stroke="#38bdf8" stroke-width="3" :points="chartPoints" />
        </svg>
      </div>

      <!-- Actions rapides -->
      <div class="actions-card">
        <h2 class="card-title">Actions rapides</h2>
        <div class="actions-buttons">
          <a href="/clients" class="btn-action blue">Voir les clients</a>
          <a href="/clients" class="btn-action green">Ajouter un client</a>
        </div>
      </div>

      <!-- Activité récente -->
      <div class="recent-card">
        <h2 class="card-title">Activité récente</h2>
        <ul>
          <li v-for="(activity, i) in recentActivities" :key="i" class="recent-item">
            {{ activity }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

// Stats
const stats = [
  { name: 'Total Clients', value: 120, color: 'blue' },
  { name: 'Nouveaux Clients (Mois)', value: 15, color: 'green' },
  { name: 'Taux de Conversion (%)', value: 60, color: 'purple' },
];

// Activités récentes
const recentActivities = [
  "Jean Dupont ajouté",
  "Mise à jour client : Sarah",
  "Suppression : client #58"
];

// Mini graphique SVG (données simplifiées)
const chartData = [10, 20, 35, 50, 70];
const chartPoints = computed(() => {
  return chartData.map((val, index) => `${index * 60},${100 - val}`).join(' ');
});
</script>

<style scoped>
/* ====== Conteneur global ====== */
.dashboard-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 30px;
}

.dashboard-wrapper {
  width: 100%;
  max-width: 1200px;
  color: #fff;
}

/* ====== Titre ====== */
.dashboard-title {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 8px;
  text-align: center;
}

.dashboard-subtitle {
  text-align: center;
  color: #94a3b8;
  margin-bottom: 30px;
}

/* ====== Cartes ====== */
.stat-card, .chart-card, .actions-card, .recent-card {
  background: #1e293b;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.6);
  margin-bottom: 20px;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.stat-name {
  font-size: 14px;
  color: #94a3b8;
}

.stat-value {
  font-size: 28px;
  font-weight: bold;
  margin: 10px 0;
}

.progress-bar {
  width: 100%;
  background: #334155;
  border-radius: 8px;
  overflow: hidden;
  height: 8px;
}

.progress-fill {
  height: 8px;
  transition: width 1s ease-in-out;
}

.progress-fill.blue {
  background: #3b82f6;
}

.progress-fill.green {
  background: #10b981;
}

.progress-fill.purple {
  background: #8b5cf6;
}

/* ====== Graphique ====== */
.chart-card .chart-svg {
  width: 100%;
  height: 120px;
}

/* ====== Actions rapides ====== */
.actions-buttons {
  display: flex;
  gap: 15px;
}

.btn-action {
  flex: 1;
  text-align: center;
  padding: 12px;
  border-radius: 8px;
  color: #fff;
  font-weight: bold;
  text-decoration: none;
  transition: transform 0.2s;
}

.btn-action.blue {
  background: linear-gradient(90deg, #2563eb, #3b82f6);
}

.btn-action.green {
  background: linear-gradient(90deg, #059669, #10b981);
}

.btn-action:hover {
  transform: scale(1.05);
}

/* ====== Activité récente ====== */
.recent-item {
  border-bottom: 1px solid #334155;
  padding: 10px 0;
  color: #e2e8f0;
}

.card-title {
  font-size: 18px;
  margin-bottom: 15px;
  font-weight: bold;
}
</style>
