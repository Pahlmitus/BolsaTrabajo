<?php

// Comprueba si $aguja esta al final de $pajar
function endsWith($pajar, $aguja) {
	if (is_array($aguja) == false) {
		$res = strrpos($pajar, $aguja);
		if ($res == strlen($pajar)-1) {
			return true;	
		} else {
			return false;	
		}
	} else {
		foreach ($aguja as $a) {
			$res = strrpos($pajar, $a) . "<br>";
			if ($res == strlen($pajar)-1) {
				return true;	
			}
		}
		return false;	
	}
}


// Carga los estilos principales
function loadMainStyles($datos) {
        // Si es un array, lo está llamando showIndex
        // Si es un objeto, lo está llamando showGroceryCRUD
        if (is_array($datos)) {
                array_push(
                        $datos['css_files'], 
                        base_url() . 'assets/main/main.css'
                );
        } else {
                $datos->css_files['main'] = base_url() . 'assets/main/main.css';
        }
        return $datos;
}


// Carga Bootstrap
function loadBootstrap($datos) {
        array_push(
                $datos['css_files'], 
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
        );
        array_push(
                $datos['js_files'],
                'https://code.jquery.com/jquery-3.2.1.slim.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'
        );
        return $datos;
}


// Crea y renderiza un objeto CRUD. Se le pasa un objeto stdClass de configuración
function createGroceryCRUD($config) {
        $crud = new Grocery_CRUD();
        $crud->set_theme('bootstrap-v4');
        $crud->set_language('spanish');
    
        $crud->set_table($config->table);
    
        // Si el sujeto acaba en vocal, añade "s" al final. Si acaba en consonante, añade "es". 
        if (endsWith($config->subject, array("a", "e", "i", "o", "u"))) {
                $crud->set_subject($config->subject, $config->subject . "s");
        } else {
                $crud->set_subject($config->subject, $config->subject . "es");
        }

        // Asigna nombres a los campos
        foreach ($config->columns as $column => $name) {
                $crud->display_as($column, $name);
        }
    
        // Comprueba si hay que hacer alguna relación externa
        if (isset($config->relations)) {
                foreach ($config->relations as $relation) {
                        // Comprueba si es un array de arrays
                        if (is_array($relation)) {
                                $crud->set_relation($relation[0], $relation[1], $relation[2]);
                        } else {
                                $crud->set_relation($config->relations[0], $config->relations[1], $config->relations[2]);
                        }
                }
        }

        // Comprueba si hay un campo contraseña
        if (isset($config->password_field)) {
                $crud->change_field_type($config->password_field, 'password');
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function(event) { 
                                var x = $(\"input[name=$config->password_field]\");
                                x.remove();
                        });
                </script>";
        }

        // Devuelve el objeto
        $output = $crud->render();
        
        return $output;
}