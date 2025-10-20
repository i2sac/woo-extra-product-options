# Modifications - Ajout du champ Price

## Vue d'ensemble
Cette modification ajoute la fonctionnalité de prix supplémentaire aux options personnalisées des produits WooCommerce. Lorsqu'un client sélectionne une option avec un prix défini, ce montant est automatiquement ajouté au prix de base du produit dans le panier.

## Exemple d'utilisation
- Un produit coûte 10$
- Vous créez un champ "Supplément Poulet" avec un prix de 5$
- Lorsque le client sélectionne cette option, le prix total dans le panier sera de 15$

## Fichiers modifiés

### 1. `/includes/model/fields/class-wepof-field.php`
**Ligne 44** - Ajout de la propriété `price` à la classe de base des champs :
```php
public $price = '';
```
Cette propriété stocke le prix supplémentaire associé à chaque champ personnalisé.

### 2. `/admin/class-thwepof-admin-form-field.php`

#### Ligne 98 - Ajout de la définition du champ price dans le formulaire d'administration :
```php
'price' => array(
    'type' => 'number',
    'name' => 'price',
    'label' => __('Price', 'woo-extra-product-options'),
    'min' => 0,
    'step' => 0.01,
    'hint_text' => __('Additional price to add to the product when this option is selected', 'woo-extra-product-options')
)
```

#### Modifications des formulaires de champs :
- **Ligne 476** - Ajout dans `render_form_field_select()` - Pour les listes déroulantes
- **Ligne 496** - Ajout dans `render_form_field_radio()` - Pour les boutons radio
- **Ligne 516** - Ajout dans `render_form_field_checkbox()` - Pour les cases à cocher
- **Ligne 562** - Ajout dans `render_form_field_checkboxgroup()` - Pour les groupes de cases à cocher

Chaque formulaire affiche maintenant le champ price :
```php
$this->render_form_elm_row($this->field_props['price']);
```

### 3. `/public/class-thwepof-public.php`

#### Ligne 84-86 - Ajout des hooks WooCommerce :
```php
add_action('woocommerce_before_calculate_totals', array($this, 'woo_before_calculate_totals'), 10, 1);
add_filter('woocommerce_add_cart_item', array($this, 'woo_add_cart_item'), 10, 2);
```

#### Ligne 624-633 - Fonction `woo_add_cart_item()` :
Sauvegarde le prix supplémentaire lors du chargement des items du panier depuis la session.

#### Ligne 635-657 - Fonction `woo_before_calculate_totals()` :
Hook principal qui recalcule les totaux du panier en ajoutant le prix supplémentaire des options sélectionnées.

#### Ligne 659-698 - Fonction `calculate_extra_options_price()` :
Calcule le montant total à ajouter en fonction des options sélectionnées et de leur type :

**Logique de calcul :**
- **Checkbox/Switch** : Ajoute le prix seulement si coché
- **Checkboxgroup** : Multiplie le prix par le nombre d'options cochées
- **Autres types** (text, select, radio, etc.) : Ajoute le prix si une valeur est saisie/sélectionnée

```php
// Exemple pour checkbox
if($type === 'checkbox' || $type === 'switch'){
    if(!empty($data['value'])){
        $total_extra_price += $field_price;
    }
}

// Exemple pour checkboxgroup - prix multiplié par nombre d'options
else if($type === 'checkboxgroup'){
    $value = isset($data['value']) ? $data['value'] : '';
    if(!empty($value)){
        $checked_values = is_array($value) ? $value : explode(',', $value);
        $checked_count = count(array_filter($checked_values));
        $total_extra_price += ($field_price * $checked_count);
    }
}

// Pour les autres types
else {
    if(!empty($data['value'])){
        $total_extra_price += $field_price;
    }
}
```

## Comment utiliser cette fonctionnalité

### Dans l'interface d'administration WooCommerce :

1. Accédez à **WooCommerce → Extra Product Options**
2. Créez ou modifiez une section d'options de produit
3. Ajoutez un champ (par exemple : Select, Radio, Checkbox, etc.)
4. Dans le formulaire du champ, vous verrez maintenant un nouveau champ **"Price"**
5. Entrez le montant supplémentaire à ajouter au prix du produit (exemple : 5.00)
6. Sauvegardez le champ

### Sur le front-end :

1. Un client visite la page d'un produit
2. Il sélectionne une option avec un prix défini (par exemple "Poulet - 5$")
3. Lorsqu'il ajoute le produit au panier, le prix affiché sera : **Prix de base + Prix de l'option**
4. Le prix est correctement calculé dans le panier, à la commande et dans les emails

## Types de champs supportés

Tous les types de champs qui acceptent une valeur utilisateur sont supportés :
- ✅ Text / Email / URL / Number / Tel / Password
- ✅ Textarea
- ✅ Select (liste déroulante)
- ✅ Radio (bouton radio)
- ✅ Checkbox (case à cocher unique)
- ✅ Checkboxgroup (groupe de cases à cocher - prix multiplié par nombre d'options cochées)
- ✅ Switch
- ✅ Datepicker / Timepicker / Colorpicker
- ✅ Range (slider)

## Hooks et filtres disponibles

### Filtre : `thwepof_calculate_extra_options_price`
Permet de modifier le prix total calculé avant de l'ajouter au produit.

```php
add_filter('thwepof_calculate_extra_options_price', function($total_extra_price, $extra_options) {
    // Modifier le prix total ici
    // Par exemple, appliquer une réduction de 10%
    return $total_extra_price * 0.9;
}, 10, 2);
```

## Compatibilité

- Compatible avec WooCommerce 6.0+
- Testé jusqu'à WooCommerce 10.1
- Compatible avec les produits simples et variables
- Compatible avec les extensions de panier courantes

## Notes techniques

1. **Sauvegarde automatique** : Le champ `price` est automatiquement sauvegardé car il est ajouté au tableau `field_props`. La fonction `prepare_field_from_posted_data()` traite automatiquement tous les champs avec le préfixe `i_`.

2. **Persistance** : Le prix supplémentaire est sauvegardé dans les métadonnées du panier sous la clé `thwepof_extra_price`.

3. **Recalcul** : Le prix est recalculé à chaque fois que les totaux du panier sont calculés via le hook `woocommerce_before_calculate_totals`.

4. **Protection** : Le hook ne s'exécute qu'une seule fois par requête pour éviter les doublons de calcul.

## Support et dépannage

### Le prix ne s'ajoute pas au panier
- Vérifiez que le champ `price` contient une valeur numérique supérieure à 0
- Vérifiez que l'option est bien sélectionnée/cochée/remplie
- Videz le cache du navigateur et du serveur

### Le prix est multiplié
- Assurez-vous de ne pas avoir d'autres plugins qui modifient également le prix
- Vérifiez les logs d'erreurs PHP

### Pour les développeurs
Activez le mode debug WordPress pour voir les erreurs éventuelles :
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Auteur
Modification réalisée le 20 octobre 2025 pour ajouter la fonctionnalité de prix supplémentaire aux options de produits.
