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
function loadMainStyles($style) {
        // Si es un array, lo está llamando showIndex
        // Si es un objeto, lo está llamando showGroceryCRUD
        if (is_array($style)) {
                array_push(
                        $style['css_files'], 
                        base_url() . 'assets/main/main.css'
                );
        } else {
                $style->css_files['main'] = base_url() . 'assets/main/main.css';
        }
        return $style;
}


// Carga Bootstrap
function loadBootstrap($style) {
        array_push(
                $style['css_files'], 
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
        );
        array_push(
                $style['js_files'],
                'https://code.jquery.com/jquery-3.2.1.slim.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'
        );
        return $style;
}


// Crea y renderiza un objeto CRUD
function createGroceryCRUD($table, $subject, $relations = NULL) {
    $crud = new Grocery_CRUD();
    $crud->set_theme('bootstrap-v4');
    $crud->set_language('spanish');

    $crud->set_table($table);

    // Si $subject acaba en vocal, añade "s" al final. Si acaba en consonante, añade "es". 
    if (endsWith($subject, array("a", "e", "i", "o", "u"))) {
            $crud->set_subject($subject, $subject . "s");
    } else {
            $crud->set_subject($subject, $subject . "es");
    }

    if ($relations != NULL) {
            foreach ($relations as $relation) {
                    // Comprueba si es un array de arrays
                    if (is_array($relation)) {
                            $crud->set_relation($relation[0], $relation[1], $relation[2]);
                    } else {
                            $crud->set_relation($relations[0], $relations[1], $relations[2]);
                    }
            }
    }
    // Devuelve el objeto
    $output = $crud->render();
    
    return $output;
}