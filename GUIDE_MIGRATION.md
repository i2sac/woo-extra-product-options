# Guide de migration rapide - Ajout du champ Price

## 🎯 Résumé
Ajout d'un champ "Price" permettant d'ajouter un supplément au prix des produits WooCommerce via les options personnalisées.

## 📦 Fichiers à modifier

### ✅ 3 fichiers à modifier :
1. `includes/model/fields/class-wepof-field.php`
2. `admin/class-thwepof-admin-form-field.php`
3. `public/class-thwepof-public.php`

### 📄 3 fichiers de documentation créés :
1. `MODIFICATIONS_PRICE.md` - Documentation technique complète
2. `README_MODIFICATIONS.md` - Guide utilisateur et résumé
3. `TESTS_PRICE.php` - Script et instructions de test

---

## 📝 Modification 1/3 : Modèle de données

**Fichier** : `includes/model/fields/class-wepof-field.php`

**Ligne 44** - Ajouter après `public $maxlength = '';` :
```php
public $price = '';
```

---

## 📝 Modification 2/3 : Interface admin

**Fichier** : `admin/class-thwepof-admin-form-field.php`

### A. Ligne 98 - Dans `get_field_form_props()`, avant le `);` final :
```php
'price'   => array('type'=>'number', 'name'=>'price', 'label'=>__('Price', 'woo-extra-product-options'), 'min'=>0, 'step'=>0.01, 'hint_text'=>__('Additional price to add to the product when this option is selected', 'woo-extra-product-options')),
```

### B. Dans les fonctions de rendu des formulaires, ajouter cette ligne :
```php
$this->render_form_elm_row($this->field_props['price']);
```

À ajouter dans ces 4 fonctions :
- **Ligne ~476** dans `render_form_field_select()` - Après `$this->render_form_elm_row($this->field_props['value']);`
- **Ligne ~496** dans `render_form_field_radio()` - Après `$this->render_form_elm_row($this->field_props['value']);`
- **Ligne ~516** dans `render_form_field_checkbox()` - Après `$this->render_form_elm_row($prop_value);`
- **Ligne ~562** dans `render_form_field_checkboxgroup()` - Après `$this->render_form_elm_row($this->field_props['value']);`

---

## 📝 Modification 3/3 : Logique du panier

**Fichier** : `public/class-thwepof-public.php`

### A. Ligne ~84 - Dans `define_public_hooks()`, après `add_filter('woocommerce_get_item_data'...` :
```php
// Hook to modify cart item price based on extra options price
add_action('woocommerce_before_calculate_totals', array($this, 'woo_before_calculate_totals'), 10, 1);
add_filter('woocommerce_add_cart_item', array($this, 'woo_add_cart_item'), 10, 2);
```

### B. Ligne ~622 - Après la fonction `woo_add_cart_item_data()`, ajouter ces 3 nouvelles fonctions :

```php
// Add extra price to cart item when it's loaded from session
public function woo_add_cart_item($cart_item, $cart_item_key) {
	if(isset($cart_item['thwepof_options'])){
		$extra_price = $this->calculate_extra_options_price($cart_item['thwepof_options']);
		if($extra_price > 0){
			$cart_item['thwepof_extra_price'] = $extra_price;
		}
	}
	return $cart_item;
}

// Recalculate cart totals with extra options price
public function woo_before_calculate_totals($cart) {
	if(is_admin() && !defined('DOING_AJAX')){
		return;
	}

	if(did_action('woocommerce_before_calculate_totals') >= 2){
		return;
	}

	foreach($cart->get_cart() as $cart_item_key => $cart_item){
		if(isset($cart_item['thwepof_options'])){
			$extra_price = $this->calculate_extra_options_price($cart_item['thwepof_options']);
			
			if($extra_price > 0){
				$product = $cart_item['data'];
				$base_price = floatval($product->get_price());
				$new_price = $base_price + $extra_price;
				$product->set_price($new_price);
			}
		}
	}
}

// Calculate the total extra price from options
private function calculate_extra_options_price($extra_options){
	$total_extra_price = 0;

	if(is_array($extra_options)){
		$options_full = THWEPOF_Utils::get_product_fields_full();
		
		foreach($extra_options as $name => $data){
			if(isset($options_full[$name])){
				$field = $options_full[$name];
				$field_price = floatval($field->get_property('price'));
				
				if($field_price > 0){
					$type = $field->get_property('type');
					
					// For checkbox, only add price if checked
					if($type === 'checkbox' || $type === 'switch'){
						if(!empty($data['value'])){
							$total_extra_price += $field_price;
						}
					}
					// For checkboxgroup, add price for each checked option
					else if($type === 'checkboxgroup'){
						$value = isset($data['value']) ? $data['value'] : '';
						if(!empty($value)){
							$checked_values = is_array($value) ? $value : explode(',', $value);
							$checked_count = count(array_filter($checked_values));
							$total_extra_price += ($field_price * $checked_count);
						}
					}
					// For all other field types (text, select, radio, etc.)
					else {
						if(!empty($data['value'])){
							$total_extra_price += $field_price;
						}
					}
				}
			}
		}
	}

	return apply_filters('thwepof_calculate_extra_options_price', $total_extra_price, $extra_options);
}
```

---

## ✅ Checklist de vérification

Avant de sauvegarder :
- [ ] J'ai fait une sauvegarde complète du plugin
- [ ] J'ai vérifié que tous les fichiers sont corrects
- [ ] J'ai respecté l'indentation et les conventions du code existant

Après modification :
- [ ] Le site fonctionne toujours
- [ ] Je peux créer/éditer des champs
- [ ] Le champ "Price" apparaît dans le formulaire
- [ ] Le prix s'ajoute correctement au panier
- [ ] Les commandes fonctionnent

---

## 🧪 Test rapide

1. **Admin** : WooCommerce → Extra Product Options
2. **Créer** un champ Select avec Price = 5
3. **Front** : Aller sur un produit à 10€
4. **Sélectionner** l'option
5. **Panier** : Le prix doit être 15€

---

## 🆘 En cas de problème

1. **Erreur 500** : Vérifiez la syntaxe PHP (virgules, accolades)
2. **Champ Price invisible** : Videz le cache
3. **Prix non ajouté** : Vérifiez que la valeur Price > 0
4. **Site cassé** : Restaurez la sauvegarde

---

## 📞 Support

Consultez les fichiers de documentation :
- **MODIFICATIONS_PRICE.md** pour les détails techniques
- **README_MODIFICATIONS.md** pour le guide complet
- **TESTS_PRICE.php** pour les tests

---

**Temps estimé de modification** : 15-20 minutes
**Niveau requis** : Débutant/Intermédiaire PHP
**Impact** : Faible (3 fichiers seulement)
