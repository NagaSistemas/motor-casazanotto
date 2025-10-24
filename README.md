# Motor de Reservas Casa Zanotto

Sistema de reservas integrado com API Artaxnet para Pousada Casa Zanotto.

## Arquivos

- `reserva.html` - Formulário de reservas público
- `admin.html` - Painel administrativo
- `webhook.php` - Endpoint para webhooks da API

## Deploy Hostinger

### 1. Upload via File Manager
```
1. Acesse cPanel → File Manager
2. Navegue para public_html/
3. Upload dos arquivos:
   - reserva.html
   - admin.html
   - webhook.php
4. Defina permissões 644 para .html e 755 para .php
```

### 2. URLs de Acesso
- Reservas: `https://seudominio.com/reserva.html`
- Admin: `https://seudominio.com/admin.html`
- Webhook: `https://seudominio.com/webhook.php`

### 3. Configuração Webhook
Configure na API Artaxnet:
- URL: `https://seudominio.com/webhook.php`
- Token: `client_secret_9605Y3wx0CNYQZdGvqh3PjH`

## Deploy Railway

### 1. Preparar Repositório
```bash
git clone https://github.com/NagaSistemas/motor-casazanotto
cd motor-casazanotto
```

### 2. Criar railway.json
```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php -S 0.0.0.0:$PORT",
    "healthcheckPath": "/reserva.html"
  }
}
```

### 3. Criar index.php
```php
<?php
// Redirecionar para reserva.html
header('Location: /reserva.html');
exit;
?>
```

### 4. Deploy
```bash
# Via Railway CLI
railway login
railway link
railway up

# Ou conectar GitHub no dashboard Railway
```

### 5. Configurar Domínio
- Railway Dashboard → Settings → Domains
- Adicionar domínio customizado se necessário

## Credenciais API
- ClientId: `client_id_960o8MMPfTi3E2PVVCZ7S0RRgCkX`
- ClientSecret: `client_secret_9605Y3wx0CNYQZdGvqh3PjH`

## Funcionalidades
- ✅ Verificação de disponibilidade
- ✅ Criação de reservas
- ✅ Painel administrativo
- ✅ Webhooks para notificações
- ✅ Design responsivo Casa Zanotto