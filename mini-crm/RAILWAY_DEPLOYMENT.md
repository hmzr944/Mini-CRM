# Déploiement sur Railway - Mini CRM

## Étapes de déploiement

### 1. Créer un compte Railway
1. Allez sur [railway.app](https://railway.app)
2. Connectez-vous avec votre compte GitHub

### 2. Créer un nouveau projet
1. Cliquez sur "New Project"
2. Sélectionnez "Deploy from GitHub repo"
3. Choisissez le repository : **hmzr944/Mini-CRM**
4. Railway détectera automatiquement que c'est une application PHP Laravel

### 3. Configurer la base de données
1. Cliquez sur "Add Plugin"
2. Sélectionnez "PostgreSQL" ou "MySQL" (gratuit)
3. Railway créera automatiquement les variables `DATABASE_URL`

### 4. Variables d'environnement requises

Allez dans l'onglet "Variables" et ajoutez :

```env
APP_NAME=Mini-CRM
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://votre-app.railway.app

# Laravel générera APP_KEY automatiquement au premier déploiement
# Ou générez-le localement avec: php artisan key:generate --show

# Database (Railway les fournit automatiquement)
DB_CONNECTION=pgsql
# ou mysql selon votre choix

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

# Mail (optionnel - configurez selon votre service)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 5. Commandes de déploiement

Railway exécutera automatiquement :
- `composer install --no-dev --optimize-autoloader`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

### 6. Migrations de base de données

Après le premier déploiement :
1. Allez dans "Settings"
2. Trouvez la section "Deploy"
3. Ajoutez dans "Build Command":
   ```bash
   composer install --no-dev --optimize-autoloader && php artisan migrate --force
   ```

### 7. URL de votre application

Railway générera automatiquement une URL :
- Format : `https://[nom-projet].railway.app`
- Vous pouvez aussi configurer un domaine personnalisé

## Limites du plan gratuit Railway

- 500 heures d'exécution par mois
- $5 de crédits gratuits par mois
- Pas de carte de crédit requise pour commencer

## Dépannage

### Si l'application ne démarre pas :
1. Vérifiez les logs dans Railway
2. Assurez-vous que `APP_KEY` est défini
3. Vérifiez que les migrations ont été exécutées

### Générer APP_KEY :
```bash
php artisan key:generate --show
```
Copiez la valeur générée dans les variables d'environnement Railway.

### Accéder à Artisan sur Railway :
Utilisez le "Railway CLI" :
```bash
railway login
railway link
railway run php artisan migrate
```
