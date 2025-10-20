# 📍 Emplacements précis des modifications

## Fichier 1 : class-wepof-field.php

```
Chemin : includes/model/fields/class-wepof-field.php
```

### Ligne 44 - Ajouter la propriété price

**AVANT :**
```php
	public $minlength = '';
	public $maxlength = '';

	public function __construct() {
		
	}
```

**APRÈS :**
```php
	public $minlength = '';
	public $maxlength = '';

	public $price = '';              // ← NOUVELLE LIGNE

	public function __construct() {
		
	}
```

---

## Fichier 2 : class-thwepof-admin-form-field.php

```
Chemin : admin/class-thwepof-admin-form-field.php
```

### Modification A - Ligne 98 : Ajouter la définition du champ

**AVANT :**
```php
			'title_class'    => array('type'=>'text', 'name'=>'title_class', 'label'=>__('Label Class', 'woo-extra-product-options'), 'placeholder'=>__('separate classes with comma', 'woo-extra-product-options')),

			'input_mask'   => array('type'=>'text', 'name'=>'input_mask', 'label'=>__('Input Masking Pattern', 'woo-extra-product-options'), 'hint_text'=>__('Helps to ensure input to a predefined format like (999) 999-9999.', 'woo-extra-product-options')),
		);
	}
```

**APRÈS :**
```php
			'title_class'    => array('type'=>'text', 'name'=>'title_class', 'label'=>__('Label Class', 'woo-extra-product-options'), 'placeholder'=>__('separate classes with comma', 'woo-extra-product-options')),

			'input_mask'   => array('type'=>'text', 'name'=>'input_mask', 'label'=>__('Input Masking Pattern', 'woo-extra-product-options'), 'hint_text'=>__('Helps to ensure input to a predefined format like (999) 999-9999.', 'woo-extra-product-options')),
			
			'price'   => array('type'=>'number', 'name'=>'price', 'label'=>__('Price', 'woo-extra-product-options'), 'min'=>0, 'step'=>0.01, 'hint_text'=>__('Additional price to add to the product when this option is selected', 'woo-extra-product-options')),    // ← NOUVELLE LIGNE
		);
	}
```

### Modification B1 - Ligne ~476 : render_form_field_select()

**AVANT :**
```php
	private function render_form_field_select(){
		?>
        <table id="thwepof_field_form_id_select" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			$this->render_form_elm_row($this->field_props['placeholder']);
			$this->render_form_elm_row($this->field_props['options']);
			$this->render_form_elm_row($this->field_props['value']);
			//$this->render_form_elm_row($this->field_props['cssclass']);
```

**APRÈS :**
```php
	private function render_form_field_select(){
		?>
        <table id="thwepof_field_form_id_select" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			$this->render_form_elm_row($this->field_props['placeholder']);
			$this->render_form_elm_row($this->field_props['options']);
			$this->render_form_elm_row($this->field_props['value']);
			$this->render_form_elm_row($this->field_props['price']);    // ← NOUVELLE LIGNE
			//$this->render_form_elm_row($this->field_props['cssclass']);
```

### Modification B2 - Ligne ~496 : render_form_field_radio()

**AVANT :**
```php
	private function render_form_field_radio(){
		?>
        <table id="thwepof_field_form_id_radio" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			//$this->render_form_elm_row($this->field_props['title_position']);
			$this->render_form_elm_row($this->field_props['options']);
			$this->render_form_elm_row($this->field_props['value']);
			//$this->render_form_elm_row($this->field_props['cssclass']);
```

**APRÈS :**
```php
	private function render_form_field_radio(){
		?>
        <table id="thwepof_field_form_id_radio" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			//$this->render_form_elm_row($this->field_props['title_position']);
			$this->render_form_elm_row($this->field_props['options']);
			$this->render_form_elm_row($this->field_props['value']);
			$this->render_form_elm_row($this->field_props['price']);    // ← NOUVELLE LIGNE
			//$this->render_form_elm_row($this->field_props['cssclass']);
```

### Modification B3 - Ligne ~516 : render_form_field_checkbox()

**AVANT :**
```php
	private function render_form_field_checkbox(){
		$prop_value = $this->field_props['value'];
		$prop_value['label'] = __('Value', 'woo-extra-product-options');

		?>
        <table id="thwepof_field_form_id_checkbox" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			$this->render_form_elm_row($prop_value);			
			//$this->render_form_elm_row($this->field_props['cssclass']);
```

**APRÈS :**
```php
	private function render_form_field_checkbox(){
		$prop_value = $this->field_props['value'];
		$prop_value['label'] = __('Value', 'woo-extra-product-options');

		?>
        <table id="thwepof_field_form_id_checkbox" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			$this->render_form_elm_row($prop_value);
			$this->render_form_elm_row($this->field_props['price']);    // ← NOUVELLE LIGNE
			//$this->render_form_elm_row($this->field_props['cssclass']);
```

### Modification B4 - Ligne ~562 : render_form_field_checkboxgroup()

**AVANT :**
```php
	private function render_form_field_checkboxgroup(){

		$min_checked = $this->field_props['minlength'];
        $min_checked['label'] = __('Min. Selections', 'woo-extra-product-options');
		$min_checked['hint_text'] = __('The minimum checked item', 'woo-extra-product-options');

        $max_checked = $this->field_props['maxlength'];
        $max_checked['label'] = __('Max. Selections', 'woo-extra-product-options');
		$max_checked['hint_text'] = __('The maximum checked item', 'woo-extra-product-options');

		?>
        <table id="thwepof_field_form_id_checkboxgroup" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			//$this->render_form_elm_row($this->field_props['title_position']);
			$this->render_form_elm_row($this->field_props['options']);
			$this->render_form_elm_row($this->field_props['value']);

			$this->render_form_elm_row($min_checked);
```

**APRÈS :**
```php
	private function render_form_field_checkboxgroup(){

		$min_checked = $this->field_props['minlength'];
        $min_checked['label'] = __('Min. Selections', 'woo-extra-product-options');
		$min_checked['hint_text'] = __('The minimum checked item', 'woo-extra-product-options');

        $max_checked = $this->field_props['maxlength'];
        $max_checked['label'] = __('Max. Selections', 'woo-extra-product-options');
		$max_checked['hint_text'] = __('The maximum checked item', 'woo-extra-product-options');

		?>
        <table id="thwepof_field_form_id_checkboxgroup" class="thwepo_pp_table" style="display:none;">
            <?php
			$this->render_form_elm_row($this->field_props['title']);
			//$this->render_form_elm_row($this->field_props['title_position']);
			$this->render_form_elm_row($this->field_props['options']);
			$this->render_form_elm_row($this->field_props['value']);
			$this->render_form_elm_row($this->field_props['price']);    // ← NOUVELLE LIGNE

			$this->render_form_elm_row($min_checked);
```

---

## Fichier 3 : class-thwepof-public.php

```
Chemin : public/class-thwepof-public.php
```

### Modification A - Ligne ~84 : Ajouter les hooks

**AVANT :**
```php
		add_filter('woocommerce_add_to_cart_validation', array($this, 'woo_add_to_cart_validation'), $hp_validation, 6 );
		add_filter('woocommerce_add_cart_item_data', array($this, 'woo_add_cart_item_data'), $hp_add_item_data, 3 );
		add_filter('woocommerce_get_item_data', array($this, 'woo_get_item_data'), 10, 2 );

		if(THWEPOF_Utils::woo_version_check()){
```

**APRÈS :**
```php
		add_filter('woocommerce_add_to_cart_validation', array($this, 'woo_add_to_cart_validation'), $hp_validation, 6 );
		add_filter('woocommerce_add_cart_item_data', array($this, 'woo_add_cart_item_data'), $hp_add_item_data, 3 );
		add_filter('woocommerce_get_item_data', array($this, 'woo_get_item_data'), 10, 2 );
		
		// Hook to modify cart item price based on extra options price    // ← NOUVELLES LIGNES
		add_action('woocommerce_before_calculate_totals', array($this, 'woo_before_calculate_totals'), 10, 1);
		add_filter('woocommerce_add_cart_item', array($this, 'woo_add_cart_item'), 10, 2);

		if(THWEPOF_Utils::woo_version_check()){
```

### Modification B - Ligne ~622 : Ajouter 3 nouvelles fonctions

**Localisation :** Après la fonction `woo_add_cart_item_data()`, avant la fonction `woo_get_item_data()`

**INSÉRER CE CODE COMPLET :**

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

## ✅ Résumé des emplacements

| Fichier | Ligne approximative | Action |
|---------|--------------------:|--------|
| class-wepof-field.php | 44 | Ajouter 1 ligne : propriété `$price` |
| class-thwepof-admin-form-field.php | 98 | Ajouter 1 ligne : définition du champ |
| class-thwepof-admin-form-field.php | 476 | Ajouter 1 ligne dans select |
| class-thwepof-admin-form-field.php | 496 | Ajouter 1 ligne dans radio |
| class-thwepof-admin-form-field.php | 516 | Ajouter 1 ligne dans checkbox |
| class-thwepof-admin-form-field.php | 562 | Ajouter 1 ligne dans checkboxgroup |
| class-thwepof-public.php | 84 | Ajouter 3 lignes : hooks |
| class-thwepof-public.php | 622 | Ajouter 3 fonctions complètes |

**Total : 3 fichiers, 11 endroits, ~95 lignes de code ajoutées**

---

## 💡 Astuce

Utilisez la fonction de recherche de votre éditeur pour trouver rapidement :
- `public $maxlength` → pour la modification dans class-wepof-field.php
- `'input_mask'` → pour la modification dans field_props
- `render_form_field_select` → pour les modifications de formulaires
- `woo_add_cart_item_data` → pour l'emplacement d'insertion des nouvelles fonctions
