# Résumé des modifications - Plugin WooCommerce Extra Product Options

## 📋 Objectif
Ajouter la fonctionnalité permettant d'attribuer un **prix supplémentaire** aux options personnalisées des produits WooCommerce. Ce prix s'ajoute automatiquement au prix de base du produit dans le panier.

## 🎯 Exemple d'utilisation
```
Produit : Pizza Margherita = 10,00€
Option 1 : Supplément Poulet (checkbox) = +5,00€
Option 2 : Extras (checkboxgroup: fromage, bacon) = +2,00€ × 2 = +4,00€
Option 3 : Grande taille (select) = +3,00€

TOTAL AU PANIER = 10 + 5 + 4 + 3 = 22,00€
```

## 📝 Modifications effectuées

### 1️⃣ Modèle de données - `includes/model/fields/class-wepof-field.php`
✅ Ajout de la propriété `public $price = '';` à la ligne 44

### 2️⃣ Interface d'administration - `admin/class-thwepof-admin-form-field.php`
✅ Ligne 98 : Définition du champ price dans `field_props`
✅ Ligne 476 : Ajout dans le formulaire Select
✅ Ligne 496 : Ajout dans le formulaire Radio
✅ Ligne 516 : Ajout dans le formulaire Checkbox
✅ Ligne 562 : Ajout dans le formulaire Checkboxgroup

### 3️⃣ Logique front-end - `public/class-thwepof-public.php`
✅ Ligne 84-86 : Ajout des hooks WooCommerce
✅ Ligne 624-633 : Fonction `woo_add_cart_item()` - Sauvegarde du prix
✅ Ligne 635-657 : Fonction `woo_before_calculate_totals()` - Recalcul des totaux
✅ Ligne 659-698 : Fonction `calculate_extra_options_price()` - Calcul intelligent du prix

## 🔧 Fonctionnalités

### Types de champs supportés
- ✅ **Text, Email, URL, Number, Tel, Password** : Prix ajouté si une valeur est saisie
- ✅ **Textarea** : Prix ajouté si une valeur est saisie
- ✅ **Select** : Prix ajouté si une option est sélectionnée
- ✅ **Radio** : Prix ajouté si une option est sélectionnée
- ✅ **Checkbox** : Prix ajouté si la case est cochée
- ✅ **Checkboxgroup** : Prix multiplié par le nombre d'options cochées ⭐
- ✅ **Switch** : Prix ajouté si activé
- ✅ **Datepicker, Timepicker, Colorpicker** : Prix ajouté si une valeur est sélectionnée
- ✅ **Range** : Prix ajouté si une valeur est sélectionnée

### Logique de calcul intelligente

#### Pour les cases à cocher (Checkbox, Switch)
```php
Prix ajouté uniquement si l'option est cochée
Exemple : Checkbox "Supplément Poulet" à 5€
- Non coché → +0€
- Coché → +5€
```

#### Pour les groupes de cases à cocher (Checkboxgroup) ⭐
```php
Prix multiplié par le nombre d'options cochées
Exemple : "Extras" à 2€ par option
- 0 option cochée → +0€
- 2 options cochées → +4€
- 3 options cochées → +6€
```

#### Pour les autres champs (Select, Radio, Text, etc.)
```php
Prix ajouté si une valeur est saisie/sélectionnée
Exemple : Select "Taille" à 3€
- Aucune sélection → +0€
- "Grande" sélectionné → +3€
```

## 🚀 Installation

1. **Téléchargez** les fichiers modifiés
2. **Remplacez** les 3 fichiers dans votre installation du plugin
3. **Videz** le cache (navigateur + serveur)
4. **Testez** en créant un champ avec un prix

## 📖 Guide d'utilisation

### Dans l'administration WordPress

1. Allez dans **WooCommerce → Extra Product Options**
2. Créez ou éditez une section d'options
3. Ajoutez ou modifiez un champ
4. Remplissez le nouveau champ **"Price"** avec le montant (ex: 5.00)
5. Sauvegardez

### Sur le site

Lorsqu'un client :
1. Visite une page produit
2. Sélectionne une option avec un prix
3. Ajoute au panier
4. Le prix est automatiquement ajusté dans le panier

## 🔍 Vérifications techniques

### Base de données
Le champ `price` est automatiquement sauvegardé grâce à la fonction `prepare_field_from_posted_data()` qui traite tous les champs du tableau `field_props`.

### Persistance
Le prix supplémentaire est stocké dans :
- Les métadonnées du panier : `thwepof_extra_price`
- Les options du panier : `thwepof_options`

### Performance
- Le calcul est fait **une seule fois** par requête
- Protection contre les doubles calculs avec `did_action('woocommerce_before_calculate_totals')`

## 🎨 Hook et filtre disponibles

### Filtre personnalisé
```php
add_filter('thwepof_calculate_extra_options_price', function($total_extra_price, $extra_options) {
    // Exemple : Réduction de 10% sur le prix supplémentaire
    return $total_extra_price * 0.9;
}, 10, 2);
```

## ✅ Tests recommandés

### Test 1 : Option simple
- Produit à 10€
- Checkbox "Supplément" à 5€
- Résultat attendu : 15€

### Test 2 : Options multiples
- Produit à 10€
- 3 options avec prix différents (5€ + 2€ + 3€)
- Résultat attendu : 20€

### Test 3 : Checkboxgroup
- Produit à 10€
- Checkboxgroup "Extras" à 2€ par option
- Cocher 3 options
- Résultat attendu : 16€ (10 + 2×3)

### Test 4 : Persistance
- Ajouter au panier
- Fermer le navigateur
- Rouvrir
- Vérifier que le prix est toujours correct

### Test 5 : Commande
- Finaliser une commande
- Vérifier le prix dans :
  - Email de confirmation
  - Page de remerciement
  - Admin WooCommerce → Commandes
  - Facture

## 🛠 Dépannage

### Le prix ne s'ajoute pas
1. Vérifiez que le champ Price contient une valeur > 0
2. Vérifiez que l'option est bien sélectionnée/cochée
3. Videz tous les caches
4. Désactivez temporairement les autres plugins
5. Vérifiez les logs PHP : `/wp-content/debug.log`

### Le prix est incorrect
1. Vérifiez le type de champ (checkboxgroup multiplie le prix)
2. Vérifiez qu'il n'y a pas d'autres plugins qui modifient le prix
3. Testez avec le thème par défaut

### Pour activer le debug
```php
// Dans wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

## 📚 Fichiers de documentation

- **MODIFICATIONS_PRICE.md** : Documentation technique détaillée
- **TESTS_PRICE.php** : Script de tests et instructions
- **README_MODIFICATIONS.md** : Ce fichier

## ⚠️ Notes importantes

1. **Sauvegarde** : Faites toujours une sauvegarde avant de modifier un plugin
2. **Child theme** : Ces modifications sont dans le plugin, pas dans le thème
3. **Mises à jour** : Ces modifications seront écrasées si vous mettez à jour le plugin
4. **Version** : Modifications testées avec la version 3.3.3 du plugin

## 🎯 Compatibilité

- ✅ WooCommerce 6.0+
- ✅ Testé jusqu'à WooCommerce 10.1
- ✅ WordPress 5.0+
- ✅ PHP 7.4+
- ✅ Compatible avec produits simples
- ✅ Compatible avec produits variables

## 💡 Cas d'usage réels

### Restaurant / Pizzeria
- Pizza de base : 10€
- Supplément viande : +3€
- Extras (fromage, bacon, etc.) : +1€ par option
- Boisson : +2€

### E-commerce vêtements
- T-shirt : 20€
- Personnalisation (nom brodé) : +5€
- Emballage cadeau : +3€

### Services
- Service de base : 50€
- Option express : +15€
- Support étendu : +10€

## 📞 Support

Pour toute question ou problème :
1. Consultez d'abord les fichiers de documentation
2. Vérifiez les logs d'erreurs
3. Testez avec les plugins désactivés un par un
4. Créez une copie de staging pour tester

---

**Date de modification** : 20 octobre 2025
**Version du plugin** : 3.3.3
**Testés avec** : WooCommerce 10.1, WordPress 6.x
