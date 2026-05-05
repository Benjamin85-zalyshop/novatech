# Novatech - E-commerce PHP (Guinée)

Plateforme e-commerce complète en PHP/MySQL avec design Bootstrap.

## Fonctionnalités
- Page d'accueil moderne
- Boutique (Ordinateurs, Imprimantes, Accessoires)
- Panier via session
- Système de commande
- Espace admin sécurisé (authentification)
- Monnaie: **GNF**
- Pays: **Guinée**

## Structure
- `assets/` : CSS, JS, images
- `config/` : configuration base de données
- `admin/` : authentification + dashboard admin
- `shop/` : catalogue et panier
- `orders/` : checkout
- `sql/` : script SQL (`schema.sql`)
- `includes/` : header/footer/helpers

## Installation rapide
1. Créez une base MySQL et importez `sql/schema.sql`.
2. Ajustez `config/database.php`.
3. Lancez en local :
   ```bash
   php -S localhost:8000
   ```
4. Ouvrez `http://localhost:8000`.

## Admin par défaut
- Utilisateur: `admin`
- Mot de passe: `admin123`
