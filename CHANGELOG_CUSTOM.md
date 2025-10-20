# CHANGELOG - Ajout de la fonctionnalité Price

## Version 3.3.3-CUSTOM (20 octobre 2025)

### ✨ Nouvelle fonctionnalité : Champ Price pour les options

#### Ajouts
- **Champ Price** : Nouveau champ permettant d'ajouter un prix supplémentaire à chaque option personnalisée
- **Calcul automatique** : Le prix supplémentaire est automatiquement ajouté au prix du produit dans le panier
- **Support multi-types** : Compatible avec tous les types de champs (select, radio, checkbox, checkboxgroup, text, etc.)
- **Logique intelligente** : 
  - Checkbox/Switch : Prix ajouté uniquement si coché
  - Checkboxgroup : Prix multiplié par le nombre d'options sélectionnées
  - Autres : Prix ajouté si une valeur est présente

#### Modifications techniques

##### 1. Modèle de données
- **Fichier** : `includes/model/fields/class-wepof-field.php`
- **Ajout** : Propriété `public $price = '';` (ligne 44)
- **Impact** : Faible - Extension de la classe existante

##### 2. Interface d'administration
- **Fichier** : `admin/class-thwepof-admin-form-field.php`
- **Ajouts** :
  - Définition du champ price dans `field_props` (ligne 98)
  - Affichage du champ dans 4 formulaires :
    - `render_form_field_select()` (ligne ~476)
    - `render_form_field_radio()` (ligne ~496)
    - `render_form_field_checkbox()` (ligne ~516)
    - `render_form_field_checkboxgroup()` (ligne ~562)
- **Impact** : Moyen - Ajout de champs dans les formulaires existants

##### 3. Logique front-end
- **Fichier** : `public/class-thwepof-public.php`
- **Ajouts** :
  - 2 nouveaux hooks WooCommerce (ligne ~84)
  - 3 nouvelles méthodes :
    - `woo_add_cart_item()` : Sauvegarde du prix extra (ligne ~624)
    - `woo_before_calculate_totals()` : Recalcul des totaux (ligne ~635)
    - `calculate_extra_options_price()` : Calcul du prix (ligne ~659)
- **Impact** : Élevé - Modification du comportement du panier

#### Nouveaux hooks et filtres

##### Filtre : `thwepof_calculate_extra_options_price`
```php
apply_filters('thwepof_calculate_extra_options_price', $total_extra_price, $extra_options)
```
Permet de modifier le prix total calculé avant de l'ajouter au produit.

**Paramètres** :
- `$total_extra_price` (float) : Le prix supplémentaire calculé
- `$extra_options` (array) : Les options sélectionnées

**Exemple d'utilisation** :
```php
// Appliquer une réduction de 10% sur le prix supplémentaire
add_filter('thwepof_calculate_extra_options_price', function($price, $options) {
    return $price * 0.9;
}, 10, 2);
```

#### Documentation
- `MODIFICATIONS_PRICE.md` : Documentation technique détaillée
- `README_MODIFICATIONS.md` : Guide utilisateur complet
- `GUIDE_MIGRATION.md` : Guide de migration rapide
- `EMPLACEMENTS_PRECIS.md` : Emplacements exacts des modifications
- `TESTS_PRICE.php` : Script et instructions de test

#### Compatibilité
- ✅ Compatible avec WooCommerce 6.0+
- ✅ Testé jusqu'à WooCommerce 10.1
- ✅ Compatible WordPress 5.0+
- ✅ Compatible PHP 7.4+
- ✅ Rétrocompatible : N'affecte pas les fonctionnalités existantes

#### Performances
- **Impact minimal** : Calcul effectué uniquement lors du recalcul des totaux du panier
- **Optimisation** : Protection contre les calculs multiples avec `did_action()`
- **Cache-friendly** : Compatible avec les plugins de cache

#### Tests effectués
- ✅ Ajout de prix sur différents types de champs
- ✅ Calcul correct avec options multiples
- ✅ Persistance du prix dans le panier
- ✅ Prix correct dans les commandes
- ✅ Emails de confirmation
- ✅ Compatibilité avec produits simples
- ✅ Compatibilité avec produits variables

#### Notes de migration
- **Sauvegarde recommandée** avant installation
- **Aucune migration de base de données** nécessaire
- **Les champs existants** ne sont pas affectés
- **Nouveau champ** disponible immédiatement après modification

#### Limitations connues
- Le prix n'est pas affiché directement sur la page produit (seulement dans le panier)
- Les modifications seront écrasées lors d'une mise à jour du plugin
- Solution : Créer un plugin personnalisé ou utiliser un child theme pour WordPress

#### Cas d'usage
- **Restaurant/Pizzeria** : Suppléments de garniture avec prix
- **E-commerce** : Options de personnalisation payantes
- **Services** : Extensions de service avec coûts additionnels
- **Événements** : Options de billets avec suppléments

#### Support
Pour toute question ou problème :
1. Consultez `README_MODIFICATIONS.md` pour le guide complet
2. Vérifiez `EMPLACEMENTS_PRECIS.md` pour les emplacements exacts
3. Utilisez `TESTS_PRICE.php` pour les instructions de test
4. Activez WP_DEBUG pour voir les erreurs

#### Crédits
- **Développement** : Modification custom pour ajouter la fonctionnalité Price
- **Plugin original** : Extra Product Options For WooCommerce by ThemeHigh
- **Date** : 20 octobre 2025
- **Version de base** : 3.3.3

---

## Notes importantes

### ⚠️ Avant installation
1. Faites une **sauvegarde complète** de votre site
2. Testez sur un **environnement de staging** si possible
3. Vérifiez la **compatibilité** avec vos autres plugins
4. Lisez la **documentation complète**

### 🔄 Mise à jour du plugin
Ces modifications seront écrasées si vous mettez à jour le plugin Extra Product Options.

**Solutions** :
- Créer un plugin personnalisé séparé
- Utiliser un système de gestion de versions (Git)
- Documenter toutes les modifications
- Tester après chaque mise à jour

### 📊 Métriques
- **Fichiers modifiés** : 3
- **Lignes ajoutées** : ~95
- **Fonctions ajoutées** : 3
- **Propriétés ajoutées** : 1
- **Hooks ajoutés** : 2
- **Temps de développement** : ~2 heures
- **Temps d'installation** : ~15-20 minutes

### 🎯 Prochaines évolutions possibles
- Affichage du prix sur la page produit
- Prix différent par option (pas seulement par champ)
- Prix en pourcentage du prix de base
- Prix négatifs (réductions)
- Conditions sur les prix (ex: gratuit si quantité > 5)
- Import/export des prix
- Interface dédiée pour gérer les prix
- Historique des modifications de prix

---

**Version du plugin** : 3.3.3-CUSTOM
**Date de modification** : 20 octobre 2025
**Statut** : Stable
**Testé avec** : WooCommerce 10.1, WordPress 6.x
